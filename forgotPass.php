<!DOCTYPE html>
<html>
<head>
<title>Real Estate Portal - Forgot Password</title>
<link rel="stylesheet" type="text/css" href="css/login.css">

<?php

include_once("DatabaseFunctions.php");

if (isset($_POST['submit'])) {
	$email = $_POST['username'];
	if (checkEmail($email)) {
		mail($email, "Requested Password Reset", "Good Day, <br>To reset your password please click on the link provided below.  If you didn't issue a password reset you can safely ignore this email.<br><a href='http://localhost/OnlineStore/passChange.php?id=" . $email . "&username=admin%27%3Eaccount.change/reset/password'</a><br> Have a nice day,<br> Shoplist.com", "Content-Type: text/html; charset=UTF-8\r\n");
		echo "<script type='text/javascript'>alert('Recovery email sent!')</script>";
		echo "<script>location.href = 'login.php';</script>";
	}
	else {
		echo "<script type='text/javascript'>alert('This address is not registered!')</script>";
	}
}

?>

</head>
<body>
<div class="login-page" id="login-page">
  <div class="form" method="post" action="index.php">
	<img src="img_website/logo.png">
    <form class="login-form" name="login-form" method="Post" action="">
      <input type="text" name="username" placeholder="email" required>
      <button type="submit" name="submit">Submit</button><br><br>
    </form>
  </div>
</div >
</body>
</html>