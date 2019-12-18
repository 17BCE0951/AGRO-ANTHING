<?php
session_start();
if(!isset($_SESSION['username'])){
  header("Location:index.php");
}
?>

<?php
if(isset($_POST['pay'])){
$conn=mysql_connect("localhost","root","");
mysql_select_db("agro");
if(!$conn){
	die("Connection failed:".mysqli_connect_error());
}else{
foreach ($_SESSION["cart_array"] as $each_item) {
    $item_id=$each_item['item_id'];
    $quantity=$each_item['quantity'];
    $sql1="SELECT quantity from product where pcode='$item_id'";
    $result1=mysql_query($sql1);
    $row1=mysql_fetch_array($result1);
    $avail=$row1['quantity'];
    $avail=$avail-$quantity;
    $sql2=mysql_query("UPDATE PRODUCT SET quantity=$avail where pcode='$item_id'");
    if(!$sql2){
    	$ans='Payment Failed!!'.mysql_error();
    }
    else{
    	$ans='Payment Sucessful!!';
    	$_SESSION['order_array']=$_SESSION['cart_array'];
    	unset($_SESSION['cart_array']);
    }
  }
  }
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
				<a href="index.php"><img src="sample_pictures\logo.png" alt="Logo"></a>
			</div>
			<ul>
				<li><a href='agro.php'>Agro</a></li>
				<li><a href='cart.php'>Cart</a></li>
				<li><a href="myorders.php">My Orders</a></li>
				<li><a href='contact_us.php'>Contact Us</a></li>
				<li><a href="logout.php">Logout</a></li>
       
			</ul>
	     </div>
	 </header>
		<div class="title">
			<h1 style="color: white;"><?php echo $ans; ?></h1><br><br>
			<h3><a href="agro.php" style="color: white;text-decoration: none;">Continue Shopping</a></h3>
		</div>
	</body>
	</html>