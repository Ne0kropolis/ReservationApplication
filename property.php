<!DOCTYPE html>
<html>
	<head>
	<title>Property Portal - Property</title>
		<?php
			include_once("SessionVariables.php");
			include_once("DatabaseFunctions.php");
		?>
		<link rel="stylesheet" type="text/css" href="css/home.css">
	</head>
	<body>

		<form method="post" action="">
			<div class="headbox">
				<img src="img_website/logoheader.jpg" class="logo">
					<?php				
						if (getSessionStatus()){ //If session exists display users name, otherwise suggest to login or sign-up
							echo '<a href="properties.php" class="login">'. getUserName(getUser()) .'</a>';
							//echo "<script type='text/javascript'>alert('" . $_GET['id'] . "')</script>";
						}
						else {
							echo '<a href="login.php" class="login">Login</a>';
						}
					?>	
			</div>
			<div class="headbox2">
				<img src="img_website/logo.png" class="logo">
			</div>
		
			<?php
				showPropertyPage($_GET['id']);
			?>	
				<button type="button" name="back" onclick="document.location.href='properties.php'" style="padding: 15px; float: right">Back</button>
				</div>
				
			<?php
				if (isset($_POST['id'])) {
					$propertyID = $_POST['id'];
					if (getUser() != "") {
						header("Location: booking.php?id=$propertyID");
					}
					else {
						echo "<script type='text/javascript'>alert('You are not logged in!')</script>";
					}
				}
			?>
		</form>
	</body>
</html>
