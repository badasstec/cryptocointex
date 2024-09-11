<?php
session_start();

// Check if the user is logged in and is an admin, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== 'admin') {
    header("location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>admin dashboard</title>
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
                            <h2><?php echo htmlspecialchars($_SESSION["username"]); ?>(Admin)</h2>
                        </span>

                    </a>
                </li>
                <li>
                    <a href="index2.php">
                        <span class="icon"><i class='bx bxs-dashboard'></i></span>
                        <span class="title">dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="price.php">
                        <span class="icon"><i class='bx bx-group'></i></span>
                        <span class="title">prices</span>
                    </a>
                </li>

                <li>
                    <a href="mail.php">
                        <span class="icon"><i class='bx bx-message-rounded-dots'></i></span>
                        <span class="title">mail customers</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon"><i class='bx bx-help-circle'></i></span>
                        <span class="title">help</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><i class='bx bx-cog'></i></span>
                        <span class="title">settings</span>
                    </a>
                </li>

                <li>
                    <a href="../admin_online_users.php">
                        <span class="icon"><i class='bx bxs-lock-alt'></i></span>
                        <span class="title">online_users</span>
                    </a>
                </li>
                <li>
                    <a href="../logout.php">
                        <span class="icon"><i class='bx bx-log-in'></i></span>
                        <span class="title">sign out</span>
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
                        <input type="text" placeholder="search here">
                        <i class='bx bx-search'></i>
                    </label>
                </div>
                <div class="user">
                    <!-- <img src="img/customer2.jpg" width="200px"> -->
                </div>
            </div>

            <div class="cardbox">
                <div class="card">
                    <div>
                        <div class="numbers">1,504</div>
                        <div class="cardname">registered account</div>
                    </div>

                    <div class="iconbx">
                        <i class='bx bx-show'></i>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers">80</div>
                        <div class="cardname">admins</div>
                    </div>

                    <div class="iconbx">
                        <i class='bx bx-cart'></i>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers">205</div>
                        <div class="cardname">comments</div>
                    </div>

                    <div class="iconbx">
                        <i class='bx bx-chat'></i>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers">premium</div>
                        <div class="cardname">$7,542</div>
                    </div>

                    <div class="iconbx">
                        <i class='bx bx-money'></i>
                    </div>
                </div>
            </div>

            <div class="details">
                <div class="recentorders" style="width: 90%;">
                    <div class="cardheader">
                        <h2>Mail Client</h2>
                    </div>
<div class="wrapper" style="background-color: #fff; border-radius: 10px; width: 100%; max-width: 500px;">
     <h2 style="margin-bottom: 10px; color: #333;">Contact Us</h2>
        <p style="margin-bottom: 20px; color: #666;">Please fill out this form to get in touch with us.</p>
        <form action="" method="post">
        <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);
    $headers = "From: Your Name <support@superstarsbookings.com.com>\r\n"; // Change this to your email address
    $errors = [];

    if (empty($_POST['name'])) {
        $errors[] = "Name is required.";
    }

    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required.";
    }

    if (empty($_POST['subject'])) {
        $errors[] = "Subject is required.";
    }

    if (empty($_POST['message'])) {
        $errors[] = "Message is required.";
    }

    if (empty($errors)) {
        if (mail($to, $subject, $message, $headers)) {
            echo "<div class='success'>Your message has been sent successfully!</div>";
        } else {
            echo "<div class='error'>Oops! Something went wrong. Please try again later.</div>";
        }
    } else {
        foreach ($errors as $error) {
            echo "<div class='error'>$error</div>";
        }
    }
}
?>

            <div class="form-group mb-3" style="margin-bottom: 15px;">
                <label for="name" style="display: block; margin-bottom: 5px; color: #333;">Name</label>
                <input type="text" name="name" class="form-control" required style="width: calc(100% - 22px); padding: 10px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; font-size: 14px; color: #333;">
            </div>
            <div class="form-group mb-3" style="margin-bottom: 15px;">
                <label for="email" style="display: block; margin-bottom: 5px; color: #333;">Email</label>
                <input type="email" name="email" class="form-control" required style="width: calc(100% - 22px); padding: 10px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; font-size: 14px; color: #333;">
            </div>
            <div class="form-group mb-3" style="margin-bottom: 15px;">
                <label for="subject" style="display: block; margin-bottom: 5px; color: #333;">Subject</label>
                <input type="text" name="subject" class="form-control" required style="width: calc(100% - 22px); padding: 10px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; font-size: 14px; color: #333;">
            </div>
            <div class="form-group mb-3" style="margin-bottom: 15px;">
                <label for="message" style="display: block; margin-bottom: 5px; color: #333;">Message</label>
                <textarea name="message" class="form-control" rows="5" required style="width: calc(100% - 22px); padding: 10px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; font-size: 14px; color: #333; resize: vertical;"></textarea>
            </div>
            <div class="form-group mb-3" style="margin-bottom: 15px;">
                <input type="submit" class="btn btn-primary" value="Submit" style="background-color: #007bff; color: #fff; border: none; border-radius: 5px; padding: 10px 20px; cursor: pointer; font-size: 16px;">
            </div>
        </form>
    </div>


                </div>


                <div class="recentcustomers">
                    <div class="cardheader">
                        <h2>recent fans</h2>
                    </div>

                    <table>
                        <tr>
                            <td width="60px">
                                <div class="imgbx"><img src="img/customer1.jpg" width="200px"></div>
                            </td>
                            <td>
                                <h4>david <br><span>italy</span></h4>
                            </td>
                        </tr>
                        <tr>
                            <td width="60px">
                                <div class="imgbx"><img src="img/customer6.jpg" width="200px"></div>
                            </td>
                            <td>
                                <h4>john <br><span>canada</span></h4>
                            </td>
                        </tr>
                        <tr>
                            <td width="60px">
                                <div class="imgbx"><img src="img/customer5.jpg" width="200px"></div>
                            </td>
                            <td>
                                <h4>khavic <br><span>india</span></h4>
                            </td>
                        </tr>
                        <tr>
                            <td width="60px">
                                <div class="imgbx"><img src="img/customer.jpg" width="200px"></div>
                            </td>
                            <td>
                                <h4>micheal <br><span>australia</span></h4>
                            </td>
                        </tr>
                        <tr>
                            <td width="60px">
                                <div class="imgbx"><img src="img/customer3.jpg" width="200px"></div>
                            </td>
                            <td>
                                <h4>frank <br><span>spain</span></h4>
                            </td>
                        </tr>
                        <tr>
                            <td width="60px">
                                <div class="imgbx"><img src="img/customer1.jpg" width="200px"></div>
                            </td>
                            <td>
                                <h4>daniel <br><span>canada</span></h4>
                            </td>
                        </tr>
                        <tr>
                            <td width="60px">
                                <div class="imgbx"><img src="img/customer4.jpg" width="200px"></div>
                            </td>
                            <td>
                                <h4>jane <br><span>Us</span></h4>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="main.js"></script>
</body>

</html>