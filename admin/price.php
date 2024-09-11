<?php
session_start();

// Check if the user is logged in and is an admin, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== 'admin'){
    header("location: login.php");
    exit;
}

require_once "../config.php"; // Include the database configuration file

// SQL query to count the number of admin users
$sql_admins = "SELECT COUNT(*) as admin_count FROM users WHERE role='admin'";
$sql_users = "SELECT COUNT(*) as user_count FROM users";

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
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="file"] {
            margin-top: 10px;
        }
        button {
            display: block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
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
                        <span class="title">post</span>
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
        <form action="../post/upload.php" method="post" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required placeholder="Enter the title of your post"><br><br>

        <label for="content">Content:</label>
        <textarea id="content" name="content" required placeholder="Write your blog post here"></textarea><br><br>

        <label for="media">Upload an Image or Video:</label>
        <input type="file" id="media" name="media" accept="image/*,video/*" required><br><br>

        <button type="submit">Submit</button>
    </form>
                    
                
                </div>
            </div>
        </div>
    </div>
    <script src="main.js"></script>
</body>
</html>