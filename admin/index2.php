<?php
session_start();

// Check if the user is logged in and is an admin, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== 'admin'){
    header("location: login.php");
    exit;
}

require_once "../config.php"; // Include the database configuration file

// SQL query to count the number of admin users
$sql_admins = "SELECT COUNT(*) as admin_count FROM crypto WHERE role='admin'";
$sql_users = "SELECT COUNT(*) as user_count FROM crypto";

if ($result_admins = mysqli_query($link, $sql_admins)) {
    $row_admins = mysqli_fetch_assoc($result_admins);
    $_SESSION['admin_count'] = $row_admins['admin_count']; // Store the count in session
} else {
    echo "Error: " . mysqli_error($link);
}

if ($result_users = mysqli_query($link, $sql_users)) {
    $row_users = mysqli_fetch_assoc($result_users);
    $_SESSION['user_count'] = $row_users['user_count']; // Store the count in session
} else {
    echo "Error: " . mysqli_error($link);
}

// Do not close the connection here

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon"><i class='bx bx-book-open'></i></span>
                        <span style="padding-right: 100px;" class="title"> 
                            <h2><?php echo htmlspecialchars($_SESSION["username"]);?>(Admin)</h2>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="index2.php">
                        <span class="icon"><i class='bx bxs-dashboard'></i></span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="price.php">
                        <span class="icon"><i class='bx bx-group'></i></span>
                        <span class="title">Prices</span>
                    </a>
                </li>
                <li>
                    <a href="mail.php">
                        <span class="icon"><i class='bx bx-message-rounded-dots'></i></span>
                        <span class="title">Mail Customers</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><i class='bx bx-help-circle'></i></span>
                        <span class="title">Help</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><i class='bx bx-cog'></i></span>
                        <span class="title">Settings</span>
                    </a>
                </li>
                <li>
                    <a href="../admin_online_users.php">
                        <span class="icon"><i class='bx bxs-lock-alt'></i></span>
                        <span class="title">Online Users</span>
                    </a>
                </li>
                <li>
                    <a href="../logout.php">
                        <span class="icon"><i class='bx bx-log-in'></i></span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <i class='bx bx-menu'></i>
                </div>
                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <i class='bx bx-search'></i>
                    </label>
                </div>
                <div class="user">
                    <!-- User profile image or info -->
                </div>
            </div>

            <div class="cardbox">
                <div class="card">
                    <div>
                        <div class="numbers"><?php echo $_SESSION['user_count']; ?></div>
                        <div class="cardname">Registered Accounts</div>
                    </div>
                    <div class="iconbx">
                        <i class='bx bx-show'></i>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers"><?php echo $_SESSION['admin_count']; ?></div>
                        <div class="cardname">Admins</div>
                    </div>
                    <div class="iconbx">
                        <i class='bx bx-cart'></i>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers">205</div>
                        <div class="cardname">Comments</div>
                    </div>
                    <div class="iconbx">
                        <i class='bx bx-chat'></i>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers">Premium</div>
                        <div class="cardname">$7,542</div>
                    </div>
                    <div class="iconbx">
                        <i class='bx bx-money'></i>
                    </div>
                </div>
            </div>

            <div class="details">
                <div class="recentorders" style="width: 100%;">
                    <div class="cardheader">
                        <h2>Recent Bookings</h2>
                        <a href="#" class="btn">View All</a>
                    </div>

                    <div class="mt-5 mb-3 clearfix">
                        <a href="../registration.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Employee</a>
                    </div>
                    
                    <?php
                    // Include config file
                    require_once "../config.php";

                    // Attempt select query execution
                    $sql = "SELECT * FROM crypto";
                    if ($result = mysqli_query($link, $sql)) {
                        if (mysqli_num_rows($result) > 0) {
                            echo '<table class="table table-bordered table-striped">';
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>#</th>";
                            echo "<th>Name</th>";
                            echo "<th>Password</th>";
                            echo "<th>Role</th>";
                            echo "<th>Created At</th>";
                            echo "<th>Action</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['username'] . "</td>";
                                echo "<td>" . $row['password'] . "</td>";
                                echo "<td>" . $row['bitcoin'] . "</td>";
                                echo "<td>" . $row['ethereum'] . "</td>";
                                echo "<td>" . $row['bnb'] . "</td>";
                                echo "<td>" . $row['usdt'] . "</td>";
                                echo "<td>" . $row['role'] . "</td>";
                                echo "<td>" . $row['created_at'] . "</td>";
                                echo "<td>";
                                echo '<a style="padding: 5px;" href="read.php?id=' . $row['id'] . '" class="mr-3" title="View Record" data-toggle="tooltip">Read<span class="fa fa-eye"></span></a>';
                                echo '<a style="padding: 5px;" href="update.php?id=' . $row['id'] . '" class="mr-3" title="Update Record" data-toggle="tooltip">Update<span class="fa fa-pencil"></span></a>';
                                echo '<a style="padding: 5px;" href="delete.php?id=' . $row['id'] . '" title="Delete Record" data-toggle="tooltip">Delete<span class="fa fa-trash"></span></a>';
                                echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else {
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else {
                        echo "Oops! Something went wrong. Please try again later.";
                    }

                    // Close the database connection here after all queries are done
                    mysqli_close($link);
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script src="main.js"></script>
</body>
</html>
