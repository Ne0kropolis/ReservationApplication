<?php

include_once("DBConn.php");

function login($in_email, $in_pass) {
	
	$query = "SELECT emailAddress FROM OfficeUser WHERE emailAddress = '$in_email' && password = '$in_pass'";
	$resultSet = mysqli_query($GLOBALS['conn'], $query);
	if ($row = mysqli_fetch_assoc($resultSet)) {
		return true;
	}
	else {
		return false;
	}
}

function signUp($in_fName, $in_lName, $in_email, $in_pass) {
	
	$query = "SELECT emailAddress FROM OfficeUser WHERE emailAddress = '$in_email'";
	$resultSet = mysqli_query($GLOBALS['conn'], $query);
	if ($row = mysqli_fetch_assoc($resultSet)) {
		echo "<script type='text/javascript'>alert('Error: An account with this email address already exists')</script>";
		return false;
	}
	else {
		$pass = md5($in_pass);
		$sql = "INSERT INTO OfficeUser(firstName, lastName, emailAddress, password) VALUES ('$in_fName', '$in_lName', '$in_email', '$pass')";
		if ($GLOBALS['conn']->query($sql) === TRUE) {
			return true;
		}
		else {
			return false;
		}
	}
}

function getAllAgents($in_search, $in_price) {
	
	$searchCriteria = "";
	$orderCriteria = "";
	if ($in_search != "") {
		$searchCriteria = " WHERE (firstName LIKE '%$in_search%' OR lastName LIKE '%$in_search%' OR phoneNumber LIKE '%$in_search%'OR emailAddress LIKE '%$in_search%')";
	}
	
	if ($in_price != "") {
		if ($in_price === "lowestPrice") {
			$orderCriteria = " ORDER BY MAX(Booking.saleAmount) DESC";
		}
		else {
			$orderCriteria = " ORDER BY MAX(Booking.saleAmount)";
		}
	}
	

	$query = "SELECT Agent.agentID, Agent.firstName, Agent.lastName, Agent.phoneNumber, Agent.emailAddress, MAX(Booking.saleAmount) AS Highest FROM Agent INNER JOIN Booking ON Booking.AgentID = Agent.AgentID GROUP BY agent.agentID" . $searchCriteria . $orderCriteria;
	
	$resultSet = mysqli_query($GLOBALS['conn'], $query);
	
	while ($row = mysqli_fetch_assoc($resultSet)) {
		echo "<a href='agent.php?id=" . $row['agentID'] . "'><div class='block'><img src='img_website/Agent/" . $row['agentID'] . ".jpg'></br><p><b>" . $row['firstName'] . " " . $row['lastName'] . ", <br>" . $row['phoneNumber'] . "<br>" . $row['emailAddress'] . "<br> R" . $row['Highest']. "</b></p></div></a>";
	}
	

}

function getAllAgentsWithoutSales($in_search) {
		$searchCriteria = "";
	$orderCriteria = "";
	if ($in_search != "") {
		$searchCriteria = " WHERE (firstName LIKE '%$in_search%' OR lastName LIKE '%$in_search%' OR phoneNumber LIKE '%$in_search%'OR emailAddress LIKE '%$in_search%')";
	}
	
	$query = "SELECT Agent.agentID, Agent.firstName, Agent.lastName, Agent.phoneNumber, Agent.emailAddress FROM AGENT" . $searchCriteria;
	
	$resultSet = mysqli_query($GLOBALS['conn'], $query);
	while ($row = mysqli_fetch_assoc($resultSet)) {
		echo "<a href='agent.php?id=" . $row['agentID'] . "'><div class='block'><img src='img_website/Agent/" . $row['agentID'] . ".jpg'></br><p><b>" . $row['firstName'] . " " . $row['lastName'] . ", <br>" . $row['phoneNumber'] . "<br>" . $row['emailAddress'] . "</b></p></div></a>";
	}
}


function showAgentPage($in_agentID) {
	
	$query = "SELECT agentID, firstName, lastName, phoneNumber, emailAddress FROM Agent WHERE agentID = '$in_agentID'";
	$resultSet = mysqli_query($GLOBALS['conn'], $query);
	
	while ($row = mysqli_fetch_assoc($resultSet)) {
		echo "<img src='img_website/Agent/" . $row['agentID'] . ".jpg' class='product_image'>";
		echo "<div class='product_block'>
				<b>" . $row['firstName'] . ", " . $row['lastName'] . "</b></div>
			<div class='product_block'>
				<b style='font-size:12pt;'>Phone Number: " . $row['phoneNumber'] . "</b></div>
			<div class='product_block'>
				<b style='font-size:12pt; '>Email Address: " . $row['emailAddress'] . "</b></div>
			<div class='product_block'>
				<b style='font-size:12pt; '>" . getAverageSellingPrice($in_agentID) . "</b></div>
			<div class='product_block'>
				<b style='font-size:12pt; '>" . getAverageSellingDate($in_agentID) . "</div>
			<div class='product_block'>
				<b style='font-size:12pt;'></b>
				</br>
				</br></br>
				<button class='invisible' type = 'submit' id = 'addToCart' name = 'id' value = " . $in_agentID . ">Purchase</button>";
	}
}

function signUpAgent($in_fName, $in_lName, $in_phoneNumber, $in_email) {
	
	$sql = "INSERT INTO AGENT (firstName, lastName, phoneNumber, emailAddress) VALUES ('$in_fName', '$in_lName', '$in_phoneNumber', '$in_email')";
	if ($GLOBALS['conn']->query($sql) === TRUE) {
		return true;
	}
	else {
		return false;
	}
}

function getNextImageId() {
	$query = "SELECT LAST_INSERT_ID()";
	if ($query = mysqli_query($GLOBALS['conn'], $query)) {
		if ($row=mysqli_fetch_row($query)) {
			return $row[0];
		}
	}	
}


function getUserID($in_email) {
	
	$query = "SELECT userID FROM OfficeUser WHERE emailAddress = '$in_email'";
	if ($query = mysqli_query($GLOBALS['conn'], $query)) {
		if ($row=mysqli_fetch_row($query)) {
			return $row[0];
		}
	}
}

function getUserName($in_userID) {
	
	$query = "SELECT firstName FROM OfficeUser WHERE userID = '$in_userID'";
	if ($query = mysqli_query($GLOBALS['conn'], $query)) {
		if ($row=mysqli_fetch_row($query)) {
			return $row[0];
		}
	}
}

function getUserEmail($in_userID) {
	
	$query = "SELECT emailAddress FROM OfficeUser WHERE userID = '$in_userID'";
	if ($query = mysqli_query($GLOBALS['conn'], $query)) {
		if ($row=mysqli_fetch_row($query)) {
			return $row[0];
		}
	}
}

function getProperties($in_search, $in_city, $in_suburb, $in_pool, $in_price, $in_minPrice, $in_maxPrice, $in_minBedrooms, $in_date) {
	
	$searchCriteria = "";
	if ($in_search != "") {
		$searchCriteria = " WHERE (p.streetAddress LIKE '%$in_search%' OR p.suburb LIKE '%$in_search%' OR p.city LIKE '%$in_search%')";
	}
	
	if ($in_city != "") {
		if ($searchCriteria == "") {
			$searchCriteria = " WHERE p.city = '$in_city'";
		}
		else {
			$searchCriteria = $searchCriteria . " AND p.city = '$in_city'";
		}
	}
	
	if ($in_suburb != "") {
		if ($searchCriteria == "") {
			$searchCriteria = " WHERE p.suburb = '$in_suburb'";
		}
		else {
			$searchCriteria = $searchCriteria . " AND p.suburb = '$in_suburb'";
		}
	}
	
	if ($in_pool != "") {
		if ($searchCriteria == "") {
			$searchCriteria = " WHERE p.pool = '$in_pool'";
		}
		else {
			$searchCriteria = $searchCriteria . " AND p.pool = '$in_pool'";
		}
	}
	
	if ($in_minPrice != "") {
		if ($searchCriteria == "") {
			$searchCriteria = " WHERE p.askingPrice >= '$in_minPrice'";
		}
		else {
			$searchCriteria = $searchCriteria . " AND p.askingPrice >= '$in_minPrice'";
		}
	}
	
	if ($in_maxPrice != "") {
		if ($searchCriteria == "") {
			$searchCriteria = " WHERE p.askingPrice <= '$in_maxPrice'";
		}
		else {
			$searchCriteria = $searchCriteria . " AND p.askingPrice <= '$in_maxPrice'";
		}
	}
	
	if ($in_date != "") {
		if ($searchCriteria == "") {
			$searchCriteria = " WHERE (b.bookingDate <> '$in_date' OR b.propertyID IS NULL)";
		}
		else {
			$searchCriteria = $searchCriteria . " AND (b.bookingDate <> '$in_date' OR b.propertyID IS NULL)";
		}
	}
	
	if ($in_minBedrooms != "") {
		if ($searchCriteria == "") {
			$searchCriteria = " WHERE p.bedrooms >= '$in_minBedrooms'";
		}
		else {
			$searchCriteria = $searchCriteria . " AND p.bedrooms >= '$in_minBedrooms'";
		}
	}
	
	if ($in_price != "") {
		if ($in_price == "lowestPrice") {
			$searchCriteria = $searchCriteria . " ORDER BY p.askingPrice";
		}
		else {
			$searchCriteria = $searchCriteria . " ORDER BY p.askingPrice DESC";
		}
	}
	
	$query = "SELECT DISTINCT p.propertyID, p.streetAddress, p.suburb, p.city, p.askingPrice FROM Property p LEFT JOIN Booking b ON p.propertyID = b.propertyID " . $searchCriteria;
	$resultSet = mysqli_query($GLOBALS['conn'], $query);
	
	while ($row = mysqli_fetch_assoc($resultSet)) {
		$property = $row['propertyID'];
		$query = "SELECT AVG(rating) FROM Rating WHERE propertyID = '$property'";
			if ($query = mysqli_query($GLOBALS['conn'], $query)) {
		if ($res=mysqli_fetch_row($query)) {
			$rating = $res[0];
		}
		if ($rating == 0) {
			$rating = "";
		}
		else {
			$rating = strval(number_format((float)$rating, 0, '.', '')) . "/10";
		}
	}	
		echo "<a href='property.php?id=" . $row['propertyID'] . "'><div class='block'><img src='img_website/" . $row['propertyID'] . ".jpg'></br><p>" . $row['streetAddress'] . ", " . $row['suburb'] . ", " . $row['city'] . "</p><p><b>R" . number_format((float)$row['askingPrice'], 2, '.', '') . "</b></p><p style='color: gold'><b>" . $rating . " </b></p></div></a>";
	}
}

function showPropertyPage($in_propertyID) {
	
	$query = "SELECT propertyID, streetAddress, suburb, city, bedrooms, pool, askingPrice, dateOnMarket, sellerID, sellerAgentID FROM PROPERTY WHERE propertyID = '$in_propertyID'";
	$resultSet = mysqli_query($GLOBALS['conn'], $query);
	
	while ($row = mysqli_fetch_assoc($resultSet)) {
		echo "<img src='img_website/" . $row['propertyID'] . ".jpg' class='product_image'>";
		echo "<div class='product_block'>
				<b>" . $row['streetAddress'] . ", " . $row['suburb'] . ", " . $row['city'] . "</b></div>
			<div class='product_block'>
				<b style='font-size:12pt; '>Cost:</b> R" . $row['askingPrice'] . "/Night</div>
			<div class='product_block'>
				<b style='font-size:12pt; '>Bedrooms:</b> " . $row['bedrooms'] . "</div>
			<div class='product_block'>
				<b style='font-size:12pt; '>Has pool:</b> " . $row['pool'] . "</div>
			<div class='product_block'>
				<b style='font-size:12pt;'>Agent Details</b>
				<p>" . getAgentDetails($row['sellerAgentID']) . "</p></br>
				</br></br>
				<button type = 'submit' id = 'addToCart' name = 'id' value = " . $in_propertyID . ">Make Booking</button>";
	}
}

function getCities() {
	
	$query = "SELECT DISTINCT city FROM Property";
	$resultSet = mysqli_query($GLOBALS['conn'], $query);
	while ($row = mysqli_fetch_assoc($resultSet)) {
		echo "<option value='" . $row['city'] . "'>" . $row['city'] . "</option>";
	}
}

function getSuburbs() {
	
	$query = "SELECT DISTINCT suburb FROM Property";
	$resultSet = mysqli_query($GLOBALS['conn'], $query);
	while ($row = mysqli_fetch_assoc($resultSet)) {
		echo "<option value='" . $row['suburb'] . "'>" . $row['suburb'] . "</option>";
	}
}

function getAgents() {
	
	$query = "SELECT agentID, firstName, lastName FROM Agent";
	$resultSet = mysqli_query($GLOBALS['conn'], $query);
	while ($row = mysqli_fetch_assoc($resultSet)) {
		echo "<option value='" . $row['agentID'] . "'>" . $row['firstName'] . " " . $row['lastName'] . "</option>";
	}
}

function getSellerDetails($in_sellerID) {
	
	$query = "SELECT firstName, lastName, phoneNumber, emailAddress FROM Seller WHERE SellerID = '$in_sellerID'";
	if ($query = mysqli_query($GLOBALS['conn'], $query)) {
		if ($row=mysqli_fetch_row($query)) {
			return "<b>Name: </b>" . $row[0] . " " . $row[1] . "</br><b>Phone Number: </b>" . $row[2] . "</br><b>Email Address: </b>" . $row[3];
		}
	}
}

function getAgentDetails($in_agentID) {
	
	$query = "SELECT firstName, lastName, phoneNumber, emailAddress FROM Agent WHERE AgentID = '$in_agentID'";
	if ($query = mysqli_query($GLOBALS['conn'], $query)) {
		if ($row=mysqli_fetch_row($query)) {
			return "<b>Name: </b>" . $row[0] . " " . $row[1] . "</br><b>Phone Number: </b>" . $row[2] . "</br><b>Email Address: </b>" . $row[3];
		}
	}
}

function addProperty($in_city, $in_suburb, $in_streetAddress, $in_askingPrice, $in_status, $in_dateOnMarket, $in_sellerID, $in_sellerAgentID) {
	
	$sql = "INSERT INTO PROPERTY(city, suburb, streetAddress, askingPrice, dateOnMarket, sellerID, sellerAgentID) VALUES('$in_city', '$in_suburb', '$in_streetAddress', '$in_askingPrice', '$in_status', '$in_dateOnMarket', '$in_sellerID', '$in_sellerAgentID')";
	
	if ($GLOBALS['conn']->query($sql) === TRUE) {
		
	}
	else {
		
	}
}

function buyerExists($in_firstName, $in_lastName, $in_phone, $in_email) {
	
	$query = "SELECT buyerID FROM Buyer WHERE firstName = '$in_firstName' AND lastName = '$in_lastName' AND phoneNumber = '$in_phone' AND emailAddress = '$in_email'";
	if ($query = mysqli_query($GLOBALS['conn'], $query)) {
		if ($row=mysqli_fetch_row($query)) {
			return true;
		}
		else {
			return false;
		}
	}
}

function insertBuyer($in_firstName, $in_lastName, $in_phone, $in_email) {
	
	$sql = "INSERT INTO Buyer(firstName, lastName, phoneNumber, emailAddress) VALUES('$in_firstName', '$in_lastName', '$in_phone', '$in_email')";
	if ($GLOBALS['conn']->query($sql) === TRUE) {
		
	}
	else {
		
	}
}

function insertRating ($in_propertyID, $in_userID, $in_rating, $in_comment) {
	$sql = "INSERT INTO RATING (propertyID, userID, rating, comment) VALUES ('$in_propertyID', '$in_userID', '$in_rating', '$in_comment')";
	echo $sql;
	if ($GLOBALS['conn']->query($sql) === TRUE) {
		header("Location: properties.php");
	}
	else {
		echo "<script type='text/javascript'>alert('Rating Unsuccessful')</script>";
	}
}

function getBuyerID($in_firstName, $in_lastName, $in_phone, $in_email) {
	
	$query = "SELECT buyerID FROM Buyer WHERE firstName = '$in_firstName' AND lastName = '$in_lastName' AND phoneNumber = '$in_phone' AND emailAddress = '$in_email'";
	if ($query = mysqli_query($GLOBALS['conn'], $query)) {
		if ($row=mysqli_fetch_row($query)) {
			return $row[0];
		}
	}
}

function getSaleStatus($in_propertyID, $in_bookingDate) {
	
	$query = "SELECT saleID FROM Booking WHERE propertyID = '$in_propertyID' AND bookingDate = '$in_bookingDate'";
	if ($query = mysqli_query($GLOBALS['conn'], $query)) {
		if ($row=mysqli_fetch_row($query)) {
			return false;
		}
		else {
			return true;
		}
	}
}

function makePurchase($in_propertyID, $in_buyerID, $in_buyerAgentID, $in_bookingDate) {
	
	$query = "SELECT askingPrice, sellerID, sellerAgentID FROM Property WHERE propertyID = '$in_propertyID'";
	$saleAmount = "";
	$sellerID = "";
	$sellerAgentID = "";
	$bookingDate = $in_bookingDate;
	
	if ($query = mysqli_query($GLOBALS['conn'], $query)) {
		if ($row=mysqli_fetch_row($query)) {
			$saleAmount = $row[0];
			$sellerID = $row[1];
			$sellerAgentID = $row[2];
		}
	}
	
	$sql1 = "INSERT INTO Booking (bookingDate, saleAmount, propertyID, buyerID, sellerID, agentID) VALUES(CAST('$bookingDate' AS DATETIME), '$saleAmount', '$in_propertyID', '$in_buyerID', '$sellerID', '$sellerAgentID')";
	
	if ($GLOBALS['conn']->query($sql1) === TRUE) {
		echo "<script type='text/javascript'>alert('Booking Successful')</script>";
		header("Location: rate.php?property=$in_propertyID&user=$in_buyerID");
	}
	else {
		echo "<script type='text/javascript'>alert('Booking Unsuccessful.')</script>";
	}
}

?>