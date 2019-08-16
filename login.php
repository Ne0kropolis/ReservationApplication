<!DOCTYPE html>
<html>
<head>
<title>Travel Buddy - Login</title>
<link rel="stylesheet" type="text/css" href="css/login.css">

<?php

include_once("DatabaseFunctions.php");
include_once("SessionVariables.php");

killSession();

if (isset($_POST['submit'])) {
	if (login($_POST['username'], md5($_POST['password']))) {
		setUser(getUserID($_POST['username']));
		header('Location: properties.php');
	}
	else {
		echo "<script type='text/javascript'>alert('Login Unsuccessful!')</script>";
		//WHATEVER YOU WANT TO DO IF IT FAILS HERE
	}
}
?>

</head>
<body>
<div class="login-page" id="login-page">
  <div class="form" method="post" action="index.php">
	<img src="img_website/logo.jpg" class="logo">
    <form class="login-form" name="login-form" method="Post" action="">
      <input type="text" name="username" placeholder="email" required>
      <input type="password" name="password" placeholder="password" required>
      <button type="submit" name="submit">login</button><br><br>
	  <button type="button" name="sign-up" onClick="document.location.href='sign-up.php'">Sign-up</button>
	  <br><br>
	  <a href="forgotPass.php" style="float:left;">Forgot Password?</a>
    </form>
  </div>
</div >
</body>
</html>