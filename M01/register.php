<?php
session_start();
include('connect.php');

$error = "";
$success = "";

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];

    $checkQuery = "SELECT * FROM users WHERE username='$username' OR email='$email'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        $error = "Username or email already exists.";
    } else {
        $insertUserQuery = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
        if (mysqli_query($conn, $insertUserQuery)) {
            $userID = mysqli_insert_id($conn); 

            $insertUserInfoQuery = "INSERT INTO userinfo (userID, firstName, lastName) VALUES ('$userID', '$firstName', '$lastName')";
            if (mysqli_query($conn, $insertUserInfoQuery)) {
                $success = "Registration successful. You can now log in.";
            } else {
                $error = "Failed to register user information.";
            }
        } else {
            $error = "Failed to register user.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #141414;
        }

        .register-container {
            width: 100%;
            max-width: 320px;
            padding: 2rem;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1),
                        0 0 15px rgba(255, 105, 180, 0.5),
                        0 0 30px rgba(255, 105, 180, 0.5);
            text-align: center;
        }

        h2 {
            color: pink;
            font-family: 'Georgia', serif;
            font-size: 36px;
            margin-bottom: 1.5rem;
        }

        .form-input {
            width: 100%;
            padding: 0.8rem;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            box-sizing: border-box;
            outline: none;
        }

        .btn-register {
            width: 100%;
            padding: 0.8rem;
            background-color: #FF69B4;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s, box-shadow 0.3s;
            box-shadow: 0 0 10px rgba(255, 105, 180, 0.6), 0 0 20px rgba(255, 105, 180, 0.4);
        }

        .btn-register:hover {
            background-color: #FF1493;
            box-shadow: 0 0 20px rgba(255, 105, 180, 0.8), 0 0 30px rgba(255, 105, 180, 0.6);
        }

        .message {
            font-size: 0.9rem;
            margin-top: 1rem;
        }

        .error-message {
            color: red;
        }

        .success-message {
            color: green;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Register</h2>
        <form action="register.php" method="POST">
            <input type="text" name="username" placeholder="Username" class="form-input" required>
            <input type="password" name="password" placeholder="Password" class="form-input" required>
            <input type="email" name="email" placeholder="Email" class="form-input" required>
            <input type="text" name="firstName" placeholder="First Name" class="form-input" required>
            <input type="text" name="lastName" placeholder="Last Name" class="form-input" required>
            <button type="submit" name="register" class="btn-register">Register</button>
        </form>
        <?php if ($error): ?>
            <p class="message error-message"><?php echo $error; ?></p>
        <?php elseif ($success): ?>
            <p class="message success-message"><?php echo $success; ?></p>
            <p><a href="index.php">Go to Login</a></p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
