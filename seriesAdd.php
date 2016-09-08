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
		<title>Art Archive: Series - Add</title>
		<link rel="stylesheet" href="style.css" type="text/css">
	</head>

	<body>
		<?php
			// Series section
			// Prepare series insertion statement
			if(!($seriesStmt = $mysqli->prepare("INSERT INTO series(title, description) VALUES (?, ?)"))){
				echo "Prepare failed: " . $seriesStmt->errno . " " . $seriesStmt->error;
			}

			// Check for description string
			if(empty($_POST["Description"])){
				$description = NULL;
			}

			// Store series title in variable
			$seriesTitle = $_POST["Title"];

			// Bind statement to form parameters
			if(!($seriesStmt->bind_param("ss", $_POST["Title"], $_POST["Description"]))){
				echo "Bind failed: " . $seriesStmt->errno . " " . $seriesStmt->error;
			}

			// Execute statement
			if(!$seriesStmt->execute()){
				echo "Execute failed: " . $seriesStmt->errno . " " . $seriesStmt->error;
			}

			// Print confirmation message
			else{
				echo $seriesStmt->affected_rows . " row added to Series.<br/ >";
			}

			// Artwork section
			// Prepare artwork insertion statement
			if(!($artStmt = $mysqli->prepare("UPDATE artwork SET sid = 
											(SELECT id FROM series 
												WHERE title = '$seriesTitle')
											WHERE id = ?"))){
				echo "Prepare failed: " . $artStmt->errno . " " . $artStmt->error;
			}

			// Bind statement to form parameters
			if(!($artStmt->bind_param("i", $_POST["Artwork"]))){
				echo "Bind failed: " . $artStmt->errno . " " . $artStmt->error;
			}

			// Execute statement
			if(!$artStmt->execute()){
				echo "Execute failed: " . $artStmt->errno . " " . $artStmt->error;
			}

			// Print confirmation message
			else{
				echo $artStmt->affected_rows . " row updated in Artwork.<br/ >";
				echo "To view results, navigate back to the Series mainpage and select 'Go To Series' or 'Artwork by Series'.<br/ >";
			}
		?>

		<div><a href="series.php">Back To Series Mainpage</a></div>
	</body>
</html>
