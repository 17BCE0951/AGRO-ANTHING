<?php
session_start();
?>

<?php
$conn=mysql_connect("localhost","root","");
mysql_select_db("agro");
if(!$conn){
	die("Connection failed:".mysql_connect_error());
}
else{
 if(isset($_GET['id'])){
 	$id=$_GET['id'];
 	$id=preg_replace('#[^0-9]#i',"", $_GET['id']);
 	$sql="SELECT * from product where pcode='$id' LIMIT 1";
 	$result=mysql_query($sql,$conn);
 	$productCount=mysql_num_rows($result);
 	if($productCount>0){
         while($row=mysql_fetch_array($result)){
	 	$pcode=$row["pcode"];
	 	$pname=$row["pname"];
	 	$price=$row["price"];
	 	$quantity=$row["quantity"];
	 	$type=$row["type"];
	 	$brand=$row["brand"];
	 	if($quantity>0){
	 		$quantity="Instock";
	 	}
	 	else{
	 		$quantity="Out of Stock";
	 	}
	 }
 	}
 	else{
 		echo "That item does not exist.";
 		exit();
 	}
 }
 else{
 	echo "Data to render this page is missing";
 	exit();
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
				<a href="index.php"><img src="sample_pictures\logo.png"></a>
			</div>
			<ul>
				<?php 
			    $message="";
				if(isset($_SESSION['username'])){
					$message.="<li><a href='agro.php'>Back</a></li>";
					$message.="<li><a href='agro.php'>Agro</a></li>";
					$message.="<li><a href='cart.php'>Cart</a></li>";
					//$message.="<li><a href='myorders.html'>My Orders</a></li>";
					$message.="<li><a href='contact_us.php'>Contact Us</a></li>";
					$message.='<li><a href="logout.php">Logout</a></li>';
				}else{
					$message.="<li><a href='agro.php'>Back</a></li>";
					$message.="<li><a href='index.php'>Home</a></li>";
					$message.="<li><a href='signin.php'>Login</a></li>";
				}
				 
				?>
				 <?php echo $message;?>	

			</ul>
	     </div>
	 </header>
<div class="title">
 <table width='100%' border='1' cellspacing='0' cellpadding='6'>
	 	<tr>
	 	<td width='30%' valign='top'><a href="images/<?php echo $pcode;?>.jpg"><img style='border:#666 1px solid;' src="images/<?php echo $pcode;?>.jpg" alt=".$pname." width='250' height='300' border='1'></a></td>
	 	<td width='70%' valign='top' style='color:white;' >
	 	<h4>Product Code: <?php echo $pcode ?></h4><br>
	 	<h3>Product Name: <?php echo $pname ?></h3><br>
	 	<h2>Price: Rs. <?php echo $price ?>/-</h2><br>
	 	<h4>Quantity: <?php echo $quantity ?></h4><br>
	 	<h4>Type: <?php echo $type ?></h4><br>
	 	<h4>Brand: <?php echo $brand ?></h4><br>
	 	<form id="form1" name="form1" method="POST" action="cart.php">
	 		<input type="hidden" name="pcode" id="pcode" value="<?php echo $pcode;?>">
	 		<?php
	 		$message="";
	 		if(isset($_SESSION['username']) && $quantity=="Instock"){

	 		$message.='<input type="submit" name="button" id="button" value="ADD TO CART">';

	 	    }
	 		?>
	 		<?php echo $message; ?>
	 	</form>
	 	</tr>
	 	</table>
</div>
	</body>
</html>
