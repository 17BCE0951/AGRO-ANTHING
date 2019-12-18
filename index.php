<?php
session_start();
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
				 <li class="current"><a href="index.php">Home</a></li>
                 <li><a href="agro.php">Agro</a></li>
                  <li><a href="business.html">About</a></li>
                 <?php
                 $message="";
                 if(isset($_SESSION['username'])){
                 $message.='<li><a href="logout.php">Logout</a></li>';
                 }
                 else{
                 $message.='<li><a href="signin.php">Login</a></li>';
             }
       ?>
       <?php echo $message; ?>
			</ul>
	     </div>
		<div class="title">
			<h1>AGRO ANYTHING</h1>
			<br><br>
			<h3 style="color: white;">BEST QUALITY INDIA AGRICULTURE PRODUCTS</h3><br>
		    <p style="color: white;">Agro Anything is India's No.1 Market Place for farmers and all other agriculture stake holders. Farmers can transparently buy pesticides,fertilizers and seeds using online shopping and e commerce platform.We always strive to provide NO 1 quality products.You will be provided with agri card which makes you eligible for exciting offers...<br><br><div style="color:white;" align="center"><h3>HAPPY SHOPPING!!!</h3></div></p>
		</div>
		<div>
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