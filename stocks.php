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
  <div class="w3-bar w3-white w3-card w3-large">
    <a href="./home.php" class="w3-bar-item w3-left-align w3-button w3-padding-large w3-hover-gray" style="font-size:23px;">Home</a>
    <a href="./stocks.php" class="w3-bar-item w3-left-align w3-button w3-hide-small w3-padding-large w3-hover-gray" style="font-size:23px;">Stocks</a>
    <!--
    <a href="#" class="w3-bar-item w3-left-align w3-button w3-hide-small w3-padding-large w3-hover-gray" style="font-size:23px;">Buy</a>
    <a href="#" class="w3-bar-item w3-left-align w3-button w3-hide-small w3-padding-large w3-hover-gray" style="font-size:23px;">Sell</a>
-->
  <label class="w3-bar-item w3-left-align w3-padding-large" style="font-size:23px;">Date: <?php echo date("Y-m-d",$_SESSION["demoDate"] ); ?></label>
  <div>

  </div>
    <a onclick="show_hide();" class="w3-bar-item w3-right w3-button w3-hide-small w3-padding-large w3-hover-red"><i class="fa fa-user" style="font-size:32px;padding:medium;"><br><?php echo htmlspecialchars($_SESSION["username"]); ?></i></a>
  </div>
  <div id="dropdown" style="display:none;">
    <div id="myDropdown" class="dropdown-content">
        <button onclick="window.location.href='logout.php'" class="w3-hover-gray" style="border:2px solid black;position:absolute;right:40px;background-color:white;">Log out</button>
    </div>
</div>

<body>

<p><h2>List of Stocks:</h2></p>

<?php // this line starts PHP Code

require_once "config.php";

//run a query to get all stock ticker  
$sqlstatement = $mysqli->prepare("SELECT DISTINCT ticker FROM stocks;"); //prepare the statement
$sqlstatement->execute(); //execute the query
$stocks = $sqlstatement->get_result(); //return the results we'll use them in the web form

$sqlstatement = $mysqli->prepare("SELECT cash FROM account where id = " . $_SESSION["id"] . ";"); //prepare the statement
$sqlstatement->execute(); //execute the query
$sqlstatement->store_result();             
// Bind result variables
$sqlstatement->bind_result($money);
$sqlstatement->fetch();


$sqlstatement->close();



   $sql = "SELECT ticker, company_name, price, price_date FROM stocks NATURAL JOIN price_history WHERE price_date = '".Date("Y-m-d",$_SESSION["demoDate"])."'";
   $result = $mysqli->query($sql);

   if ($result->num_rows > 0) {
     	// Setup the table and headers
	echo "<Center><table><tr><th>Ticker</th><th>Company Name</th><th>Price</th><th>Date</th></tr>";
	// output data of each row into a table row
	 while($row = $result->fetch_assoc()) {
		 echo "<tr><td>".$row["ticker"]."</td><td>".$row["company_name"]."</td><td>".$row["price"]."</td><td>".$row["price_date"]."</td></tr>";
	 }

	echo "</table></center>"; // close the table
	echo "There are ". $result->num_rows . " results.";
	// Don't render the table if no results found
   	} else {
        echo "0 results";
    }


  if($_SERVER["REQUEST_METHOD"] == "POST") {

    $stock = trim($_POST["stock"]);
    $numshares = trim($_POST["num_shares"]);

    $sql = $mysqli->prepare("SELECT price from price_history where price_date = ? and ticker = ?;"); //prepare the statement
    $sql->bind_param("ss",$param_date, $param_stock);
    $param_stock = $stock;
    $param_date = date("Y-m-d",$_SESSION["demoDate"]);
    $sql->execute(); //execute the query
    $sql->store_result();             
    // Bind result variables
    $sql->bind_result($stockPrice);
    $sql->fetch();

    $cost = ($stockPrice * $numshares);


        
    // Prepare an insert statement
    $sql = "INSERT INTO lots (id, ticker, num_shares, purchase_price, purchase_date) VALUES (?, ?, ?, ?, ?);";
    
     
    if($stmt = $mysqli->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("isdds", $param_id, $param_stock, $param_numshares, $param_stockPrice,$param_date);
            
        // Set parameters
        $param_id = $_SESSION["id"];
        $param_stock = $stock;
        $param_numshares = $numshares;
        $param_stockPrice = $stockPrice;
        $param_cost = $cost;
        $param_date = date("Y-m-d",$_SESSION["demoDate"]);

        if ($cost <= $money) {
          if($stmt->execute()){
            $sql = "UPDATE account SET cash = cash - ? WHERE id = ?;";
            $statement = $mysqli->prepare($sql);
            $statement->bind_param("di", $param_cost, $param_id);

            $param_id = $_SESSION["id"];
            $param_cost = $cost;
            $statement->execute();
          } else{
              echo "Oops! Something went wrong. Please try again later.";
          }

          // Close statement
          $stmt->close();
      } else {
        echo "Can't buy more than you can afford.";
      }
    }
}



     $mysqli->close();



  


?> <!-- this is the end of our php code -->

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
	<p>Select Stock:<p>
	<select name="stock">
        <?php //iterate through the results of the department query to build the web form
	while($stock = $stocks->fetch_assoc()) {
	?>
		<option value="<?php echo $stock["ticker"]; ?>"><?php echo $stock["ticker"]; ?>
		</option>
	<?php } //end while loop ?>
	</select> 

	<p>Enter Amount Of Stocks: <input type=text size=10 name="num_shares">
	<p> <input type=submit value="submit">
</form>


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