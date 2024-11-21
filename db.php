<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_date = $_POST['event_date'];
    $event_time = $_POST['event_time'];
    $sport_id = $_POST['sport_id'];
    $team_1 = $_POST['team_1'];
    $team_2 = $_POST['team_2'];
    $venue_id = $_POST['venue_id'];

    $sql = "INSERT INTO events (event_date, event_time, sport_id, team_1, team_2, venue_id) 
            VALUES ('$event_date', '$event_time', '$sport_id', '$team_1', '$team_2', '$venue_id')";

    if ($conn->query($sql) === TRUE) {
        echo "New event created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
