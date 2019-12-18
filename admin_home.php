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
	<style type="text/css">
.box{
border: 80px;
padding: 50px;
border-radius: 10px;
background-color: gray;
text-decoration: none;
	}
	</style>
</head>
<body>
	<header>
		<div class="main">
			<div class="logo">
				<img src="sample_pictures\logo.png">
			</div>
			<ul>
				 <li><a href="logout.php">Logout</a></li>
			</ul>
	     </div>
	 </header>
		<div class="title">
			<h1>Welcome Admin!!!</h1>
			<table>
			<tr class="box">
				<td class="box"><a href="admin_view.php" style="text-decoration: none;font-size: 30px;color: green;">View Products</a></td>
				<td class="box"><a href="admin_add.php" style="text-decoration: none;font-size: 30px;color: green;">Add a Product</a></td>
			</tr>
			<tr class="box">
				<td class="box"><a href="admin_edit.php" style="text-decoration: none;font-size: 30px;color: green;">Update a Product</a></td>
				<td class="box"><a href="admin_delete.php" style="text-decoration: none;font-size: 30px;color: green;">Delete a Product</a></td>
			</tr>
			</table>
		</div>
		
	</body>
</html>