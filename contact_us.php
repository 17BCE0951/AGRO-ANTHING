<?php
session_start();
if(!isset($_SESSION['username'])){
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
        <a href="index.php"><img src="sample_pictures\logo.png" alt="Logo"></a>
      </div>
      <ul>
         <li><a href="agro.php">Agro</a></li>
         <li><a href="cart.php">Cart</a></li>
         <li><a href="contact_us.php">Contact Us</a></li>
         <li><a href="logout.php">Logout</a></li>
      </ul>
      </div>
  </header>
  <div class="title">
    <div class="contact-page">
      <br>
      <br>
  <div class="form">
    <h2 style="color: white;">Product Feedback</h2><br><br>
    <h4 style="color: white;"><p>We always strive to provide you the best products with excellent quality.<br>If you have any queries regarding products leave a feedback in the box given below</p></h4><br><br>
    <form class="contact-form" method="POST" action="<?php $_PHP_SELF ?>">
      <textarea rows="7" cols="54" name="message"  id="message"></textarea>
      <button name="send" value="Send">Send</button>
    </form>
  </div>
</div>

<?php 
require 'PHPMailer-master/src/PHPMailer.php'; 
require 'PHPMailer-master/src/SMTP.php';
if(isset($_POST['send'])) 
{ 
$to='tomail@gmail.com'; 
$message = $_POST['message']; 
$subject = 'User Comments'; 
$mail = new PHPMailer\PHPMailer\PHPMailer(); 
$mail->IsSMTP(); 
$mail->Host = 'smtp.gmail.com'; 
$mail->Port = 587; 
$mail->SMTPSecure = 'tls'; 
$mail->SMTPAuth = true; 
$mail->SetFrom('youremail@gmail.com');
$mail->Username = 'youremail@gmail.com'; 
$mail->Password = 'yourpass'; 
$mail->addAddress($to); 
$mail->Subject=$subject; 
$mail->msgHTML($message); 
if ($mail->send()) { 
 echo '<script>alert("Thanks for your comments!");</script>'; 
} 
else { 
  $error = "Mailer Error: " . $mail->ErrorInfo; 
echo '<p>'.$error.'</p>';

} 
} 
?> 
</body> 
</html> 
  </div>
   
</body>
</html>
