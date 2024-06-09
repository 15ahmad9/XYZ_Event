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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $organizerID = $_SESSION['ID'];
    $eventID = $_POST['eventID'];

    $sqlEvent = "INSERT INTO booking (EventID, AttendeeID) VALUES ('$eventID', '$attendeeID')";
    $resultEvent = mysqli_query($connection, $sqlEvent);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XYZ Events</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

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
    align-items: center;
            }

            #events{
                background: url(../img/wall.jpg) no-repeat;
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
            }

        .event-list a {
            margin-right: 20px;
        }

        .event-list{
                margin: 0 50px;
    gap: 35px;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-auto-rows: auto;
    grid-gap: 1rem;
            }

            .edit-a{
                font-size: 1.1rem;
    color: #666;
    display: flex;
    justify-content: space-evenly;
            }

            .edit-a a{
                padding: 10px 20px;
    background-color: #fff;
    color: #000;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
            }

            footer {
    background-color: #0c0234;
    color: #fff;
    padding: 20px 0;
    text-align: center;
}

.event-card button {
    padding: 10px 20px;
    background-color: #0c0234;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
    </style>
</head>

<body>
    <header>
        <div class="container">
            <h1>XYZ Events (Organizer)</h1>
            <nav>
                <ul>
                    <li><a href="../PHP/homepage.php">Home</a></li>
                    <li><a href="../PHP/organizer-login.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section id="events">
        <div class="container1" style="text-align:center;">
            <h2>Upcoming Events</h2>
            <div class="event-list">
                <?php foreach ($events as $event) : ?>
                    <div class="event-card">
                        <h3><?php echo $event['Name']; ?></h3>
                        <p>Type: <?php echo $event['Type']; ?></p>
                        <p>Location: <?php echo $event['Locations']; ?></p>
                        <p>Description: <?php echo $event['Description']; ?></p>
                        <p>Capacity: <?php echo $event['Capacity']; ?></p>
                        <p>Ticket Price: <?php echo $event['TicketPrice']; ?></p>
                    </div>
                   
                <?php endforeach; ?>
                </div> 
                <div class="edit-a">
                <a href="add-event.php">Add Event</a>
                <a href="update-event.php">Update Event</a>
                <a href="delete-event.php">Delete Event</a>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>Copyright &copy; All rights reserved to XYZ Events</p>
            <nav>
                <ul>
                    <li><a href="#home">Home</a></li>
                    <!-- <li><a href="#about">About</a></li> -->
                    <li><a href="../PHP/event-booking.php">Event Booking</a></li>
                    <!-- <li><a href="#contact">Contact</a></li> -->
                </ul>
            </nav>
        </div>
    </footer>

</body>

</html>