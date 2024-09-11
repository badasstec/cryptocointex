<?php
// Include config file
require_once "../config.php";

// Define variables and initialize with empty values
$username = $email = $password = $confirm_password = $role = "";
$username_err = $email_err = $password_err = $confirm_password_err = $role_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM crypto WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // store result
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter an email.";
    } elseif (strlen(trim($_POST["email"])) <= 6) {
        $email_err = "Email must be longer than 6 characters.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM crypto WHERE email = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            // Set parameters
            $param_email = trim($_POST["email"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // store result
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $email_err = "This email is already taken.";
                } else {
                    $email = trim($_POST["email"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Validate role
    if (empty(trim($_POST["role"]))) {
        $role_err = "Please select a role.";
    } else {
        $role = trim($_POST["role"]);
    }

    // Check input errors before inserting in database
    if (empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err) && empty($role_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO crypto (username, email, bitcoin, ethereum, bnb, usdt, password, role) VALUES (?, ?, 0, 0 , 0, 0 , ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_username, $param_email, $param_password, $param_role);

            // Set parameters
            $param_username = $username;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_role = $role;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                header("location: log-in.php");
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

    <title>Sign Up</title>
</head>

<body>
     <!-- preloader -->
     <div class="preload preload-container">
        <div class="preload-logo" style="background-image: url('images/logo/144.png')">
          <div class="spinner"></div>
        </div>
      </div>
      <!-- /preloader --> 

    <div class="header fixed-top bg-surface">
        <a href="#" class="left back-btn"><i class="icon-left-btn"></i></a>
    </div>
    <div class="pt-45">
        <div class="tf-container">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="mt-32 mb-16">
                <h2 class="text-center">Register Cointex</h2>
                <fieldset class="mt-4">
                    <label class="label-ip">
                        <p class="mb-8 text-small">Username</p>
                        <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($username); ?>" placeholder="username">
                        <span class="invalid-feedback"><?php echo $username_err; ?></span>
                    </label>
                </fieldset>
                <fieldset class="mt-4">
                    <label class="label-ip">
                        <p class="mb-8 text-small">Email</p>
                        <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($email); ?>" placeholder="Username@Email.com">
                        <span class="invalid-feedback"><?php echo $email_err; ?></span>
                    </label>
                </fieldset>
       
                <fieldset class="mt-4">
                    <label class="label-ip">
                        <p class="mb-8 text-small">Password</p>
                        <div class="box-auth-pass">
                            <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" placeholder="********">
                            <span class="invalid-feedback"><?php echo $password_err; ?></span>
                            <span class="show-pass">
                                <i class="icon-view"></i>
                                <i class="icon-view-hide"></i>
                            </span>
                        </div>
                    </label>
                </fieldset>

                <fieldset class="mt-4">
                    <label class="label-ip">
                        <p class="mb-8 text-small">Confirm Password</p>
                        <div class="box-auth-pass">                            
                            <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" placeholder="********">
                            <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                            <span class="show-pass2">
                                <i class="icon-view"></i>
                                <i class="icon-view-hide"></i>
                            </span>
                        </div>
                    </label>
                </fieldset>

                <fieldset class="mt-4">
                    <label class="label-ip">
                        <div class="form-group mb-3">
                            <select name="role" class="form-control <?php echo (!empty($role_err)) ? 'is-invalid' : ''; ?>">
                                <option value="">Select role</option>
                                <option value="admin" <?php echo ($role == 'admin') ? 'selected' : ''; ?>>Admin</option>
                                <option value="client" <?php echo ($role == 'client') ? 'selected' : ''; ?>>Client</option>
                            </select>
                            <span class="invalid-feedback"><?php echo $role_err; ?></span>
                        </div>
                    </label>
                </fieldset> 

                <fieldset class="group-cb cb-signup mt-12">
                    <input type="checkbox" class="tf-checkbox" id="cb-ip" checked> 
                    <label for="cb-ip">I agree to <span class="text-white">Terms and condition</span></label>
                </fieldset>
                <p class="mt-20 text-start text-small">already have an account &ensp;<a href="log-in.php">Sign in</a></p>
                <button name="submit" type="submit" class="mt-40">Create an account</button>
            </form>
        </div>
    </div>

    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>
