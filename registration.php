<?php
// Include config file
require_once "config.php";

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
        $sql = "INSERT INTO crypto (username, email,bitcoin,ethereum,bnb,usdt, password, role) VALUES (?, ?, 0, 0 , 0, 0 , ?, ?)";

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
                header("location: login.php");
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





<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
       
*{
  padding: 0;
  margin: 0;
  
}

body{
  background-color: rgb(219, 226, 226);
 
  
}

.row{
  background-color: white;
  border-radius: 30px;
  box-shadow: 12px 12px 22px grey;
  max-width: 70%;
  height: 36rem;
  justify-content: center;
  margin: 5% auto;
  
}

img{
  border-top-left-radius: 30px;
  border-bottom-left-radius: 30px;
  
}

.img-fluid{
  height: 576px;
}

.btn1{
  border: none;
  outline: none;
  height: 50px;
  width: 100%;
  background-color: black;
  color: white;
  border-radius: 4px;
  font-weight: bold;
}

.btn1:hover{
  background-color: white;
  border: 1px solid;
  color: black;
}



@media screen and (max-width: 1000px) {

  .row{
    background-color: white;
    border-radius: 30px;
    box-shadow: 12px 12px 22px grey;
    max-width: 100%;
    height: 64rem;
    margin: 20% auto;
    
  }

  .img-fluid{
    width: 100%;
    height: 430px;
  }
  
}


    </style>
</head>

<body>

<section class="form my-4 mx-5">
    <div class="container">
        <div class="row gx-0">
            <div class="col-lg-5">
                <img src="./post/img/pexels-cottonbro-studio-6344239.jpg" class="img-fluid" alt="">
            </div>
            <div class="col-lg-7 px-5 pt-5">
                <h1>Register</h1>
                <h4>Welcome Back To Your Account</h4>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-row">
                        <div class="col-lg-7">
                            <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($username); ?>" placeholder="doe">
                            <span class="invalid-feedback"><?php echo $username_err; ?></span>
                        </div>
                    </div>
                    <br>

                    <div class="form-row">
                        <div class="col-lg-7">
                            <input type="emai" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($email); ?>" placeholder="Username@Email.com">
                            <span class="invalid-feedback"><?php echo $email_err; ?></span>
                        </div>
                    </div>
                    <br>

                    <div class="form-row">
                        <div class="col-lg-7">
                            <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($password); ?>" placeholder="********">
                            <span class="invalid-feedback"><?php echo $username_err; ?></span>
                        </div>
                    </div>
                    <br>

                    <div class="form-row">
                        <div class="col-lg-7">
                            <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($confirm_password); ?>" placeholder="********">
                            <span class="invalid-feedback"><?php echo $confirm_password_err; ?>
                        </div>
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="col-lg-7">
                            <div class="form-group mb-3">

                                <select name="role" class="form-control <?php echo (!empty($role_err)) ? 'is-invalid' : ''; ?>">
                                    <option value="">Select role</option>
                                    <option value="admin" <?php echo ($role == 'admin') ? 'selected' : ''; ?>>Admin</option>
                                    <option value="client" <?php echo ($role == 'client') ? 'selected' : ''; ?>>Client</option>
                                </select>
                                <span class="invalid-feedback"><?php echo $role_err; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-7">
                            <button type="submit" class="btn1 my-3 p-2">Login</button>
                        </div>
                    </div>
                    <p>I have an account? <a href="login.php">Sign in</a>.</p>
                </form>
            </div>
        </div>
    </div>
</section>
    <!-- <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($username); ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>

            <div class="form-group mb-3">
                <label>Email</label>
                <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($email); ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>

            <div class="form-group mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($password); ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group mb-3">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($confirm_password); ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group mb-3">
                <label>Role</label>
                <select name="role" class="form-control <?php echo (!empty($role_err)) ? 'is-invalid' : ''; ?>">
                    <option value="">Select role</option>
                    <option value="admin" <?php echo ($role == 'admin') ? 'selected' : ''; ?>>Admin</option>
                    <option value="client" <?php echo ($role == 'client') ? 'selected' : ''; ?>>Client</option>
                </select>
                <span class="invalid-feedback"><?php echo $role_err; ?></span>
            </div>
            <div class="form-group mb-3">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ms-2" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div> -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html> 

