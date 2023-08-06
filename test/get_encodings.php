<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mark Attendance</title>
</head>
<body>
    <h1>Mark Attendance</h1>
    <div id="attendee-info">
        <p>Name: <span id="attendee-name"></span></p>
        <p>ID: <span id="attendee-id"></span></p>
    </div>
    
    <script>
        const attendeeNameElem = document.getElementById('attendee-name');
        const attendeeIdElem = document.getElementById('attendee-id');

        // Initialize a WebSocket connection to receive recognized faces from the Python script
        const socket = new WebSocket('ws://localhost:5000');

        // Connection opened
        socket.addEventListener('open', (event) => {
            console.log('WebSocket connection opened:', event);
        });

        // Listen for messages
        socket.addEventListener('message', (event) => {
            console.log('Message from server:', event.data);
            const data = JSON.parse(event.data);
            attendeeNameElem.textContent = data.name;
            attendeeIdElem.textContent = data.id;
        });

        // Connection closed
        socket.addEventListener('close', (event) => {
            console.log('WebSocket connection closed:', event);
        });

        // Connection error
        socket.addEventListener('error', (event) => {
            console.log('WebSocket error:', event);
        });
    </script>
</body>
</html>
