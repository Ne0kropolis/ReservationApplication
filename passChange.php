<!DOCTYPE html>
<html>
<head>
<title>Shoplist - Change Password</title>
<link rel="stylesheet" type="text/css" href="css/login.css">

<?php

include_once("DatabaseFunctions.php");

if (isset($_POST['submit'])) {
	changePassword($_GET['id'], $_POST['password']);
	echo "<script type='text/javascript'>alert('Password reset!')</script>";
	echo "<script>location.href = 'login.php';</script>";
}

?>

</head>
<body>
<div class="login-page" id="login-page">
  <div class="form" method="post" action="index.php">
	<img src="img_website/logo.png">
    <form class="login-form" name="login-form" method="Post" action="">
      <input type="password" name="password" placeholder="New password" required>
      <button type="submit" name="submit">Submit</button><br><br>
    </form>
  </div>
</div >
</body>
</html>