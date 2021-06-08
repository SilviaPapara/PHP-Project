<?php
// Initialize the session
session_start();

// Check if the user is logged in, otherwise redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate new password
    if (empty(trim($_POST["new_password"]))) {
        $new_password_err = "Please enter the new password.";
    } elseif (strlen(trim($_POST["new_password"])) < 6) {
        $new_password_err = "Password must have atleast 6 characters.";
    } else {
        $new_password = trim($_POST["new_password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm the password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($new_password_err) && ($new_password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before updating the database
    if (empty($new_password_err) && empty($confirm_password_err)) {
        // Prepare an update statement
        $sql = "UPDATE users SET password = ? WHERE id = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);

            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: login.php");
                exit();
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
    <title>Reset Password</title>
    <style>
        body {
            font: 14px sans-serif;
        }

        .wrapper {
            width: 360px;
            padding: 20px;
        }
    </style>

    <link rel="stylesheet" href="style/register.css">
</head>

<body class="bg-register">
    <?php

    include "navbar.php";
    include "bootstrap.html";
    ?>

    <div class="wrapper container col-4 mijloc">
        <h2>Reset Password</h2>
        <p>Please fill out this form to reset your password.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label class="label-st">New Password</label>
                <input type="password" name="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group">
                <label class="label-st">Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-light mt-2" value="Submit">
                <a class="btn btn-light ml-2 mt-2" href="profile.php">Cancel</a>
            </div>
        </form>

        <button class="btn btn-danger delete_account_btn mt-3">Delete Account</button>
        <div>
            <button class="btn btn-primary delete_account_no mt-3">No</button>
            <form action="delete_user.php">
                <button class="btn btn-danger delete_account_yes mt-3 mx-3">Yes</button>
            </form>

        </div>
    </div>
</body>

</html>
<style>
    body {
        background-image: url('images/fundal3.jpg');
        height: 100vh;
        width: 100%;
        background-repeat: no-repeat;
    }

    :is(.delete_account_yes, .delete_account_no) {
        display: none;
    }
    .delete_account_yes{float: left;}
    .delete_account_no{float: left;}
    .mijloc {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);

    }
</style>



<script>
    document.querySelector('.delete_account_btn').addEventListener('click', function() {
        document.querySelector('.delete_account_btn').style.display = 'none';
        document.querySelector('.delete_account_yes').style.display = 'block';
        document.querySelector('.delete_account_no').style.display = 'block';
    })
    document.querySelector('.delete_account_no').addEventListener('click', function() {
        document.querySelector('.delete_account_btn').style.display = 'block';
        document.querySelector('.delete_account_yes').style.display = 'none';
        document.querySelector('.delete_account_no').style.display = 'none';
    })
</script>