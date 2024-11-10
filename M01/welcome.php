<?php
  session_start();
  if (!isset($_SESSION['username'])) {
      header("Location: index.php");
      exit();
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
        .btn-logout {
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
        .btn-logout:hover {
            background-color: #FF1493;
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
        <a href="logout.php" class="btn btn-logout">Logout</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>