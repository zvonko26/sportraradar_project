<?php
include('db.php');

// Get the event_id from the query string
if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];

    // SQL query to get the event details
    $sql = "SELECT events.event_id, events.event_date, events.event_time, sports.sport_name, events.team_1, events.team_2, venues.venue_name 
            FROM events 
            JOIN sports ON events.sport_id = sports.sport_id 
            JOIN venues ON events.venue_id = venues.venue_id
            WHERE events.event_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $event_id);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $event = $result->fetch_assoc();
        echo json_encode($event); // Return the event details as a JSON object
    } else {
        echo json_encode(null); // No event found
    }
}
