<?php
session_start();
if(!isset($_SESSION['admin'])){
  header("Location:index.php");
}
?>
<?php
$conn=mysql_connect('127.0.0.1','root','');
mysql_select_db('agro');
if(!isset($_POST['update'])){
$pcode=test_input($_POST['pcode']);
$sql="select * from product where pcode='".$pcode."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$pname=$row['pname'];
$price=$row['price'];
$quantity=$row['quantity'];
$type=$row['type'];
$brand=$row['brand'];
}
else{
$prdcode=test_input($_POST['prdcode']);
$prdname=test_input($_POST['prdname']);
$prdprice=test_input($_POST['prdprice']);
$prdbrand=test_input($_POST['prdbrand']);
$type=test_input($_POST['type']);
$quantity=test_input($_POST['quantity']);
$result=mysql_query("update product set pname='".$prdname."',price=".$prdprice.",brand='".$prdbrand."',type='".$type."',quantity=".$quantity." where pcode='".$prdcode."'");
if(!$result){
  echo "<script>
        alert('Error!!!!Update the product again');
        window.location='admin_edit.php';
        </script>";
}
else{
        $message="";
        $temp = explode(".",$_FILES["fileToUpload"]["name"]);
        $extension = end($temp);
        $str=$prdcode.".";
        $target_file = 'images/'.$str.$extension;
        $uploadOk = 1;
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
        $message.= "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
        } else {
        $message.= "File is not an image.";
        $uploadOk = 0;
        }
        }
           // Check if file already exists
        if (file_exists($target_file)) {
         unlink($target_file);
         }
         // Check file size
         if ($_FILES["fileToUpload"]["size"] > 500000) {
           $message.= "Sorry, your file is too large.";
          $uploadOk = 0;
          }
            // Allow certain file formats
         if($extension != "jpg" && $extension != "png" && $extension != "jpeg" && $extension != "gif" ) {
         $message.= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
         $uploadOk = 0;
        }
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $message.= "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $message= "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        $message= "Sorry, there was an error uploading your file.";
    }
}
  echo "<script>
        alert('Product Updated Successfully..".$message."');
        window.location.href='admin_edit.php';
        </script>";
}

}
function test_input($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
  }
mysql_close();
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
				<a href="admin_home.html"><img src="sample_pictures\logo.png"></a>
			</div>
			<ul>
				<li><a href="admin_edit.php">Back</a></li>
       
			</ul>
	     </div>
     </header>
		<div class="title">
			<div class="login-page">
  <div class="form">
    <form class="login-form" method="POST" action="<?php $_PHP_SELF ?>"  enctype="multipart/form-data">
      <input type="number" placeholder="Product Code" name="prdcode" id="prdcode" value="<?php echo $pcode;?>">
      <input type="text" placeholder="Product Name" name="prdname" id="prdname" value="<?php echo $pname;?>">
      <input type="number" placeholder="Price" name="prdprice" id="prdprice"value="<?php echo $price;?>">
      <input type="text" placeholder="Brand" name="prdbrand" value="<?php echo $brand;?>">
      <input list="type" placeholder="Type" name="type" value="<?php echo $type;?>">
      <datalist id="type">
        <option value="Fertilizer">Fertilizer</option>
        <option value="Pesticide">Pesticide</option>
        <option value="Seeds">Seeds</option>
      </datalist>
      <input type="number" placeholder="Quantity"  name="quantity" min="1" max="100" value="<?php echo $quantity;?>">
      <div style="color: white;">Image</div><input type="file" name="fileToUpload" accept="image/*" value="img src='images/<?php echo $pcode;?>.jpg' "><!--accepts only imagefiles-->
      <button onclick="return validate()" name="update">Update</button>
    </form>
  </div>
</div>
		</div>
		<script type="text/javascript">
       function validate(){
           var prdcode=document.getElementById('prdcode').value;
           var prdname=document.getElementById('prdname').value;
           var prdprice=document.getElementById('prdprice').value;
           if(prdcode.length!=5){
            alert("Invalid Product Code");
            //window.location='admin_add.html';
            return false;
           }
           else{
           var patt1=/[a-zA-Z0-9]/;
           if(patt1.test(prdname)==false){
            alert("Invalid Product Name");
            //window.location='admin_add.html';
            return false;
           }
          else{
            if(prdprice<=0){
              alert("Invalid product price");
              //window.location='admin_add.html';
              return false;
            }
          }
         }
       }

    </script>
	</body>
</html>