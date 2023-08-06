(async function() {
    const video = document.getElementById('video');
    const captureButton = document.getElementById('capture');
    const studentIDInput = document.getElementById('student_id');
    const studentList = document.getElementById('student-list');
    const attendanceList = document.getElementById('attendance-list');

    // Load the face detection and face recognition models
    await faceapi.nets.tinyFaceDetector.loadFromUri('/smartAtt/test/models');
    await faceapi.nets.faceLandmark68Net.loadFromUri('/smartAtt/test/models');
    await faceapi.nets.faceRecognitionNet.loadFromUri('/smartAtt/test/models');

    // Start the webcam stream
    navigator.mediaDevices.getUserMedia({ video: {} })
        .then((stream) => {
            video.srcObject = stream;
        });

    try {
        // Load the stored face encodings from the database
        const response = await fetch('get_encodings.php');
        const encodings = await response.json();

        // Add the students to the list
        encodings.forEach((encoding) => {
            const studentListItem = document.createElement('li');
            studentListItem.textContent = `${encoding.name} (${encoding.id})`;
            studentList.appendChild(studentListItem);
        });
    } catch (e) {
        console.error(e);
    }

    // Capture the face encoding when the button is clicked
    captureButton.addEventListener('click', async () => {
        const detections = await faceapi.detectAllFaces(video, new faceapi.TinyFaceDetectorOptions())
            .withFaceLandmarks()
            .withFaceDescriptors();

        if (detections.length > 0) {
            // Get the captured face encoding
            const faceEncoding = detections[0].descriptor;

            // Compare the captured face encoding to the stored face encodings
            let matchFound = false;
            encodings.forEach((encoding) => {
                const storedFaceEncoding = Float32Array.from(Object.values(encoding.face_encoding));
                const distance = faceapi.euclideanDistance(faceEncoding, storedFaceEncoding);

                if (distance < 0.6) {
                    // The captured face matches the stored face, so mark attendance for the student
                    matchFound = true;
                    markAttendance(encoding.id);
                    studentIDInput.value = '';
                }
            });

            if (!matchFound) {
                console.log('No matching faces found');
            }
        } else {
            console.log('No faces detected');
        }
    });

    function markAttendance(studentID) {
        $.ajax({
            url: 'mark_attendance.php',
            type: 'POST',
            data: { student_id: studentID },
            dataType: 'json',
            success: function(response) {
                const studentName = response.name;
                const studentID = response.id;

                const attendanceListItem = document.createElement('li');
                attendanceListItem.textContent = `${studentName} (${studentID})`;
                attendanceList.appendChild(attendanceListItem);
            },
            error: function(xhr, status, error) {
                console.error('An error occurred while sending the AJAX request');
                console.error(xhr.responseText);
                console.error(status);
                console.error(error);
            }
        });
    }
})();
