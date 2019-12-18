<?php
session_start();
if(!isset($_SESSION['username'])){
  header("Location:index.php");
}
?>

<!DOCTYPE html>
<html>
<head>

	<title>AGRO ANYTHING</title>
	<link rel="stylesheet" type="text/css" href="css/agro.css">
</head>
<body>
	<header>
		<div class="main">
			<div class="logo">
				<a href="index.php"><img src="sample_pictures\logo.png"></a>
			</div>
			<ul>
				<li><a href='cart.php'>Back</a></li>
				<li><a href='agro.php'>Agro</a></li>
				<li><a href='cart.php'>Cart</a></li>
				<li><a href="myorders.php">My Orders</a></li>
				<li><a href='contact_us.php'>Contact Us</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
	     </div>
	 </header>
	 <div class="title">
	 <div class="login-page">
	 	<h2 style="color: white;text-align: center;">Payment !!!</h2>

<?php
$amount=$_POST['amount']; 
$txnid=substr(md5(time()), 0, 7);
$conn=mysql_connect("localhost","root","");
mysql_select_db("agro");
if(!$conn){
	die("Connection failed:".mysqli_connect_error());
}
else{
	$username=$_SESSION['username'];
$sql="SELECT * from user where username='$username'";
	$result=mysql_query($sql);
	$row=mysql_fetch_array($result);
	$name=$row['name'];
	$agri_card=$row['agri_card'];
	if($agri_card!=""){
        $amount=$amount-0.2*$amount;
        $amount.=" (20%off on agricard)";
	}
	else{
		$agri_card="       --";
	}
}
mysql_close();
?>


  <div class="form">
    <form class="login-form" method="POST" action="paysuccess.php">
      <input type="text" placeholder="Transaction id" name="txnid" id="txnid" value="Txn_id:<?php echo $txnid; ?>" disabled>
      <input type="text" placeholder="Your Name" name="name" id="name" value="Name:<?php echo $name; ?>" disabled>
      <input type="text" placeholder="Agri_card" name="card" id="card" value="Agri_card:<?php echo $agri_card; ?>" disabled>
      <input type="text" placeholder="amount" name="amount" id="amount" value="Amount:<?php echo $amount; ?>" disabled>
      <button name="pay">Pay</button>
    </form>
  </div>
</div>
</div>
</body>
</html>