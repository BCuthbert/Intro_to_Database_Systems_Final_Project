<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

require_once "config.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
}


$deposit = "";
$deposit_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if deposit amount is empty
    if(empty(trim($_POST["deposit"]))){
        $deposit_err = "Please enter the amount of money to deposit.";
    } else{
        $deposit = trim($_POST["deposit"]);
    }
    // Validate credentials
    if(empty($deposit_err)){
        // Prepare a select statement
        $sql = "UPDATE account SET cash = cash + (?) WHERE id = (?);";
        if($stmt = $mysqli->prepare($sql)){

            $stmt->bind_param("di", $param_deposit, $_SESSION['id']);

            $param_id = $_SESSION["id"];
            $param_deposit = floatval($deposit);

            if(!$stmt->execute()){
            
                $deposit_err = "Deposit error.";
                
            } 


            $stmt->close();
        }else{
            echo "<script>console.log('Something went wrong (line 34)');</script>";
        }
    }
    $sql = "SELECT cash FROM account WHERE id = (?);";

    if($stmt = $mysqli->prepare($sql)){
        $stmt->bind_param('i', $_SESSION["id"]);

        if($stmt->execute()){
            // Store result

            $stmt->store_result();
                                        
            // Bind result variables
            $stmt->bind_result($cash);
            $stmt->fetch();
        } else {
            echo "<script>console.log('Something went wrong.(Line 58)');</script>";
        }
    }
    

    $mysqli->close();
}
?>




?>
 
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css"/>
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<div class="w3-top">
  <div class="w3-bar w3-white w3-card w3-large">
    <a class="w3-bar-item w3-left-align w3-button w3-padding-large w3-hover-gray" style="font-size:23px;" onclick="window.location.reload();">Home</a>
    <a href="#" class="w3-bar-item w3-left-align w3-button w3-hide-small w3-padding-large w3-hover-gray" style="font-size:23px;">Stocks</a>
    <a href="#" class="w3-bar-item w3-left-align w3-button w3-hide-small w3-padding-large w3-hover-gray" style="font-size:23px;">Buy</a>
    <a href="#" class="w3-bar-item w3-left-align w3-button w3-hide-small w3-padding-large w3-hover-gray" style="font-size:23px;">Sell</a>
    <a onclick="show_hide();" class="w3-bar-item w3-right w3-button w3-hide-small w3-padding-large w3-hover-red"><i class="fa fa-user" style="font-size:32px;padding:medium;"><br><?php echo htmlspecialchars($_SESSION["username"]); ?></i></a>
  </div>
  
<body>
<div id="dropdown" style="display:none;">
    <div id="myDropdown" class="dropdown-content">
        <button class="w3-hover-gray" style="border:2px solid black;position:absolute;right:40px;background-color:white;">Change Password</button>
        <button onclick="window.location.href='logout.php'" class="w3-hover-gray" style="border:2px solid black;position:absolute;right:40px;margin-top:21px;background-color:white;">Log out</button>
    </div>
</div>
</nav>
</body>

<body>
    <div style="text-align:center;width:300px;margin-left:38%;margin-top:40px;">
        <h1 class="w3-margin-top">Cash: $<?php echo $cash; ?></h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <div class="form-group w3-container w3-center">
                    <label class="w3-large" style="margin-top:30px;">Deposit Cash ($)</label>
                    <input type="text" name="deposit" class="form-control w3-large <?php echo (!empty($deposit_err)) ? 'is-invalid' : ''; ?>">
                    <span class="invalid-feedback"><?php echo $deposit_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="w3-button w3-red w3-hover-gray" value="Deposit">
            </div>

        </form>
        
    </div>
</body>



<script>
    var flag = false;
    const show_hide = () => {
        if (flag){
            document.getElementById("dropdown").setAttribute("style", "display:none");
            flag = false;
        }else {
            document.getElementById("dropdown").setAttribute("style", "display:visible");
            flag = true;
        }
    }
</script>
</html>