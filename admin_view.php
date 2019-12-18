<?php
session_start();
if(!isset($_SESSION['admin'])){

	header("Location:index.php");
}
?>
<!DOCTYPE html>
<html>
<head>

	<title>AGRO ANYTHING</title>
	<!--<link rel="stylesheet" type="text/css" href="css/agro.css">-->
</head>

<body>
	<header>
		<div class="main">
			<div class="logo">
				<a href="admin_home.php"><img src="sample_pictures\logo.png"></a>
			</div>
	     </div>
	 </header>
<?php
$dynamicList= "";
$conn=mysql_connect("localhost","root","");
mysql_select_db("agro");
if(!$conn){
	die("Connection failed:".mysql_connect_error());
}
else{
	$sql="select pcode,pname,price,quantity,type,brand from product";
	$result=mysql_query($sql);
	$productCount=mysql_num_rows($result);
	if($productCount>0){
		if($result == false){
        die(mysql_error());
        }
	 while($row=mysql_fetch_array($result)){
	 	$pcode=$row["pcode"];
	 	$pname=$row["pname"];
	 	$price=$row["price"];
	 	$quantity=$row["quantity"];
	 	$type=$row["type"];
	 	$brand=$row["brand"];
	 	//$image=$row["image"];
	 	$dynamicList .="
	 	<table width='50%' border='1' align='center'>
	 	<tr>
	 	<td width='28%' valign='top'><img style='border:20px solid #fff;' src='images/".$pcode.".jpg' alt=".$pname." width='150' height='220' border='1'></td>
	 	<td width='72%' align='top' style='padding:20px'>
	 	<h4>Product Code: ".$pcode."</h4>
	 	<h3>Product Name: ".$pname."</h3>
	 	<h2>Price:Rs.".$price."/-</h2>
	 	<h4>Quantity: ".$quantity."</h4>
	 	<h4>Type: ".$type."</h4>
	 	<h4>Brand: ".$brand."</h4>
	 	</tr>
	 	</table>

	 	";

	 }
}
else{
	$dynamicList = "We have no products listed in our store yet";
}
}
mysql_close();	


	?>
	<div class="title">
	<p>
		<?php 
		echo $dynamicList;
		?>
			
		</p>
		</div>

	</body>
</html>