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
                justify-content: space-between;
    align-items: center;
            }

            /* .home {
                max-width: 1200px;
                margin: 0 auto;
                padding: 25px;
                background-color: rgba(225, 225, 225, 0.7);
                border-radius: 1rem;
            } */

            .home h1 {
                justify-content: center;
                margin: 20px 0 20px 20px;
                color: black;
                font-size: 2em;
                letter-spacing: 1px;
                padding-top: 70px;
                text-shadow: 1.8px 1.8px #a800ff;
            }

            .home h2 {
                display: flex;
                justify-content: center;
                align-items: center;
                margin: 20px 0 20px 20px;
                color: black;
                font-size: 1.7em;
                letter-spacing: 1px;
                padding-top: 20px;
                text-shadow: 1.8px 1.8px #a800ff;
            }

            .home img {
                width: 400px;
                height: 350px;
                padding-right: 10px;
            }

            .bg {
                background-color: rgba(225, 225, 225, 0.6);
                border-radius: 1rem;
                display: flex;
                justify-content: space-around;
            }

            #home {
                background: url(../img/wall.jpg) no-repeat;
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
                padding: 80px 130px 80px 130px;

            }

            .about {
                background-color: rgba(151, 153, 186, 0.6);
                display: flex;
                max-width: 100%;
            }

            .about h1 {
                display: flex;

                color: black;
                font-size: 2em;
                letter-spacing: 1px;
                padding-left: 50px;
                text-shadow: 1.1px 1.1px #a800ff;
            }

            .about p {
                display: flex;
                justify-content: center;
                margin: 15px;
                font-size: 1.4em;
                letter-spacing: .5px;
                padding-left: 50px;
                text-shadow: 0.5px 1px rgb(255 255 255);
            }

            .about img {
                width: 550px;
                height: 400px;
                float: left;
                margin-top: 40px;
            }

            .event-list{
                margin: 0 50px;
    gap: 35px;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-auto-rows: auto;
    grid-gap: 1rem;
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

#contact button{
    background-color: #0c0234;
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
                        <li><a href="#about">About</a></li>
                        <li><a href="../PHP/event-booking.php">Event Booking</a></li>
                        <li><a href="#contact">Contact</a></li>
                        <li><a href="../PHP/index.php">Log</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        <section id="home" class="home">
            <div class="bg">
                <div class="welcome">
                    <h1>Welcome to XYZ Events</h1>
                    <h2>A renowned event management company</h2>
                </div>
                <img src="../img/thumb.png" alt="">
            </div>
        </section>

        <section id="about" class="about">
            <div class="container2">
                <img src="../img/thumb.png" alt="">
                <h1>About Us</h1>
                <p align="justify">XYZ Events, a renowned event management company is set to the with an innovative
                    Event
                    Management System
                    (EMS) aimed at streamlining event organization. This EMS will harness advanced technology and best
                    practices to tackle challenges such as resource allocation, team communication, data analysis,
                    attendee
                    engagement, and regulatory compliance. Featuring a user-friendly interface with a navigation bar and
                    footer, the system will allow organizers to create accounts and manage events with detailed
                    specifications, including event name, date, location, capacity, and description. A comprehensive
                    list of
                    available events will prevent scheduling conflicts, enhancing planning efficiency. Attendees can
                    register by providing personal details, selecting their desired event, and choosing ticket types
                    with
                    associated prices. This robust EMS will not only improve XYZ Events' management capabilities but
                    also
                    deliver exceptional value to clients, setting new benchmarks in event coordination.</p>
            </div>
        </section>

        <section id="events">
            <div class="container3" style="text-align:center;">
                <h2>Upcoming Events</h2>
                <div class="event-list">
                    <?php foreach ($events as $event): ?>
                        <div class="event-card">
                            <h3><?php echo $event['Name']; ?></h3>
                            <p>Type: <?php echo $event['Type']; ?></p>
                            <p>Location: <?php echo $event['Locations']; ?></p>
                            <p>Description: <?php echo $event['Description']; ?></p>
                            <p>Capacity: <?php echo $event['Capacity']; ?></p>
                            <p>Ticket Price: <?php echo $event['TicketPrice']; ?></p>
                            <?php if ($_SESSION['ID']): ?>
                                <form method="POST" action="homepage.php">
                                    <input type="hidden" name="eventID" value="<?php echo $event['ID']; ?>">
                                    <button type="submit">Book Event</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section id="contact">
            <div class="container">
                <h2>Contact Us</h2>
                <form id="contact-form">
                    <input type="text" placeholder="Your Name" required>
                    <input type="email" placeholder="Your Email" required>
                    <textarea placeholder="Your Message" required></textarea>
                    <button type="submit">Send Message</button>
                </form>
            </div>
        </section>

        <footer>
            <div class="container">
                <p>Copyright &copy; All rights reserved to XYZ Events</p>
                <nav>
                    <ul>
                        <li><a href="#home">Home</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="../PHP/event-booking.php">Event Booking</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </nav>
            </div>
        </footer>

        <script src="../JS/script.js"></script>
    </body>

    </html>