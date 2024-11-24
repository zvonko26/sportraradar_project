
function loadEvents() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'get_events.php', true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            // Insert events into the DOM
            document.getElementById('events-container').innerHTML = xhr.responseText;
        }
    };

    xhr.send();
}


document.getElementById('addEventForm').addEventListener('submit', function (e) {
    e.preventDefault();

    var formData = new FormData(document.getElementById('addEventForm'));
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'add_event.php', true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            alert('Event added successfully!');
            loadEvents(); // Reload the events after adding
            $('#addEventModal').modal('hide'); // Hide the modal
        } else {
            alert('Failed to add event.');
        }
    };

    xhr.send(formData);
});

// Function to delete event
function deleteEvent(event_id) {
    if (confirm("Are you sure you want to delete this event?")) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'delete_event.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function () {
            if (xhr.status === 200) {
                alert('Event deleted successfully!');
                document.getElementById('event_' + event_id).remove();
            } else {
                alert('Failed to delete event.');
            }
        };

        xhr.send("event_id=" + event_id);
    }
}


window.onload = loadEvents;
