<?php
include('db.php');

// Get event ID from the request
$event_id = $_POST['event_id'];

// SQL query to delete the event
$sql = "DELETE FROM events WHERE event_id = $event_id";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["status" => "success", "message" => "Event deleted successfully"]);
} else {
    echo json_encode(["status" => "error", "message" => "Error deleting event"]);
}
