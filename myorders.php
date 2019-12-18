<?php
session_start();
if(!isset($_SESSION['username'])){
  header("Location:index.php");
}
?>

<?php
$orderoutput="";
if(!isset($_SESSION["order_array"])||count($_SESSION["order_array"])<1){
   $orderoutput.="<h2 align='center' style='color:white;'>No orders till date
  <br> <a href='agro.php' align='center'>Start shopping</a></h2><br><br>";

}
else{
	$i=0;
	$orderTotal=0;
	$conn=mysql_connect("localhost","root","");
    mysql_select_db("agro");
    if(!$conn){
	die("Connection failed:".mysql_connect_error());
    }else{
	foreach ($_SESSION["order_array"] as $each_item) {
    $item_id=$each_item['item_id'];
    $sql=mysql_query("SELECT * FROM product where pcode='$item_id' LIMIT 1");
    while($row=mysql_fetch_array($sql)){
      $product_name=$row['pname'];
      $price=$row['price'];
      $type=$row['type'];
      $pcode=$row['pcode'];
    
    $pricetotal=$price*$each_item['quantity'];
    $orderTotal=$pricetotal+$orderTotal;
    //dynamic table
    $orderoutput.='<tr>';
    $orderoutput.='<td><a href="products.php?id='.$item_id.'" style="color:white;">'.$product_name.'</a><br/><img src="images/'.$pcode.'.jpg" alt="'.$product_name.'"  width="40" height="52" border="1"/></td>';
    $orderoutput.='<td style="color:white;">'.$type.'</td>';
    $orderoutput.='<td style="color:white;">$'.$price.'</td>';
    $orderoutput.='<td style="color:white;">'.$each_item['quantity'].'</td>';
    $orderoutput.='<td style="color:white;">$'.$pricetotal.'</td>';
    $orderoutput.='</tr>';
    $i++;
  }
}
}
}
?>

<!DOCTYPE html>
<html>
<head>
<!-- CSS Styles -->
<style>
  .speech {border: 1px solid #DDD; width: 300px; padding: 0; margin: 0}
  .speech input {border: 0; width: 240px; display: inline-block; height: 30px;}
  .speech img {float: right; width: 40px }
</style>
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
					$message.="<li><a href='index.php'>Back</a></li>";
					$message.="<li><a href='cart.php'>Cart</a></li>";
					$message.="<li><a href='myorders.html'>My Orders</a></li>";
					$message.="<li><a href='contact_us.php'>Contact Us</a></li>";
					$message.='<li><a href="logout.php">Logout</a></li>';
				}else{
					$message.="<li><a href='index.php'>Home</a></li>";
					$message.="<li><a href='signin.php'>Login</a></li>";
				}
				 
				?>
				 <?php echo $message;?>	

				 
			</ul>
	     </div>
	 </header>
<div class="title">
<table width="100%" border="1" cellspacing="0" cellpadding="6">
      <tr>
        <td width="20%" bgcolor="#FFFFFF">Product</td>
        <td width="24%" bgcolor="#FFFFFF">Type</td>
        <td width="18%" bgcolor="#FFFFFF">Unit Price</td>
        <td width="10%" bgcolor="#FFFFFF">Quantity</td>
        <td width="18" bgcolor="#FFFFFF">Total</td>
      </tr>
      <?php echo $orderoutput; ?>
    </table>
</div>
</body>
</html>