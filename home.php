<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

require_once "config.php";

$deposit = "";
$deposit_err = "";
 
// Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['timeButton'])){
        if(isset($_POST['timeButton'])){
            $_SESSION["demoDate"] =strtotime("+1 day", $_SESSION["demoDate"]);
        }
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
    

        $stmt->close();
    }

    $sql = "SELECT accVal FROM account_value WHERE id = (?) and (aDate = ? or aDate IS NULL);";

    if($stmt = $mysqli->prepare($sql)){
        $stmt->bind_param('is', $_SESSION["id"], $param_date);
        $param_date = date("Y-m-d",$_SESSION["demoDate"]);
        if($stmt->execute()){
            // Store result

            $stmt->store_result();
                                        
            // Bind result variables
            $stmt->bind_result($accoutValue);
            $stmt->fetch();
        } else {
            echo "<script>console.log('Something went wrong.(Line 79)');</script>";
        }


        $stmt->close();
    }
    if(isset($_POST['timeButton'])){
        $_SESSION["demoDate"] =strtotime("+1 day", $_SESSION["demoDate"]);
    }

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
        table, th, td { border: 1px solid black; }
        th, td { padding: 4px; font-size: 1.5em; }
    </style>
</head>
<div class="w3-top">
  <div class="w3-bar w3-card w3-large" style="background-color:#bdfa7b;">
    <a class="w3-bar-item w3-left-align w3-button w3-padding-large w3-hover-gray" style="font-size:23px;" onclick="window.location.reload();">Home</a>
    <a href="./stocks.php" class="w3-bar-item w3-left-align w3-button w3-hide-small w3-padding-large w3-hover-gray" style="font-size:23px;">Stocks</a>
    <!--
    <a href="#" class="w3-bar-item w3-left-align w3-button w3-hide-small w3-padding-large w3-hover-gray" style="font-size:23px;">Buy</a>
    <a href="#" class="w3-bar-item w3-left-align w3-button w3-hide-small w3-padding-large w3-hover-gray" style="font-size:23px;">Sell</a>
-->
    <label class="w3-bar-item w3-left-align w3-padding-large" style="font-size:23px;">Date: <?php echo date("Y-m-d",$_SESSION["demoDate"] ); ?></label>
    <form method="post">
        <input type="submit" name="timeButton" value="Advance Time" class="w3-bar-item w3-left-align w3-button w3-hide-small w3-padding-large w3-hover-gray" style="font-size:23px;"/>
    </form>
    <img src="ApeMoney.jpg" width="100" height="100"/>
    <a onclick="show_hide();" class="w3-bar-item w3-right w3-button w3-hide-small w3-padding-large w3-hover-red"><i class="fa fa-user" style="font-size:32px;padding:medium;"><br><?php echo htmlspecialchars($_SESSION["username"]); ?></i></a>
  </div>
  
<body>
<div id="dropdown" style="display:none;">
    <div id="myDropdown" class="dropdown-content">
        <button onclick="window.location.href='logout.php'" class="w3-hover-gray" style="border:2px solid black;position:absolute;right:40px;background-color:white;">Log out</button>
    </div>
</div>
</nav>
</body>

<body>

    <h2>TestTitle</h2>

    <center>
    <div style="text-align:center;width:300px;margin-top:40px;">
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
    </center>
    <p><h3>Your Total Account Value: $ <?php echo $accoutValue; ?></h3></p>
<?php
    $query = "SELECT ticker,Price,Previous,sum(Shares) as shares,sum(TotalValue) as marketVal,sum(Basis) as totalBasis FROM lot_value where LotOwner = ? AND l_date = ? GROUP BY ticker";
    if($stmt = $mysqli->prepare($query)){
        $stmt->bind_param('is', $_SESSION["id"],$param_date);
        $param_date = date("Y-m-d",$_SESSION["demoDate"]);
        $stmt->execute(); 
        if($result= $stmt->get_result()){
            // Store result
            if ($result->num_rows > 0) {
                // Setup the table and headers
                echo "<Center><table><tr><th> STOCK </th><th> SHARES </th><th> PRICE </th><th> DAY CHANGE </th><th> MARKET VALUE </th><th> COST BASIS </th><th> GAIN / LOSS </th><th></th></tr>";
                // output data of each row into a table row
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>".$row["ticker"]."</td><td> ".$row["shares"]."</td><td>$".$row["Price"]."</td>";
                    if($row["Previous"])
                        $daygain = number_format( $row["Price"] - $row["Previous"],2,'.','');
                    else 
                        $daygain = 0;
                    if($daygain > 0){
                        echo "<td style=\"color: green;\"> $".$daygain."</td>";
                    }else if($daygain == 0){
                        echo "<td> ".$daygain."</td>";
                    }else{ 
                        echo "<td style=\"color: red;\"> $".$daygain." </td>";
                    }   
                    echo "<td> $".$row["marketVal"]."</td><td> $".$row["totalBasis"]."</td>";
                    $gain = number_format( $row["marketVal"] - $row["totalBasis"],2,'.','');
                    if($gain > 0){
                        echo "<td style=\"color: green;\"> $".$gain."</td>";
                    }else if($gain == 0){
                        echo "<td> ".$gain."</td>";
                    }else{ 
                        echo "<td style=\"color: red;\"> $".$gain." </td>";
                    }   

                    echo "<td><a href=\"home.php?form_sell=1&ticker=".$row["ticker"]."&value=".$row["marketVal"]."\">Sell</a> </td>";

                    echo "</tr>";
                }
                echo "</table></center>"; // close the table
                echo "There are ". $result->num_rows . " results.";
                // Don't render the table if no results found
            } else {
                echo "0 results";
            }

        } else {
            echo "<script>console.log('Something went wrong.(Line 158 )');</script>";
        }
    }
    $result->close();
?>

<form action="home.php" method=get>
                <input type="hidden" name="form_sell" >
                <input type="hidden" name="ticker" >
                <input type="hidden" name="value"  >
</form>


<?php 
if (isset($_GET["form_sell"])){
    if (!empty($_GET["ticker"]) && !empty($_GET["value"]) && !empty($_GET["form_sell"]))
    {
        $sellTicker = $_GET["ticker"];
        $sellVal = $_GET["value"];
            //Sell the lots
        $sellstatement = $mysqli->prepare("DELETE FROM lots where id=? and ticker=?"); 
        $sellstatement->bind_param("is",$_SESSION["id"],$sellTicker); 
        $sellstatement->execute(); 
        echo $sellstatement->error; 
        $sellstatement->close();

            //update the cash
        $cashUpdate = $mysqli->prepare("UPDATE account set cash=cash+? where id = ?");
        $cashUpdate->bind_param("di",$sellVal,$_SESSION["id"]);
        $cashUpdate->execute();
        echo $cashUpdate->error;
        $cashUpdate->close();

    }
    else {
        echo "<b> Error: Something went wrong with the form.</b>";
    }
    header("Refresh:0;url=home.php"); //refresh the page to show the faculty is gone
}

?> <!-- this is the end of our php code -->


</body>


<?php $mysqli->close(); ?>


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