<?php
include 'mysqli_connection.php';
session_start();

if (isset($_POST['name'], $_POST['password'])) {
    $name = $_POST['name'];
    $password = $_POST['password'];

    $stmt = $connection->prepare("SELECT * FROM attendee WHERE name = ? AND password = ?");
    $stmt->bind_param("ss", $name, $password);
    $stmt->execute();

    $result = $stmt->get_result();
    $attendee = $result->fetch_assoc();

    if ($attendee) {
        $_SESSION["name"] = $attendee["name"];
        $_SESSION["password"] = $attendee["password"];
        $_SESSION["email"] = $attendee["email"];
        $_SESSION["phoneNumber"] = $attendee["phoneNumber"];
        $_SESSION['ID'] = $attendee['ID'];
        header('Location: ../PHP/homepage.php');
        exit;
    } else {
        echo "Username or password are wrong";
    }
    $stmt->close();
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
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

        .login-form {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        .login-form h2 {
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
            background-color: #4CAF50;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-group button:hover {
            background-color: #0c0234db;
        }

        hr {
            margin: 20px 0;
            border: none;
            border-top: 1px solid #ccc;
        }

        .create-account-text {
            text-align: center;
            color: #888;
            font-size: 14px;
        }

        .create-account-text a {
            color: ##0c0234db;
            text-decoration: none;
        }

        .create-account-text a:hover {
            text-decoration: underline;
        }

        .form-group button{
            background-color: #0c0234;
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
        <form class="login-form" action="index.php" method="POST">
            <h2>Login</h2>
            <div class="form-group">
                <input type="text" name="name" placeholder="Your Name" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Your Password" required>
            </div>
            <input type="hidden" name="OrganizerID" value="<?php echo isset($_SESSION['ID']) ? $_SESSION['ID'] : ''; ?>">
            <div class="form-group">
                <button type="submit">Login</button>
            </div>
            <hr>
            <p class="create-account-text">Don't have an account? <a href="register.php">Create an account</a></p>
            <p class="create-account-text">Are you an organizer? <a href="organizer-login.php">Organizer Login</a></p>
        </form>

    </div>
</body>

</html>