<?php
session_start();

// Check if the user is logged in and is an admin, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== 'admin'){
    header("location: login.php");
    exit;
}

require_once "config.php";

// Define a timeframe (e.g., last 5 minutes) to consider users as online
$timeframe = 5; // in minutes

// Fetch users who have been active within the last 5 minutes
$sql = "SELECT username, last_activity FROM users WHERE last_activity > DATE_SUB(NOW(), INTERVAL ? MINUTE)";
if($stmt = mysqli_prepare($link, $sql)){
    mysqli_stmt_bind_param($stmt, "i", $timeframe);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $username, $last_activity);
    mysqli_stmt_store_result($stmt);
    
    // Check if there are any users online
    if(mysqli_stmt_num_rows($stmt) > 0){
        echo "<h2>Users Online</h2>";
        echo "<table class='table'>";
        echo "<thead><tr><th>Username</th><th>Last Activity</th></tr></thead>";
        echo "<tbody>";
        while(mysqli_stmt_fetch($stmt)){
            echo "<tr><td>" . htmlspecialchars($username) . "</td><td>" . $last_activity . "</td></tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>No users are online.</p>";
    }

    // Close statement
    mysqli_stmt_close($stmt);
} else {
    echo "Oops! Something went wrong. Please try again later.";
}

// Close connection
mysqli_close($link);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Users Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h2>Users Online</h2>
        <p><a href="admin/index2.php" class="btn btn-primary">Back to Dashboard</a></p>
    </div>
</body>
</html>
