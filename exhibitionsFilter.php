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

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Art Archive: Exhibitions - By Exhibition</title>
		<link rel="stylesheet" href="style.css" type="text/css">
	</head>

	<body>
		<h1>Artwork by Exhibition</h1>

		<div>
			<table>
				<tr>
					<th>Artwork Title</th>
					<th>Image</th>
					<th>Series</th>
					<th>Exhibition</th>
					<th>Location</th>
					<th>Year of Exhibition</th>
				</tr>
				<?php
					// Prepare artwork selection statement
					if(!($stmt = $mysqli->prepare("SELECT a.title, a.image, s.title, e.title, e.location, e.year FROM artwork a
													INNER JOIN series s ON a.sid = s.id
													INNER JOIN exhibitions e ON e.sid = s.id
													WHERE e.id = ?
													ORDER BY a.title ASC"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}
					
					// Bind statement to form parameters
					if(!($stmt->bind_param("i", $_POST["Exhibition"]))){
						echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
					}

					// Execute statement
					if(!$stmt->execute()){
						echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}

					// Bind results to table
					if(!$stmt->bind_result($title, $image, $series, $exhibition, $location, $year)){
						echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}

					// Fetch results and print to table
					while($stmt->fetch()){
						// If a.image is NULL, set to placeholder
						if($image == NULL) {
							$image = "http://web.engr.oregonstate.edu/~volairn/images/NoImage.png";
						}

						// If e.location is NULL, set to placeholder
						if($location == NULL){
							$location = "--";
						}

						echo "<tr>\n<td>\n" . $title . "\n</td>\n<td>\n <img src={$image} height=100> \n</td>\n<td>\n" . $series . 
						"\n</td>\n<td>\n" . $exhibition . "\n</td>\n<td>\n" . $location . "\n</td>\n<td>\n" . $year . 
						"\n</td>\n</tr>";
					}
					
					// Close statement
					$stmt->close();
				?>
			</table>
		</div>

		<br>

		<div><a href="exhibitions.php">Back to Exhibitions Mainpage</a></div>
	</body>
</html>
