<?php
session_start();
include('connect.php');


if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$error = "";
$show_password_field = false; 


if (isset($_POST['confirm_delete'])) {
    $show_password_field = true;
}

if (isset($_POST['delete_account'])) {
    $username = $_SESSION['username'];
    $entered_password = $_POST['password'];

    // Validate entered password
    $query = "SELECT password FROM users WHERE username = '$username'";
    $result = executeQuery($query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $stored_password = $row['password'];

        if ($entered_password === $stored_password) {
            // Password matches, delete the account
            $delete_query = "DELETE FROM users WHERE username = '$username'";
            $delete_result = executeQuery($delete_query);

            if ($delete_result) {
  
                session_destroy();
                header("Location: index.php?message=Account deleted successfully");
                exit();
            } else {
                $error = "Error deleting account. Please try again later.";
            }
        } else {
            $error = "Incorrect password. Account not deleted.";
        }
    } else {
        $error = "Error fetching account details. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            background-color: #e9ecef;
            color: #333;
        }
        .welcome-container {
            max-width: 400px;
            width: 100%;
            padding: 2rem;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            font-weight: 500;
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            color: #f603a3;
        }
        .btn {
            width: 100%;
            padding: 0.8rem;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s, box-shadow 0.3s;
            margin-top: 10px;
        }
        .btn-logout {
            background-color: #FF69B4;
            box-shadow: 0 0 10px rgba(255, 105, 180, 0.6), 0 0 20px rgba(255, 105, 180, 0.4);
        }
        .btn-logout:hover {
            background-color: #FF1493;
        }
        .btn-danger {
            background-color: #DC3545;
            box-shadow: 0 0 10px rgba(220, 53, 69, 0.6), 0 0 20px rgba(220, 53, 69, 0.4);
        }
        .btn-danger:hover {
            background-color: #C82333;
        }
        .error-message {
            color: red;
            font-size: 0.9rem;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
        
        <!-- Logout Button -->
        <a href="logout.php" class="btn btn-logout">Logout</a>
        
        <?php if ($show_password_field): ?>
            <!-- Password Verification Form -->
            <form action="welcome.php" method="POST">
                <div>
                    <label for="password">Retype your password to confirm deletion:</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <button type="submit" name="delete_account" class="btn btn-danger mt-3">
                    Confirm Account Deletion
                </button>
            </form>
        <?php else: ?>
            <!-- Delete Account Confirmation -->
            <form action="welcome.php" method="POST">
                <button type="submit" name="confirm_delete" class="btn btn-danger">
                    Delete My Account
                </button>
            </form>
        <?php endif; ?>

        <?php if ($error): ?>
            <p class="error-message"><?php echo $error; ?></p>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
