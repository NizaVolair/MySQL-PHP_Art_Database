<?php
	// Turn on error reporting
	ini_set("display_errors", "On");
	
	// Connect to database
	//$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "hashems-db", "b3GV9ZreuVB4DDk2", "hashems-db");
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "volairn-db", "33Zx3B8SMV4iFsYF", "volairn-db");
	
	// Handle connection error
	if($mysqli->connect_errno){
		echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
?>

<html>
	<head>
		<meta charset="UTF-8">
		<title>Art Archive: Exhibitions - Add</title>
		<link rel="stylesheet" href="style.css" type="text/css">
	</head>

	<body>
		<?php
			// Prepare exhibitions insertion statement
			if(!($stmt = $mysqli->prepare("INSERT INTO exhibitions(title, location, sid, year) VALUES (?, ?, ?, ?)"))){
				echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
			}

			// Check for description string
			if(empty($_POST["Location"])){
				$location = NULL;
			}

			// Check for year string
			if(empty($_POST["Year"])){
				$year = NULL;
			}

			// Bind statement to form parameters
			if(!($stmt->bind_param("ssii", $_POST["Title"], $_POST["Location"], $_POST["Series"], $_POST["Year"]))){
				echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
			}

			// Execute statement
			if(!$stmt->execute()){
				echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
			}

			// Print confirmation message
			else{
				echo $stmt->affected_rows . " row added to Exhibitions.<br/ >";
				echo "To view results, navigate back to the Exhibitions mainpage and select 'Go To Exhibitions'.<br/ >";
			}
		?>

		<div><a href="exhibitions.php">Back To Exhibitions Mainpage</a></div>
	</body>
</html>
