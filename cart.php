<?php
session_start();
if(!isset($_SESSION['username'])){
  header("Location:index.php");
}
?>
<?php
 $conn=mysql_connect("localhost","root","");
mysql_select_db("agro");
if(!$conn){
  die("Connection failed:".mysql_connect_error());
  }
?>
<?php
///to Insert into a session
$flag=0;
  if(isset($_POST['pcode'])){
  	$pcode=$_POST['pcode'];
  	$wasFound=false;
  	$i=0;
  	if(!isset($_SESSION["cart_array"])||count($_SESSION["cart_array"])<1){
        $_SESSION["cart_array"] = array('0' =>array("item_id"=>$pcode,"quantity"=>1));
  	}else{
       foreach ($_SESSION["cart_array"] as $each_item) {
       	$i++;
       	while(list($key,$value)=each($each_item)){
       		if($key=="item_id" && $value==$pcode){
       			array_splice($_SESSION["cart_array"],$i-1,1,array(array("item_id"=>$pcode,"quantity"=>$each_item['quantity']+1)));
       			  $wasFound=true;
       		}
       	}
       }
       if($wasFound==false){
       	array_push($_SESSION["cart_array"],array("item_id"=>$pcode,"quantity"=>1));
       }
  	}
    header("location: cart.php");
    exit();
  }
?>


<?php
///to Delete all cart items

if(isset($_GET['cmd'])&& $_GET['cmd']=="emptycart"){
	unset($_SESSION["cart_array"]);
}
?>


<?php
///user chooses to adjust quantity
if(isset($_POST['item_to_adjust'])&& $_POST['item_to_adjust']!=""){

  $item_to_adjust=$_POST['item_to_adjust'];
  $quantity=$_POST['quantity'];
  $quantity = preg_replace('#[^0-9]#i', '', $quantity); // filter everything but numbers
$sql="select quantity from product where pcode='$item_to_adjust'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$max=$row['quantity'];

  if ($quantity >= $max) 
    { 
      echo '<script>alert("Only $max are available in stock")</script>';
      $quantity = $max; 
    }
  if ($quantity < 1) 
    { 
       echo '<script>alert("Atleast quantity should be one")</script>';
      $quantity = 1; 
    }
  if ($quantity == "") 
    { 
      $quantity = 1; 
    }
  $i=0;
  foreach ($_SESSION["cart_array"] as $each_item) {
        $i++;
        while(list($key,$value)=each($each_item)){
          if($key=="item_id" && $value==$item_to_adjust){
            array_splice($_SESSION["cart_array"],$i-1,1,array(array("item_id"=>$item_to_adjust,"quantity"=>$quantity)));
              $wasFound=true;
      }
    }
  }
}


?>
<?php
////to remove particular item

if(isset($_POST['index_to_remove'])&& $_POST['index_to_remove']!=""){

  $key_to_remove=$_POST['index_to_remove'];
  if(count($_SESSION["cart_array"])<=1){
    unset($_SESSION["cart_array"]);
  }
  else{
    unset($_SESSION["cart_array"]["$key_to_remove"]);
    sort($_SESSION["cart_array"]);
  }
}
?>


<?php
///to Display Cart Items

$cartOutput="";
$cartTotal="";
$cartTotalStyle="";
if(!isset($_SESSION["cart_array"])||count($_SESSION["cart_array"])<1){
  $cartOutput="<h2 align='center' style='color:white;'>Your shopping cart is empty
  <br> <a href='agro.php' align='center'>Start shopping</a></h2><br><br>";
  $flag=1;
}
else{

  $i=0;
    foreach ($_SESSION["cart_array"] as $each_item) {
    $item_id=$each_item['item_id'];
    $sql=mysql_query("SELECT * FROM product where pcode='$item_id' LIMIT 1");
    while($row=mysql_fetch_array($sql)){
      $product_name=$row['pname'];
      $price=$row['price'];
      $type=$row['type'];
      $pcode=$row['pcode'];
    
    $pricetotal=$price*$each_item['quantity'];
    $cartTotal=$pricetotal+$cartTotal;

    //setlocale(LC_MONETARY,"en_US");
    //$pricetotal = money_format("%10.2n", $pricetotal);
    
    //Dynamic Checkout Btn Assembly
    $x=$i+1; 
    
    
    //dynamic table
    $cartOutput.='<tr>';
    $cartOutput.='<td style="color:white;"><a href="products.php?id='.$item_id.'" style="color:white;text-decoration:none;">'.$product_name.'</a><br/><img src="images/'.$pcode.'.jpg" alt="'.$product_name.'"  width="40" height="52" border="1"/></td>';
    $cartOutput.='<td style="color:white;">'.$type.'</td>';
    $cartOutput.='<td style="color:white;">Rs.'.$price.'</td>';
    $cartOutput.='<td style="color:white;"><form action="cart.php" method="POST">
    <input name="quantity" type="text" size="1" value="'.$each_item['quantity'].'" maxlength=2></input>
    <input name="adjustBtn'.$item_id.'" type="submit" value="change"></input>
    <input name="item_to_adjust" type="hidden" value="'.$item_id.'"></input>
    </form></td>';
   // $cartOutput.='<td>'.$each_item['quantity'].'</td>';
    $cartOutput.='<td style="color:white;">Rs.'.$pricetotal.'</td>';
    $cartOutput.='<td style="color:white;"><form action="cart.php" method="POST">
    <input name="deleteBtn'.$item_id.'" type="submit" value="X"></input>
    <input name="index_to_remove" type="hidden" value="'.$i.'"></input>
    </form></td>' ;
    $cartOutput.='</tr>';
    $i++;
  }
  //setlocale(LC_MONETARY,"en_US");
  //$cartTotal=money_format("%10.2n", $cartTotal);
  $cartTotalStyle="<div style='color:white'align='right'><h4>Cart Total:Rs.".$cartTotal."INR</h4></div>";
  //Finish the Paypal Checkout Btn


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
         <li><a href="agro.php">Back</a></li>
         <li><a href="agro.php">Agro</a></li>
         <li><a href="cart.php">Cart</a></li>
         <li><a href="myorders.php">My Orders</a></li>
         <li><a href="contact_us.php">Contact Us</a></li>
         <li><a href="logout.php" >Logout</a></li>
      </ul>
       </div>
   </header>
   <div class="title">

    <br>
    <table width="100%" border="1" cellspacing="0" cellpadding="6">
      <tr>
        <td width="20%" bgcolor="#FFFFFF">Product</td>
        <td width="24%" bgcolor="#FFFFFF">Type</td>
        <td width="18%" bgcolor="#FFFFFF">Unit Price</td>
        <td width="10%" bgcolor="#FFFFFF">Quantity</td>
        <td width="18" bgcolor="#FFFFFF">Total</td>
        <td width="10%" bgcolor="#FFFFFF">Remove</td>
      </tr>
      <?php echo $cartOutput; ?>
    </table>
<br>
<br>
    <?php echo $cartTotalStyle; ?>
    <br>
<br>
<?php 
if($flag!=1)
{
?>
    <h4><a href="agro.php" style="color: white;text-decoration:none;">Continue Shopping</a></h4><br>
    
    <h4><a href="cart.php?cmd=emptycart" style="color: white;text-decoration:none;">Click here to empty your shopping Cart</a></h4>
    <?php
$MERCHANT_KEY = "XXX";
$SALT = "XXXX";
$txnid=substr(md5(time()), 0, 19);
$name="yourname";
$email="yourmail";
$amount=$cartTotal;

if($_SESSION['agri_card']!=""){
  $amount=$amount-0.2*$amount;
}
$phone="XXXXXXXXXX";
$surl="http://localhost/agro/cart.php";
$furl="http://localhost/agro/cart.php";
$productInfo="AgroProducts";

// Merchant Salt as provided by Payu

$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
$hashString=$MERCHANT_KEY."|".$txnid."|".$amount."|".$productInfo."|".$name."|".$email."|||||||||||".$SALT;
   
$hash = strtolower(hash('sha512', $hashString));
?>
<form action="https://sandboxsecure.payu.in/_payment"  name="payuform" method=POST >
      <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY;?>" />
<input type="hidden" name="hash"  value="<?php echo $hash; ?>" />
<input type="hidden" name="txnid" value="<?php echo $txnid; ?>"/>
<input type="hidden" name="service_provider" value="" />
<input type="hidden" name="amount" value="<?php echo $amount;?>">
<input type="hidden" name="surl" value="<?php echo $surl;?>"/>
<input type="hidden" name="furl" value="<?php echo $furl;?>"/>
<input type="hidden" name="firstname" value="<?php echo $name;?>"/>
<input type="hidden" name="email" value="<?php echo $email;?>"/>
<input type="hidden" name="phone" value="<?php echo $phone;?>"/>
<input type="hidden" name="productinfo" value="<?php echo $productInfo;?>"/>
<br>
<input type="submit" value="Proceed to Checkout"/>
</form>
<br><br>

<form method="POST" action="paydummy.php">
  <input type="hidden" name="amount" value="<?php echo $cartTotal; ?>">
  <input type="submit" name="submit" value="Sample Checkout">

</form>
<?php
}
?>
</div>

   </body>
   </html>