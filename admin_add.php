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
	<link rel="stylesheet" type="text/css" href="css/agro.css">
</head>
<body>
	<header>
		<div class="main">
			<div class="logo">
				<a href="admin_home.php"><img src="sample_pictures\logo.png"></a>
			</div>
			<ul>
				<li><a href="admin_home.php">Back</a></li>
       
			</ul>
	     </div>
     </header>
		<div class="title">
			<div class="login-page">
  <div class="form">
    <form class="login-form" method="POST" action="php_admin_add.php" enctype="multipart/form-data">
      <input type="text" placeholder="Product Code" name="prdcode" id="prdcode" required>
      <input type="text" placeholder="Product Name" name="prdname" id="prdname" required>
      <input type="number" placeholder="Price" name="prdprice" id="prdprice"required>
      <input type="text" placeholder="Brand" name="prdbrand" required>
      <input list="type" placeholder="Type" name="type" required>
      <datalist id="type">
        <option value="Fertilizer">Fertilizer</option>
        <option value="Pesticide">Pesticide</option>
        <option value="Seeds">Seeds</option>
      </datalist>
      <input type="number" placeholder="Quantity" name="quantity" min="1" max="100" >
      <div style="color: white;">Image</div><input type="file" name="fileToUpload" accept="image/*" required><!--accepts only imagefiles-->
      <button onclick="return validate()">Add</button>
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