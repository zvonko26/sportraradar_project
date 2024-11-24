<?php
include('db.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $event_date = $_POST['event_date'];
    $event_time = $_POST['event_time'];
    $sport_id = $_POST['sport_id'];
    $team_1 = $_POST['team_1'];
    $team_2 = $_POST['team_2'];
    $venue_id = $_POST['venue_id'];

    // Insert the event into the database
    $sql = "INSERT INTO events (event_date, event_time, sport_id, team_1, team_2, venue_id) 
            VALUES ('$event_date', '$event_time', '$sport_id', '$team_1', '$team_2', '$venue_id')";

    if ($conn->query($sql) === TRUE) {
        echo "New event created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-4">
        <h2>Add New Event</h2>

        <form method="POST" action="add_event.php">
            <div class="mb-3">
                <label for="event_date" class="form-label">Event Date</label>
                <input type="date" class="form-control" name="event_date" required>
            </div>
            <div class="mb-3">
                <label for="event_time" class="form-label">Event Time</label>
                <input type="time" class="form-control" name="event_time" required>
            </div>
            <div class="mb-3">
                <label for="sport_id" class="form-label">Sport</label>
                <select class="form-select" name="sport_id" required>
                    <option value="1">Football</option>
                    <option value="2">Ice Hockey</option>
                    <option value="3">Basketball</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="team_1" class="form-label">Team 1</label>
                <input type="text" class="form-control" name="team_1" placeholder="Enter Team 1" required>
            </div>
            <div class="mb-3">
                <label for="team_2" class="form-label">Team 2</label>
                <input type="text" class="form-control" name="team_2" placeholder="Enter Team 2" required>
            </div>
            <div class="mb-3">
                <label for="venue_id" class="form-label">Venue</label>
                <select class="form-select" name="venue_id" required>
                    <option value="1">Stadium A</option>
                    <option value="2">Arena B</option>
                    <option value="3">Court C</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add Event</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>

</html>