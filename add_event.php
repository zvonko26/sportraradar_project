<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_date = $_POST['event_date'];
    $event_time = $_POST['event_time'];
    $sport_id = $_POST['sport_id'];
    $team_1 = $_POST['team_1'];
    $team_2 = $_POST['team_2'];
    $venue_name = $_POST['venue_name'];


    $sql_check_venue = "SELECT venue_id FROM venues WHERE venue_name = '$venue_name'";
    $result = $conn->query($sql_check_venue);
    if ($result->num_rows == 0) {

        $sql_insert_venue = "INSERT INTO venues (venue_name) VALUES ('$venue_name')";
        if ($conn->query($sql_insert_venue) === TRUE) {
            $venue_id = $conn->insert_id;
        } else {
            echo "Error: " . $conn->error;
            exit();
        }
    } else {

        $row = $result->fetch_assoc();
        $venue_id = $row['venue_id'];
    }


    $sql = "INSERT INTO events (event_date, event_time, sport_id, team_1, team_2, venue_id) 
            VALUES ('$event_date', '$event_time', '$sport_id', '$team_1', '$team_2', '$venue_id')";

    if ($conn->query($sql) === TRUE) {
        echo "New event created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
