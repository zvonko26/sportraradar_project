document.addEventListener('DOMContentLoaded', function () {

    // Fetch and display events on page load
    fetch('get_events.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('events-container').innerHTML = data;
        })
        .catch(error => console.log('Error fetching events:', error));

    // Apply filters based on user selection
    function applyFilters() {
        const sortFilter = document.getElementById('sortFilter').value;

        let events = Array.from(document.querySelectorAll('.card'));

        // Sort by date
        if (sortFilter === 'date_1_10') {
            events.sort((a, b) => {
                const dateA = new Date(a.querySelector('.card-subtitle').textContent.split(" - ")[0]);
                const dateB = new Date(b.querySelector('.card-subtitle').textContent.split(" - ")[0]);
                return dateA - dateB;  // Sort from earliest to latest
            });
        } else if (sortFilter === 'date_10_1') {
            events.sort((a, b) => {
                const dateA = new Date(a.querySelector('.card-subtitle').textContent.split(" - ")[0]);
                const dateB = new Date(b.querySelector('.card-subtitle').textContent.split(" - ")[0]);
                return dateB - dateA;  // Sort from latest to earliest
            });
        } else if (sortFilter === 'sport') {
            // Sort by sport (alphabetically)
            events.sort((a, b) => {
                const sportA = a.querySelector('.card-title').textContent.trim();
                const sportB = b.querySelector('.card-title').textContent.trim();
                return sportA.localeCompare(sportB);  // Sort alphabetically by sport
            });
        }

        // Clear the events container and add the filtered events back
        document.getElementById('events-container').innerHTML = '';
        events.forEach(event => {
            document.getElementById('events-container').appendChild(event);
        });
    }

    // Add event listener to sort elements
    document.getElementById('sortFilter').addEventListener('change', applyFilters);

    // Event listener for Add Event Form Submission
    document.getElementById('addEventForm').addEventListener('submit', function (e) {
        e.preventDefault();  // Prevent form from submitting normally

        const formData = new FormData(e.target);

        // Send the form data to server
        fetch('add_event.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(data => {
                if (data.includes("New event created successfully")) {
                    alert("Event added successfully!");
                    window.location.href = "index.html";
                } else {
                    console.error('Failed to add event');
                }
            })
            .catch(error => console.error('Error adding event:', error));
    });

    // Event listener for Details button to show event details in modal
    document.getElementById('events-container').addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('btn-info')) {
            const eventId = e.target.getAttribute('data-id');

            // Fetch event details and display them in modal
            fetch(`get_details.php?event_id=${eventId}`)
                .then(response => response.json())
                .then(data => {
                    if (data) {
                        // Inject event details into the modal
                        document.getElementById('event-sport').textContent = data.sport_name;
                        document.getElementById('event-teams').textContent = `${data.team_1} vs ${data.team_2}`;
                        document.getElementById('event-date').textContent = data.event_date;
                        document.getElementById('event-time').textContent = data.event_time;
                        document.getElementById('event-venue').textContent = data.venue_name;

                        // Show the modal with event details
                        const modal = new bootstrap.Modal(document.getElementById('eventDetailsModal'));
                        modal.show();
                    } else {
                        console.error('Event not found');
                    }
                })
                .catch(error => console.log('Error fetching event details:', error));
        }
    });

    // Event listener for delete button
    document.getElementById('events-container').addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('delete-event')) {
            const eventId = e.target.getAttribute('data-id');


            if (confirm('Are you sure you want to delete this event?')) {
                fetch('delete_event.php', {
                    method: 'POST',
                    body: new URLSearchParams({ 'event_id': eventId })
                })
                    .then(response => response.text())
                    .then(data => {

                        alert("Event deleted successfully!");
                        e.target.closest('.col-md-4').remove();
                    })
                    .catch(error => console.log('Error deleting event:', error));
            }
        }
    });
});
