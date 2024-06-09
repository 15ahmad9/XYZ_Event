<?php
include 'mysqli_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name'], $_POST['password'], $_POST['email'], $_POST['phoneNumber'])) {
        $name = $_POST['name'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $phoneNumber = $_POST['phoneNumber'];

        $checkStmt = $connection->prepare("SELECT COUNT(*) FROM attendee WHERE name = ? AND password = ?");
        $checkStmt->bind_param("ss", $name, $password);
        $checkStmt->execute();
        $checkStmt->bind_result($row);
        $checkStmt->fetch();
        $checkStmt->close();

        if ($row > 0) {
            echo "Username or password already in system.";
        } else {
            $stmt = $connection->prepare("INSERT INTO attendee (name, email, phoneNumber, password) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $email, $phoneNumber, $password);
            if ($stmt->execute()) {
                header('Location: ../PHP/index.php');
                exit;
            } else {
                die("Error inserting data: " . $connection->error);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="../CSS/style.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f3f3;
            margin: 0;
            padding: 0;
            background: url(../img/wall.jpg) no-repeat;
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .register-form {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        .register-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group input {
            width: 95%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-group button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #0c0234;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }


        .form-group button:hover {
            background-color: #0c0234db;
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
                justify-content: space-between;
    align-items: center;
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
    <div class="container">
        <form class="register-form" action="register.php" method="POST">
            <h2>Register</h2>
            <div class="form-group">
                <input type="text" name="name" placeholder="Your Name" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Your Password" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="Your Email" required>
            </div>
            <div class="form-group">
                <input type="text" name="phoneNumber" placeholder="Your Phone Number" required>
            </div>
            <div class="form-group">
                <button type="submit">Register</button>
            </div>
        </form>
    </div>
</body>

</html>
