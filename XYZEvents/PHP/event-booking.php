<?php
include 'mysqli_connection.php';
session_start();
$events = [];

$query = "SELECT * FROM event";
$result = mysqli_query($connection, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $events[] = $row;
}
$attendeeID = $_SESSION["ID"];
$eventquery = "SELECT event.ID AS eventID, event.name, event.type, event.TicketPrice 
               FROM booking 
               INNER JOIN event ON booking.eventID = event.ID 
               WHERE booking.attendeeID = $attendeeID";

$eventRecord_result = mysqli_query($connection, $eventquery);
$eventRecord = [];
while ($row = mysqli_fetch_assoc($eventRecord_result)) {
    $eventRecord[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Event History</title>
    <link rel="stylesheet" href="../CSS/style.css" />
    <style>
        /* Your CSS styles here */
        table {
            width: 85%;
            border-collapse: collapse;
            margin: 0 auto;
        }

        th,
        td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        header {
                background-color: #0c0234;
                color: #fff;
                padding: 20px 0;
            }

        .container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 20px;
                display: flex;
                justify-content: space-between;
                justify-content: space-between;
    align-items: center;
            }

    </style>
</head>

<body>
    <header>
        <div class="container">
            <h1>XYZ Events</h1>
            <nav>
                <ul>
                    <li><a href="../PHP/homepage.php">Home</a></li>
                    <!-- <li><a href="#about">About</a></li> -->
                    <li><a href="../PHP/event-booking.php">Event Booking</a></li>
                    <!-- <li><a href="#contact">Contact</a></li> -->
                    <li><a href="../PHP/index.php">Log</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <br>
        <table>
            <thead>
                <tr>
                    <th>Attendee ID</th>
                    <th>Event ID</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Ticket Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($eventRecord as $event) {
                    echo "<tr>";
                    echo "<td>{$_SESSION['ID']}</td>";
                    echo "<td>{$event['eventID']}</td>";
                    echo "<td>{$event['name']}</td>";
                    echo "<td>{$event['type']}</td>";
                    echo "<td>{$event['TicketPrice']}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </main>
</body>

</html>