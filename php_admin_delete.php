<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location:index.php");
}
?>
<?php
$pcode=test_input($_POST['pcode']);
$conn=mysql_connect('127.0.0.1','root','');
mysql_select_db('agro');
if(!$conn){
    die("Connection failed:".mysqli_connect_error());
}
else
{
    $sql="delete from product where pcode='".$pcode."'";
    $result=mysql_query($sql);
    if(!$result){
        echo '<script type="text/javascript">'; 
        echo 'alert("Error!!!Delete the product again");'; 
        echo 'window.location.href = "admin_delete.php";';
        echo '</script>';
    }
    else{
        $path=$_SERVER['DOCUMENT_ROOT'].'/agro/images/'.$pcode.'.jpg';
        unlink($path);
        echo '<script type="text/javascript">'; 
        echo 'alert("Product Deleted Successfully");'; 
        echo 'window.location.href = "admin_delete.php";';
        echo '</script>';
    }
}
function test_input($data){
    $data=trim($data);
    $data=stripslashes($data);
    return $data;
}

?>