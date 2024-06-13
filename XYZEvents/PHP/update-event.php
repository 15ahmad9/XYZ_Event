<?php
include 'mysqli_connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $organizerID = $_SESSION['ID'];
    $eventID = $_POST['EventID'];
    $name = $_POST['Name'];
    $type = $_POST['Type'];
    $capacity = $_POST['Capacity'];
    $location = $_POST['Location'];
    $description = $_POST['Description'];
    $ticketPrice = $_POST['TicketPrice'];

    $updates = array();

    if (!empty($name)) {
        $updates[] = "name = '$name'";
    }
    if (!empty($type)) {
        $updates[] = "type = '$type'";
    }
    if (!empty($capacity)) {
        $updates[] = "capacity = '$capacity'";
    }
    if (!empty($location)) {
        $updates[] = "locations = '$location'";
    }
    if (!empty($description)) {
        $updates[] = "description = '$description'";
    }
    if (!empty($ticketPrice)) {
        $updates[] = "ticketPrice = '$ticketPrice'";
    }

    if (!empty($updates)) {
        $sqlEvent = "UPDATE event 
                     SET " . implode(", ", $updates) . "
                     WHERE ID = '$eventID' AND organizerID = '$organizerID'";
        $resultEvent = mysqli_query($connection, $sqlEvent);
    }

    header('Location: ../PHP/organizer-homepage.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Event</title>
    <link rel="stylesheet" href="../CSS/style.css">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background: url(../img/wall.jpg) no-repeat;
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
            /* background-color: #f8f8f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; */
        }

        .boody{
            /* background-color: #f8f8f8; */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 400px;
            max-width: 90%;
            margin-top: auto;
        }

        .form-container h2 {
            margin-bottom: 30px;
            text-align: center;
            color: #333333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #555555;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #dddddd;
            border-radius: 5px;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #3498db;
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background-color: #3498db;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #2980b9;
        }

        header {
                background-color: #0c0234;
                color: #fff;
                padding: 20px 0;
            }

            .containerh {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 20px;
                display: flex;
                justify-content: space-between;
    align-items: center;
            }

            .form-container button{
            background-color: #0c0234;
        }

        .form-container button:hover {
            background-color: #0c0234db;
        }

    </style>
</head>
<header>
            <div class="containerh">
                <h1>XYZ Events</h1>
                <nav>
                    <ul>
                        <li><a href="../PHP/homepage.php">Home</a></li>
                        <!-- <li><a href="#about">About</a></li> -->
                        <!-- <li><a href="../PHP/event-booking.php">Event Booking</a></li> -->
                        <!-- <li><a href="#contact">Contact</a></li> -->
                        <!-- <li><a href="../PHP/index.php">Logout</a></li> -->
                    </ul>
                </nav>
            </div>
        </header>
<body>
<div class="boody">
    <div class="form-container">
        <h2>Update Event</h2>
        <form action="update-event.php" method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="Name" placeholder="Enter Event Name">
            </div>
            <div class="form-group">
                <label for="name">Type</label>
                <input type="text" id="type" name="Type" placeholder="Enter Event Type">
            </div>
            <div class="form-group">
                <label for="">Capacity</label>
                <input type="text" id="email" name="Capacity" placeholder="Enter Capacity">
            </div>
            <div class="form-group">
                <label for="">Location</label>
                <input type="text" id="password" name="Location" placeholder="Enter Location">
            </div>
            <div class="form-group">
                <label for="phone">Description</label>
                <input type="text" id="phone" name="Description" placeholder="Enter Event Description">
            </div>
            <div class="form-group">
                <label for="phone">TicketPrice</label>
                <input type="text" id="phone" name="TicketPrice" placeholder="Enter Ticket Price">
            </div>
            <div class="form-group">
                <label for="">Event ID</label>
                <input type="text" id="phone" name="EventID" placeholder="Enter Event ID">
            </div>
            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </div></div>
</body>
</html>



