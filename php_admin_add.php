<?php
session_start();
if(!isset($_SESSION['admin'])){
  header("Location:index.php");
}
?>
<?php
$prdcode=test_input($_POST['prdcode']);
$prdname=test_input($_POST['prdname']);
$prdprice=test_input($_POST['prdprice']);
$prdbrand=test_input($_POST['prdbrand']);
$type=test_input($_POST['type']);
$quantity=test_input($_POST['quantity']);

$conn=mysql_connect("localhost","root","");
mysql_select_db("agro");
if(!$conn){
	die("Connection failed:".mysqli_connect_error());
}
else{
    $sql="insert into product(pcode,pname,price,quantity,type,brand) values ('$prdcode','$prdname',$prdprice,$quantity,'$type','$prdbrand')";
    $result=mysql_query($sql);
    if(!$result){
        echo '<script type="text/javascript">'; 
        echo 'alert("Error!!!Add the product Again");'; 
        echo 'window.location.href = "admin_add.php";';
        echo '</script>';
    }
    else{
        $message="";
        $temp = explode(".", $_FILES["fileToUpload"]["name"]);
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
         $message.= "Sorry, file already exists.";
         $uploadOk = 0;
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
        echo '<script type="text/javascript">'; 
        echo 'alert("Product added Successfully..'.$message.'");'; 
        echo 'window.location.href = "admin_add.php";';
        echo '</script>';
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