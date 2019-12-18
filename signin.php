<!DOCTYPE html>
<html>
<head>

	<title>AGRO ANYTHING</title>
	<script type="text/javascript" src="dist/sweetalert.min.js"></script>
	<link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
	<link rel="stylesheet" type="text/css" href="css/agro.css">
</head>
<body>
	<header>
		<div class="main">
			<div class="logo">
				<a href="index.php"><img src="sample_pictures\logo.png" alt="Logo"></a>
			</div>
			<ul>
				<li><a href="signin.php">Signin</a></li>
				<li><a href="signup.html">Signup</a></li>
				<li><a href="index.php">Back</a></li>
       
			</ul>
	     </div>
	 </header>
		<div class="title">
			<div class="login-page">
  <div class="form">
    <form class="login-form" method="POST" action="php_validate_signin.php">
      <input type="text" placeholder="Username" name="uname" id="uname" value="<?php echo @$_COOKIE['username'] ?>">
      <input type="password" placeholder="Password" name="pass" id="pass" value="<?php echo @$_COOKIE['password'] ?>">
      <input  type="checkbox" name="check"><div style="color: white;">Remember me</div>
      <button onclick="return validate();">login</button>
      <p class="message">Not registered? <a href="signup.html">Create an account</a></p>
    </form>
  </div>
</div>
</div>

<script type="text/javascript">
    function validate() {
        var username = document.getElementById("uname").value;
        var password = document.getElementById("pass").value;
        if (username == null || username == "") {
            alert("Please enter the username.");
            //window.location="signin.html";
            return false;
        }
        else{
            if (password == null || password == "") {
            alert("Please enter the password.");
            //window.location="signin.html";
             return false;
            }
            else{
                var patt1=/[a-zA-Z0-9]/;
                if(patt1.test(username)==false){
        	        alert("Enter a valid username");
        	        //window.location="signin.html";
        	        return false;
                }
                else{
                    var patt2=/[A-Z]+[a-z]+[0-9]+/g;
                    if(password.length<9 || patt2.test(password)==false){
                    alert("Invalid Username or password");
                    //window.location="signin.html";
                    return false;
        			}
    			}
    		}
    	}
       //swal('Congratulation!', 'You successfully copy paste this code', 'success', 3000, false)
    }

</script>
</body>
</html>