<?php
session_start();
?>

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
	 	$dynamicList .="
	 	<table width='100%' border='1' cellspacing='0' cellpadding='6'>
	 	<tr>
	 	<td width='30%' valign='top'><img style='border:#666 1px solid;' src='images/".$pcode.".jpg' alt=".$pname." width='100' height='120' border='1'></td>
	 	<td width='70%' valign='top' style='color:white;'>
	 	<h4>".$pname."</h4><br>
	 	<h3>Rs.".$price."/-</h3><br>
	 	<a href='products.php?id=".$pcode."' style='text-decoration:none;color:white;'>View Product Details</a>
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

<?php
$dynamicList1="";
if(isset($_GET['q'])){
	$query=$_GET['q'];
$conn=mysql_connect("localhost","root","");
mysql_select_db("agro");
if(!$conn){
	die("Connection failed:".mysql_connect_error());
}
else{
    $sql="select pcode,pname,price,quantity,type,brand from product where type  like '$query%'";
    $result=mysql_query($sql);
    $productCount=mysql_num_rows($result);
	if($productCount>0){
		if($result == false){
        die(mysql_error());
        }
    else{
    	while($row=mysql_fetch_array($result)){
	 	$pcode=$row["pcode"];
	 	$pname=$row["pname"];
	 	$price=$row["price"];
	 	$dynamicList1 .="
	 	<table width='100%' border='1' cellspacing='0' cellpadding='6'>
	 	<tr>
	 	<td width='30%' valign='top'><img style='border:#666 1px solid;' src='images/".$pcode.".jpg' alt=".$pname." width='100' height='120' border='1'></td>
	 	<td width='70%' valign='top' style='color:white;'>
	 	<h4>".$pname."</h4><br>
	 	<h3>Rs.".$price."/-</h3><br>
	 	<a href='products.php?id=".$pcode."' style='text-decoration:none;color:white;'>View Product Details</a>
	 	</tr>
	 	</table>
	 	";

    }
    }
}
else{
	$sql="select pcode,pname,price,quantity,type,brand from product where pname  like '$query%'";
    $result=mysql_query($sql);
    $productCount=mysql_num_rows($result);
    if($productCount>0){
    	if($result == false){
        die(mysql_error());
        }
        else{
        	while($row=mysql_fetch_array($result)){
	 	    $pcode=$row["pcode"];
	 	    header("Location:products.php?id=".$pcode);
	    }

        }
    }
    else{
	$dynamicList1.="NO results found";
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
	<title>AGRO</title>
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
					$message.="<li><a href='myorders.php'>My Orders</a></li>";
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
	<!-- Search Form -->
<!--  <div class="speech">
    <input type="text" name="q" id="transcript" placeholder="Speak" />
    <img onclick="startDictation()" src="//i.imgur.com/cHidSVu.gif" />
  </div>
</form>-->

<?php
if(!isset($_GET['q'])){
	?>
 <p><?php echo $dynamicList ?></p>	
 <?php
 }
 ?>
 <p><?php echo $dynamicList1 ?></p>
</div>
<!-- HTML5 Speech Recognition API -->
<script>
  function startDictation() {

    if (window.hasOwnProperty('webkitSpeechRecognition')) {

      var recognition = new webkitSpeechRecognition();

      recognition.continuous = false;
      recognition.interimResults = false;

      recognition.lang = "en-US";
      recognition.start();

      recognition.onresult = function(e) {
        document.getElementById('transcript').value
                                 = e.results[0][0].transcript;
        recognition.stop();
        document.getElementById('labnol').submit();
      };

      recognition.onerror = function(e) {
        recognition.stop();
      }

    }
  }
</script>
	</body>
</html>
