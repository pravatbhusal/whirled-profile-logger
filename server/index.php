<html>
<body>
<header>
	<title>Profile Tracker</title>
	<!--style.css, favcon, googlefont, materializecss-->  
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">  	
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
	
	<!--jquery, materializejs-->
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
<header>
<main>	
	<div class="container">
		<h4 style="text-align: center">Profile Tracker: Whirled Servers</h4>
		<p style="text-align: center; color: red;">
			DISCLAIMER: IP ADDRESSES ARE "PUBLIC" AND THE INFORMATION PROVIDED BY THE
			ADDRESS IS FOR FREE-USE UNDER AN ISP. THIS WEBSITE HOLDS NO LIABILITIES TO
			THE IP ADDRESSES, AND THIS SHOULD ONLY BE USED FOR EDUCATIONAL
			OR SECURITY PURPOSES.
		</p>
		<p style="text-align: center">If you wish to implement the profile tracker code into 
		your avatar, then follow the instructions in this GitHub repository:
		<a target="blank" href="https://github.com/Shadowsych/whirled-tracker">https://github.com/Shadowsych/whirled-tracker</a>
		</p>
		
		<form method="GET">
			<input required style="width: 250px;" placeholder="Search by Profile ID #" name="profileid" type="text" class="browser-default" min="0" onkeypress="return isNumberKey(event)">
			<button type="submit" class="waves-effect waves-light btn">Search</button>
		</form>
		<br>
		<form method="GET">
			<input required style="width: 250px;" placeholder="Search by Profile Name" name="profilename" type="text" class="browser-default">
			<button type="submit" class="waves-effect waves-light btn">Search</button>
		</form>
		<br>
		<form method="GET">
			<input required style="width: 250px;" placeholder="Search by IP Address" name="ipaddress" type="text" class="browser-default">
			<button type="submit" class="waves-effect waves-light btn">Search</button>
		</form>
		
		<hr>
		<?php
		include_once("dbconnection.php");
		//check if page variable is set
		if(isset($_GET['page'])) {
			if($_GET['page'] > 0) {
				$pageIndex = $_GET['page'] - 1;
			} else {
				$pageIndex = 0;	
			}
		} else {
				$pageIndex = 0;
		}
		
		//check if there a search variable was set
		if(isset($_GET['profileid']) || isset($_GET['profilename']) || isset($_GET['ipaddress'])) {
			echo '
			<h4 style="text-align: center">Search Results</h4>
			<p style="text-align: center"><a href="?page=1">Click here to go back to the main page</a></p>
			';
		}
		
		echo '
			<table>
				<tr>
					<th>Profile</th>
					<th>Username</th> 
					<th>IP Address</th>
					<th>City</th>
					<th>State</th>
					<th>Country</th>
					<th>Zip Code</th>
					<th>Time Zone</th>
					<th>Latitude</th>
					<th>Longitude</th>
					<th>ISP</th>
				</tr>
		';
		
		//check if there a search variable was set
		if(isset($_GET['profileid']) || isset($_GET['profilename']) || isset($_GET['ipaddress'])) {
			if(isset($_GET['profileid'])) {
				$profileId = $_GET['profileid'];
				$query = "SELECT * FROM player WHERE playerid='$profileId'";
			} else if(isset($_GET['profilename'])) {
				$profileName = $_GET['profilename'];
				$query = "SELECT * FROM player WHERE playername LIKE '%" . $profileName . "%'";
			} else if(isset($_GET['ipaddress'])) {
				$ipaddress = $_GET['ipaddress'];
				$query = "SELECT * FROM player WHERE ipaddress='$ipaddress'";
			}
			$result = mysqli_query($link, $query);
			while($row = mysqli_fetch_array($result)) {
				$playerURL = $row['playerurl'];
				$playerName = $row['playername'];
				$ipaddress = $row['ipaddress'];
				$city = $row['city'];
				$state = $row['state'];
				$country = $row['country'];
				$zipcode = $row['zipcode'];
				$timezone = $row['timezone'];
				$latitude = $row['latitude'];
				$longitude = $row['longitude'];
				$isp = $row['isp'];
				echo '
					<tr>
					<td><a target="_blank" href="http://'.$playerURL.'">'.$playerURL.'</a></td>
					<td>'.$playerName.'</td> 
					<td>'.$ipaddress.'</td>
					<td>'.$city.'</td>
					<td>'.$state.'</td>
					<td>'.$country.'</td>
					<td>'.$zipcode.'</td>
					<td>'.$timezone.'</td>
					<td>'.$latitude.'</td>
					<td>'.$longitude.'</td>
					<td>'.$isp.'</td>
					</tr>
				';
			}
			echo '
			</table>
			';
		} else { //else, get the regular columns and rows with no search
			//add 15 rows for the players per page
			$viewItems = ($pageIndex * 15) . "," . ($pageIndex + 15);
			$query = "SELECT * FROM player ORDER by id DESC LIMIT " . $viewItems;
			$result = mysqli_query($link, $query);
			while($row = mysqli_fetch_array($result)) {
				$playerURL = $row['playerurl'];
				$playerName = $row['playername'];
				$ipaddress = $row['ipaddress'];
				$city = $row['city'];
				$state = $row['state'];
				$country = $row['country'];
				$zipcode = $row['zipcode'];
				$timezone = $row['timezone'];
				$latitude = $row['latitude'];
				$longitude = $row['longitude'];
				$isp = $row['isp'];
				echo '
					<tr>
					<td><a target="_blank" href="http://'.$playerURL.'">'.$playerURL.'</a></td>
					<td>'.$playerName.'</td> 
					<td>'.$ipaddress.'</td>
					<td>'.$city.'</td>
					<td>'.$state.'</td>
					<td>'.$country.'</td>
					<td>'.$zipcode.'</td>
					<td>'.$timezone.'</td>
					<td>'.$latitude.'</td>
					<td>'.$longitude.'</td>
					<td>'.$isp.'</td>
					</tr>
				';
			}
			echo '
			</table>
			<ul class="pagination" align="center">
				<li id="previousPage"><a id="previousPageHref" href="?page='.($pageIndex).'"><i class="material-icons">chevron_left</i></a></li>
				<li id="currentPage" value="'.($pageIndex + 1).'">'.($pageIndex + 1).'</li>
				<li id="nextPage" class="waves-effect"><a href="?page='.($pageIndex + 2).'"><i class="material-icons">chevron_right</i></a></li>
			</ul>
			';
		}
		?>
	</div>
</main>
	<script>
		//if we're on the first page or less, then add certain classes for the previous button
		if(document.getElementById("currentPage").value <= 1) {
			document.getElementById("previousPage").className += "disabled";
			document.getElementById("previousPageHref").removeAttribute("href");
		} else {
			document.getElementById("previousPage").className += "waves-effect";
		}
		
		//check if is number
		function isNumberKey(evt)
		{
			var charCode = (evt.which) ? evt.which : evt.keyCode;
			if (charCode != 46 && charCode > 31 
			&& (charCode < 48 || charCode > 57))
			 return false;
			return true;
		}
	</script>
</body>
</html>
