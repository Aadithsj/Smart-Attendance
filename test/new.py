import face_recognition
import cv2
import numpy as np
import pymysql
import json
from websocket_server import WebsocketServer
import threading

connection = pymysql.connect(host='localhost',
                             user='root',
                             password='',
                             database='sap')

import json

def get_known_faces():
    cursor = connection.cursor()
    cursor.execute("SELECT id, face_encoding, student_id FROM face_recognition")
    rows = cursor.fetchall()

    known_face_encodings = []
    known_face_ids = []
    known_face_person_ids = []

    for row in rows:
        face_id = row[0]
        face_encodings_str = row[1]
        person_id = row[2]

        face_encodings_dict = json.loads(face_encodings_str)
        face_encodings_list = list(face_encodings_dict.values())

        known_face_encodings.append(np.array(face_encodings_list))
        known_face_ids.append(face_id)
        known_face_person_ids.append(person_id)

    return known_face_encodings, known_face_ids, known_face_person_ids


def mark_attendance(person_id):
    cursor = connection.cursor()
    # cursor.execute("INSERT INTO test (student_id) VALUES (%s)", (person_id,))
    connection.commit()

    cursor.execute("SELECT first_name FROM students WHERE id = %s", (person_id,))
    person_name = cursor.fetchone()[0]

    ws_server.send_message_to_all(json.dumps({"id": person_id, "name": person_name}))

def recognize_faces():
    video_capture = cv2.VideoCapture(0)

    while True:
        ret, frame = video_capture.read()

        small_frame = cv2.resize(frame, (0, 0), fx=0.25, fy=0.25)

        rgb_small_frame = small_frame[:, :, ::-1]

        face_locations = face_recognition.face_locations(rgb_small_frame)
        face_encodings = face_recognition.face_encodings(rgb_small_frame, face_locations)

        for (top, right, bottom, left), face_encoding in zip(face_locations, face_encodings):
            matches = face_recognition.compare_faces(known_face_encodings, face_encoding, tolerance=0.6)
            face_distances = face_recognition.face_distance(known_face_encodings, face_encoding)
            best_match_index = np.argmin(face_distances)

            if matches[best_match_index]:
                person_id = known_face_person_ids[best_match_index]
                mark_attendance(person_id)

                # Scale the face locations back up
                top *= 4
                right *= 4
                bottom *= 4
                left *= 4

                # Draw a box around the face
                cv2.rectangle(frame, (left, top), (right, bottom), (0, 255, 0), 2)

                # Draw text with person's name and ID
                text = f"ID: {person_id}"
                font = cv2.FONT_HERSHEY_SIMPLEX
                cv2.putText(frame, text, (left, top - 10), font, 0.9, (0, 255, 0), 2)

        cv2.imshow('Video', frame)

        if cv2.waitKey(1) & 0xFF == ord('q'):
            break

    video_capture.release()
    cv2.destroyAllWindows()

def new_client(client, server):
    print("New client connected and was given id %d" % client['id'])

def client_left(client, server):
    print("Client(%d) disconnected" % client['id'])

def message_received(client, server, message):
    if message == "mark_attendance":
        recognize_faces()

ws_server = WebsocketServer(port=5000, host='0.0.0.0')
ws_server.set_fn_new_client(new_client)
ws_server.set_fn_client_left(client_left)
ws_server.set_fn_message_received(message_received)

known_face_encodings, known_face_ids, known_face_person_ids = get_known_faces()

def start_ws_server():
    ws_server.run_forever()

def message_received(client, server, message):
    print(f"Message received: {message}")
    if message == "mark_attendance":
        recognize_faces()

t = threading.Thread(target=start_ws_server)
t.start()
recognize_faces()

