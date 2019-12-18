<?php
session_regenerate_id();
session_start();
?>
<?php
$uname=test_input($_POST['uname']);
$pass=test_input($_POST['pass']);
$conn=mysql_connect("localhost","root","");
mysql_select_db("agro");
if(!$conn){
	die("Connection failed:".mysqli_connect_error());
}
else{
    if($uname== "Niharika" && $pass=="MNiharika8"){
        $_SESSION['admin']='admin';
        echo "<script>
        window.location='admin_home.php';
        </script>";

    }
    else{
    $result=mysql_query("select * from user where username='".$uname."' and password='".$pass."';") or die("Failed to query database".mysql_error());
	$row=mysql_fetch_array($result);
    $num=mysql_num_rows($result);
    if($num==1){
        $_SESSION['username']=$row['username'];
        $_SESSION['agri_card']=$row['agri_card'];
        if(isset($_POST['check'])){
            setcookie('username',$uname,time()+(86400*30));
            setcookie('password',$pass,time()+(86400*30));

        }

        echo "<script>
        alert('Login Successful.');
        window.location.href='agro.php".mysql_error()."';
        </script>" ;
    }
    else{
    	echo "<script>
        alert('Login Failed');
        window.location.href='signin.php';
        </script>";
    }
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