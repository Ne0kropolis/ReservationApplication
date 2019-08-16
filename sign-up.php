<!DOCTYPE html>
<html>
<head>
<title>Travel Buddy - Sign-up</title>
<link rel="stylesheet" type="text/css" href="css/login.css">

<?php
include_once("DatabaseFunctions.php");
include_once("SessionVariables.php");

if (isset($_POST['createAccount'])) {
	if (signUp($_POST['firstname'], $_POST['surname'], $_POST['email'], $_POST['cpassword'])) {
		if ($_POST['userType'] === "Agent") {
			signUpAgent($_POST['firstname'], $_POST['surname'], $_POST['phoneNumber'], $_POST['email']);
		}
		echo "<script type='text/javascript'>alert('Registration successful!')</script>";
	}
	else {
		echo "<script type='text/javascript'>alert('Registration Failed!')</script>";
	}
	//LOAD NEXT PAGE HERE
	echo "<script>location.href = 'login.php';</script>";
}
?>

</head>
<body>
<div class="login-page">
  <div class="form" >
    <form class="login-form" name="login-form" method="Post" action="" enctype="multipart/form-data">
		<input type="text" name="firstname" placeholder="firstname" required>
		<input type="text" name="surname" placeholder="surname" required>
		<input type="text" name="phoneNumber" placeholder="phoneNumber" required>
		<input type="email" name="email" placeholder="email" required>
		<input type="password" name="password" placeholder="password" required>
		<input type="password" name="cpassword" placeholder="confirm password" required>
		<select name="userType">
		<option value="Agent">Agent</option>
		<option value="User">User</option>
		</select>
		<br>
      <button type="submit" name="createAccount">Sign-up</button><br><br>
	  <button type="button" name="Back" onClick="document.location.href='login.php'">Back</button>
    </form>
  </div>
</div >
</body>
</html>