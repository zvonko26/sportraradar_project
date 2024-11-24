<?php
include('db.php');

// SQL query to fetch events
$sql = "SELECT events.event_id, events.event_date, events.event_time, sports.sport_name, events.team_1, events.team_2, venues.venue_name 
        FROM events
        JOIN sports ON events.sport_id = sports.sport_id
        JOIN venues ON events.venue_id = venues.venue_id
        ORDER BY events.event_date ASC, events.event_time ASC"; // Sorting events by date

$result = $conn->query($sql);

// Check if the query returned any events
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col-md-4 mb-4" id="event_' . $row["event_id"] . '">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">' . htmlspecialchars($row["sport_name"]) . '</h5>
                        <h6 class="card-subtitle mb-2 text-muted">' . htmlspecialchars($row["event_date"]) . ' - ' . htmlspecialchars($row["event_time"]) . '</h6>
                        <p class="card-text">' . htmlspecialchars($row["team_1"]) . ' vs ' . htmlspecialchars($row["team_2"]) . '</p>
                        <p class="card-text">Venue: ' . htmlspecialchars($row["venue_name"]) . '</p>
                        <button class="btn btn-danger" onclick="deleteEvent(' . $row["event_id"] . ')">Delete</button>
                    </div>
                </div>
              </div>';
    }
} else {
    echo "<p>No events found.</p>";
}
