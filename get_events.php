<?php
include('db.php');

$sql = "SELECT events.event_id, events.event_date, events.event_time, sports.sport_name, events.team_1, events.team_2, venues.venue_name 
        FROM events 
        JOIN sports ON events.sport_id = sports.sport_id 
        JOIN venues ON events.venue_id = venues.venue_id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col-md-4 mb-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">' . $row["sport_name"] . '</h5>
                        <h6 class="card-subtitle mb-2 text-muted">' . $row["event_date"] . ' - ' . $row["event_time"] . '</h6>
                        <p class="card-text">' . $row["team_1"] . ' vs ' . $row["team_2"] . '</p>
                        <p class="card-text">Venue: ' . $row["venue_name"] . '</p>
                    </div>
                </div>
              </div>';
    }
} else {
    echo "<p>No events found.</p>";
}
