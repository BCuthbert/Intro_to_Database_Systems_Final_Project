<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to the University Information System.</h1>
    <p><nav class="nav justify-content-center">
    <a href="welcome.php" class="nav-item nav-link active">Home</a>
    <a href="faculty-table.php" class="nav-item nav-link">View Faculty</a>
    <a href="faculty-search.php" class="nav-item nav-link">Search Faculty</a>
    <a href="newfaculty.php" class="nav-item nav-link">Enter New Faculty</a>
    <a href="delfaculty.php" class="nav-item nav-link" tabindex="-1">Delete Faculty</a>
</nav>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>
</body>
</html>