<?php
	// Turn on error reporting
	ini_set("display_errors", "On");
	
	// Connect to database

	
	// Handle connection error
	if($mysqli->connect_errno){
		echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
?>

<html>
	<head>
		<meta charset="UTF-8">
		<title>Art Archive: Artwork - Add</title>
		<link rel="stylesheet" href="style.css" type="text/css">
	</head>

	<body>
		<?php
			// Prepare artwork insertion statement
			if(!($stmt = $mysqli->prepare("INSERT INTO artwork(title, image, sid, width, height, year) VALUES (?, ?, ?, ?, ?, ?)"))){
				echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
			}

			// Check for image string
			if(empty($_POST["Image"])){
				$image = NULL;
			}

			// Check for series association
			$series = $_POST["SeriesBool"];

			// If false button checked, set to NULL
			if($_POST["SeriesBool"] == "false"){
				$series = NULL;
			}

			// Bind statement to form parameters
			if(!($stmt->bind_param("sssiii", $_POST["Title"], $_POST["Image"], $_POST["Series"], $_POST["Width"], $_POST["Height"], $_POST["Year"]))){
				echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
			}

			// Execute statement
			if(!$stmt->execute()){
				echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
			}

			// Print confirmation message
			else{
				echo $stmt->affected_rows . " row added to Artwork.<br/ >";
				echo "To view results, navigate back to the Artwork mainpage and select 'Go To Artwork'.<br/ >";
			}
		?>

		<div><a href="artwork.php">Back to Artwork Mainpage</a></div>
	</body>
</html>
