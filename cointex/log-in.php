<?php
// Include config file
require_once "../config.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT id, username, password, email, bitcoin, ethereum, bnb, usdt, role FROM crypto WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $email, $bitcoin, $ethereum, $bnb, $usdt, $role);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["email"] = $email;
                            $_SESSION["bitcoin"] = $bitcoin;
                            $_SESSION["ethereum"] = $ethereum;
                            $_SESSION["bnb"] = $bnb;
                            $_SESSION["usdt"] = $usdt;
                            $_SESSION["role"] = $role;

                            // Update last_activity
                            $sql_update_activity = "UPDATE crypto SET last_activity = NOW() WHERE id = ?";
                            if ($stmt_update = mysqli_prepare($link, $sql_update_activity)) {
                                mysqli_stmt_bind_param($stmt_update, "i", $param_id);
                                $param_id = $id;
                                mysqli_stmt_execute($stmt_update);
                                mysqli_stmt_close($stmt_update);
                            }

                            // Redirect user to respective page
                            if ($role == 'admin') {
                                header("location: ../admin/index2.php");
                            }
                             else {
                                header("location: home.php");
                            }
                        } else {
                            // Password is not valid, display a generic error message
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else {
                    // Username doesn't exist, display a generic error message
                    $username_err = "No account found with that username.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, viewport-fit=cover">
    <!-- font -->
    <link rel="stylesheet" href="fonts/fonts.css">
    <!-- Icons -->
    <link rel="stylesheet" href="fonts/font-icons.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet"type="text/css" href="css/styles.css"/>

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="images/logo/48.png" />
    <link rel="apple-touch-icon-precomposed" href="images/logo/48.png" />

    <title>Log In</title>
</head>

<body>
    <!-- preload -->
    <div class="preload preload-container">
        <div class="preload-logo" style="background-image: url('images/logo/144.png')">
          <div class="spinner"></div>
        </div>
    </div>
    <!-- /preload --> 
    <div class="header fixed-top bg-surface">
        <a href="#" class="left back-btn"><i class="icon-left-btn"></i></a>
    </div>
    <div class="pt-45 pb-20">
        <div class="tf-container">
            <br>
            <br>
            <br>
            <br>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="mt-16">
                <fieldset class="mt-16">
                    <label class="label-ip">
                        <p class="mb-8 text-small">Username</p>
                        <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($username); ?>" placeholder="Example@gmail">
                        <span class="invalid-feedback"><?php echo $username_err; ?></span>
                    </label>
                </fieldset>
                
                <fieldset class="mt-16 mb-12">
                    <label class="label-ip">
                        <p class="mb-8 text-small">Password</p>
                        <div class="box-auth-pass">
                            <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" placeholder="Your password">
                            <span class="invalid-feedback"><?php echo $password_err; ?></span>
                            <span class="show-pass">
                                <i class="icon-view"></i>
                                <i class="icon-view-hide"></i>
                            </span>
                        </div>
                    </label>
                </fieldset>
                
                <button type="submit" class="mt-20">Login</button>
                <p class="mt-20 text-center text-small">Don't have an account? &ensp;<a href="register.php">Sign up</a></p>
            </form>
        </div>
    </div>

    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>
