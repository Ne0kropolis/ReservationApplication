<!DOCTYPE html>
<html>
	<head>
	<title>Travel Buddy - Booking</title>
		<?php
			include_once("SessionVariables.php");
			include_once("DatabaseFunctions.php");
		?>
		<link rel="stylesheet" type="text/css" href="css/home.css">
	</head>
	<body>

		<form method="post" action="" class="form">
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
			<div class='title_block center'>
			<h1><b>Guest Details Form</b></h1>
			</div>
			<div class='product_block'>
				<b>First Name:</b><br> <input type="text" name="firstname" required >
			</div>
			<div class='product_block'>
				<b>Last Name:</b> <input type="text" name="surname" required>
			</div>
			<div class='product_block'>
				<b>Phone Number:</b> <input type="text" name="phoneNumber" required>
			</div>
			<div class='product_block'>
				<b>Email Address:</b> <input type="email" name="email" required>
			</div>
			<div class='product_block'>
				<b>Booking Date:</b> <input type="date" name="date" required>
			</div>
			<div class='product_block'>
				<button type = 'submit' id = 'addToCart' name = 'purchase' value = "purchase">Confirm Booking</button>
				<button type="button" name="back" onclick="document.location.href='properties.php'" style="padding: 15px; float: right">Back</button>
			</div>
				
			<?php
				if (isset($_POST['purchase'])) {
					$propertyID = $_GET['id'];
					$bookingDate = $_POST['date'];
					$status = getSaleStatus($propertyID, $bookingDate);
					if ($status == true) {
						if (!buyerExists($_POST['firstname'], $_POST['surname'], $_POST['phoneNumber'], $_POST['email'])) {
							insertBuyer($_POST['firstname'], $_POST['surname'], $_POST['phoneNumber'], $_POST['email']);
						}
						$buyerID = getBuyerID($_POST['firstname'], $_POST['surname'], $_POST['phoneNumber'], $_POST['email']);
						$agentID = "";
						if (getUser() != "") {
							makePurchase($propertyID, $buyerID, $agentID, $bookingDate);
						}
						else {
							echo "<script type='text/javascript'>alert('You are not logged in!')</script>";
						}
					}
					else {
						echo "<script type='text/javascript'>alert('A booking for this date has already been made! " . $status . "')</script>";
					}
				}
			?>
		</form>
	</body>
</html>
