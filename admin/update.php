<?php
// require_once "config.php";

// // Define variables and initialize with empty values
// $username = $email = $password = $confirm_password = $role = "";
// $username_err = $email_err = $password_err = $confirm_password_err = $role_err = "";

// // Processing form data when form is submitted
// if ($_SERVER["REQUEST_METHOD"] == "POST") {

//     // Validate username
//     if (empty(trim($_POST["username"]))) {
//         $username_err = "Please enter a username.";
//     } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
//         $username_err = "Username can only contain letters, numbers, and underscores.";
//     } else {
//         // Prepare a select statement
//         $sql = "SELECT id FROM crypto WHERE username = ?";

//         if ($stmt = mysqli_prepare($link, $sql)) {
//             // Bind variables to the prepared statement as parameters
//             mysqli_stmt_bind_param($stmt, "s", $param_username);

//             // Set parameters
//             $param_username = trim($_POST["username"]);

//             // Attempt to execute the prepared statement
//             if (mysqli_stmt_execute($stmt)) {
//                 // store result
//                 mysqli_stmt_store_result($stmt);

//                 if (mysqli_stmt_num_rows($stmt) == 1) {
//                     $username_err = "This username is already taken.";
//                 } else {
//                     $username = trim($_POST["username"]);
//                 }
//             } else {
//                 echo "Oops! Something went wrong. Please try again later.";
//             }

//             // Close statement
//             mysqli_stmt_close($stmt);
//         }
//     }

//     // Validate email
//     if (empty(trim($_POST["email"]))) {
//         $email_err = "Please enter an email.";
//     } elseif (strlen(trim($_POST["email"])) <= 6) {
//         $email_err = "Email must be longer than 6 characters.";
//     } 

//        // Validate bitcoin
//        if (empty(trim($_POST["bitcoin"]))) {
//         $password_err = "Please enter a bitcoin.";
//     } 
//      else {
//         $password = trim($_POST["bitcoin"]);
//     }

//        // Validate ethereum
//        if (empty(trim($_POST["ethereum"]))) {
//         $password_err = "Please enter a ethereum.";
//     } 
//      else {
//         $password = trim($_POST["ethereum"]);
//     }

//         // Validate bnb
//         if (empty(trim($_POST["bnb"]))) {
//             $password_err = "Please enter a bnb.";
//         } 
//          else {
//             $password = trim($_POST["bnb"]);
//         }


//          // Validate bnb
//          if (empty(trim($_POST["usdt"]))) {
//             $password_err = "Please enter a usdt.";
//         } 
//          else {
//             $password = trim($_POST["usdt"]);
//         }

//     // Validate password
//     if (empty(trim($_POST["password"]))) {
//         $password_err = "Please enter a password.";
//     } elseif (strlen(trim($_POST["password"])) < 6) {
//         $password_err = "Password must have at least 6 characters.";
//     } else {
//         $password = trim($_POST["password"]);
//     }

   

//     // Validate role
//     if (empty(trim($_POST["role"]))) {
//         $role_err = "Please select a role.";
//     } else {
//         $role = trim($_POST["role"]);
//     }

    
//     // Check input errors before inserting in database
//     if(empty($name_err) && empty($address_err) && empty($salary_err)){
//         // Prepare an update statement
//         $sql = "UPDATE crypto SET username=?, email=?, password=?, bitcoin=? , ethereum=?, bnb=? , usdt=?, role=?   WHERE id=?";
         
//         if($stmt = mysqli_prepare($link, $sql)){
//             // Bind variables to the prepared statement as parameters
//             mysqli_stmt_bind_param($stmt, "sssi", $param_username, $param_email, $param_bitcoin,$param_ethereum,$param_bnb,$param_usdt,$param_role $param_id);
            
//             // Set parameters
    
//             $param_username = $username;
//             $param_email = $email;
//             $param_bitcoin = $bitcoin;
//             $param_ethereum = $ethereum;
//             $param_bnb = $bnb;
//             $param_usdt = $usdt;
//             $param_role = $role;
//             $param_id = $id;
            
// Attempt to execute the prepared statement<?php
require_once "config.php";

// Define variables and initialize with empty values
$username = $email = $password = $confirm_password = $role = $bitcoin = $ethereum = $bnb = $usdt = "";
$username_err = $email_err = $password_err = $confirm_password_err = $role_err = $bitcoin_err = $ethereum_err = $bnb_err = $usdt_err = "";

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

                if (mysqli_stmt_num_rows($stmt) == 1 && $param_username !== $username) {
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
        $email = trim($_POST["email"]);
    }

    // Validate bitcoin
    if (empty(trim($_POST["bitcoin"]))) {
        $bitcoin_err = "Please enter a bitcoin value.";
    } else {
        $bitcoin = trim($_POST["bitcoin"]);
    }

    // Validate ethereum
    if (empty(trim($_POST["ethereum"]))) {
        $ethereum_err = "Please enter an ethereum value.";
    } else {
        $ethereum = trim($_POST["ethereum"]);
    }

    // Validate bnb
    if (empty(trim($_POST["bnb"]))) {
        $bnb_err = "Please enter a bnb value.";
    } else {
        $bnb = trim($_POST["bnb"]);
    }

    // Validate usdt
    if (empty(trim($_POST["usdt"]))) {
        $usdt_err = "Please enter a usdt value.";
    } else {
        $usdt = trim($_POST["usdt"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate role
    if (empty(trim($_POST["role"]))) {
        $role_err = "Please select a role.";
    } else {
        $role = trim($_POST["role"]);
    }

    // Check input errors before inserting in database
    if (empty($username_err) && empty($email_err) && empty($password_err) && empty($role_err) && empty($bitcoin_err) && empty($ethereum_err) && empty($bnb_err) && empty($usdt_err)) {
        // Prepare an update statement
        $sql = "UPDATE crypto SET username=?, email=?, password=?, bitcoin=?, ethereum=?, bnb=?, usdt=?, role=? WHERE id=?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssssi", $param_username, $param_email, $param_password, $param_bitcoin, $param_ethereum, $param_bnb, $param_usdt, $param_role, $param_id);

            // Set parameters
            $param_username = $username;
            $param_email = $email;
            $param_password = $password;
            $param_bitcoin = $bitcoin;
            $param_ethereum = $ethereum;
            $param_bnb = $bnb;
            $param_usdt = $usdt;
            $param_role = $role;
            $param_id = $_POST["id"];

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records updated successfully. Redirect to landing page
                header("location: index2.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);

} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Get URL parameter
        $id = trim($_GET["id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM crypto WHERE id = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            // Set parameters
            $param_id = $id;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    // Retrieve individual field value
                    $username = $row["username"];
                    $email = $row["email"];
                    $password = $row["password"];
                    $bitcoin = $row["bitcoin"];
                    $ethereum = $row["ethereum"];
                    $bnb = $row["bnb"];
                    $usdt = $row["usdt"];
                    $role = $row["role"];
                } else {
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);

        // Close connection
        mysqli_close($link);
    } else {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the employee record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                            <span class="invalid-feedback"><?php echo $username_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                            <span class="invalid-feedback"><?php echo $email_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                            <span class="invalid-feedback"><?php echo $password_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Bitcoin</label>
                            <input type="text" name="bitcoin" class="form-control <?php echo (!empty($bitcoin_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $bitcoin; ?>">
                            <span class="invalid-feedback"><?php echo $bitcoin_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Ethereum</label>
                            <input type="text" name="ethereum" class="form-control <?php echo (!empty($ethereum_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $ethereum; ?>">
                            <span class="invalid-feedback"><?php echo $ethereum_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>BNB</label>
                            <input type="text" name="bnb" class="form-control <?php echo (!empty($bnb_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $bnb; ?>">
                            <span class="invalid-feedback"><?php echo $bnb_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>USDT</label>
                            <input type="text" name="usdt" class="form-control <?php echo (!empty($usdt_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $usdt; ?>">
                            <span class="invalid-feedback"><?php echo $usdt_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <input type="text" name="role" class="form-control <?php echo (!empty($role_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $role; ?>">
                            <span class="invalid-feedback"><?php echo $role_err; ?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>