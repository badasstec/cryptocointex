<?php
// Include config file
require_once "config.php";

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
        $sql = "SELECT id, username, password, role FROM crypto WHERE username = ?";

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
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $role);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
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
                                header("location: admin/index2.php");
                            } else {
                                header("location: client_dashboard.php");
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

<?php
// Start the session


// Check if the necessary session variables are set
if (isset($_SESSION["bitcoin"]) && isset($_SESSION["ethereum"]) && isset($_SESSION["bnb"]) && isset($_SESSION["usdt"])) {
    // Get the session values
    $bitcoin = $_SESSION["bitcoin"];
    $ethereum = $_SESSION["ethereum"];
    $bnb = $_SESSION["bnb"];
    $usdt = $_SESSION["usdt"];

    // Calculate the total
    $_SESSION["total"] = $bitcoin + $ethereum + $bnb + $usdt;

    // Display the total
    echo "The total value of your cryptocurrency holdings is: $" . number_format($total, 2);
} else {
    echo "Some session variables are not set.";
}
?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* body {
            font: 14px sans-serif;
            background-color: rgb(219, 226, 226);
        } */
        .row {
            background-color: white;
            border-radius: 30px;
            box-shadow: 12px 12px 22px grey;
            max-width: 60%;
            height: 30rem;
            justify-content: center;
            align-items: center;
            margin: 5% auto;
        }
        img {
            border-top-left-radius: 30px;
            border-bottom-left-radius: 30px;
        }
        .img-fluid {
            height: 480px;
        }
        .btn1 {
            border: none;
            outline: none;
            height: 50px;
            width: 100%;
            background-color: black;
            color: white;
            border-radius: 4px;
            font-weight: bold;
        }
        .btn1:hover {
            background-color: white;
            border: 1px solid;
            color: black;
        }
        @media screen and (max-width: 1000px) {
            .row {
                max-width: 100%;
                height: 25rem;
            }
            .img-fluid {
                width: 100%;
                height: 930px;
            }
        }
    </style>
</head>
<body>
    <section class="form my-4 mx-5 mt-5">
        <div class="container mt-5">
            <div class="row gx-0 mt-5">
                <div class="col-lg-5">
                    <img src="./post/img/pexels-cottonbro-studio-6344239.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-lg-7 px-5 pt-5">
                    <h1>Login</h1>
                    <h4>Sign into your account</h4>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-row">
                            <div class="col-lg-7">
                                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($username); ?>" placeholder="Username">
                                <span class="invalid-feedback"><?php echo $username_err; ?></span>
                            </div>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="col-lg-7">
                                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" placeholder="********">
                                <span class="invalid-feedback"><?php echo $password_err; ?></span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-7">
                                <button type="submit" class="btn1 my-3 p-2">Login</button>
                            </div>
                        </div>
                        <p>Don't have an account? <a href="registration.php">Sign up</a>.</p>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html> -->
