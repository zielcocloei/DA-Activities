<?php
session_start();
include('connect.php');

$error = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = executeQuery($query);

    if (mysqli_num_rows($result) == 1) {
        
        $_SESSION['username'] = $username;
        header("Location: welcome.php");
        exit();
    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    
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

        #particles-js {
            position: fixed;
            width: 100%;
            height: 100%;
            z-index: -1;
            top: 0;
            left: 0;
        }

        .login-container {
            width: 100%;
            max-width: 320px;
            padding: 2rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1),
                0 0 15px rgba(255, 105, 180, 0.5),
                0 0 30px rgba(255, 105, 180, 0.5);
            background-color: #fff;
            border-radius: 8px;
            text-align: center;
        }

        h2 {
            margin-bottom: 1.5rem;
            font-weight: normal;
            color: #333;
        }

        .form-input {
            width: 100%;
            padding: 0.8rem;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            outline: none;
            box-sizing: border-box;
        }

        .form-input:focus {
            border-color: #007BFF;
        }

        .btn-login {
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

        .btn-login:hover {
            background-color: #FF1493;
            box-shadow: 0 0 20px rgba(255, 105, 180, 0.8), 0 0 30px rgba(255, 105, 180, 0.6);
        }

        .error-message {
            color: red;
            font-size: 0.9rem;
            margin-top: 1rem;
        }
    </style>
</head>

<body>
    <div id="particles-js"></div>
    <div class="login-container">
    <h2 style="color: pink; font-family: 'Georgia', serif; font-size: 36px; font-weight: normal;">ChitChat</h2>
        <form action="index.php" method="POST">
            <input type="text" name="username" placeholder="Username" class="form-input" required>
            <input type="password" name="password" placeholder="Password" class="form-input" required>
            <button type="submit" name="login" class="btn-login">Login</button>
        </form>
        <?php if ($error): ?>
            <p class="error-message"><?php echo $error; ?></p>
        <?php endif; ?>
    </div>

   
    <script>
        particlesJS.load('particles-js', 'particles.json', function() {
            console.log('particles.js loaded - pink theme');
        });
    </script>
</body>

</html>
