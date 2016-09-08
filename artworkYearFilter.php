<?php
	// Turn on error reporting
	ini_set("display_errors", "On");
	
	// Connect to database

	
	// Handle connection error
	if($mysqli->connect_errno){
		echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Art Archive: Artwork - By Year</title>
		<link rel="stylesheet" href="style.css" type="text/css">
	</head>

	<body>
		<h1>Artwork by Year</h1>
		
		<div>
			<table>
				<tr>
					<th>Artwork Title</th>
					<th>Image</th>
					<th>Series</th>
					<th>Width</th>
					<th>Height</th>
					<th>Year</th>
				</tr>
				<?php
					// Prepare artwork selection statement
					if(!($stmt = $mysqli->prepare("SELECT a.title, a.image, s.title, a.width, a.height, a.year FROM artwork a 
													LEFT JOIN series s ON a.sid = s.id
													WHERE a.year = ?
													ORDER BY s.title, a.year DESC"))){
						echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
					}
					
					// Bind statement to form parameters
					if(!($stmt->bind_param("i", $_POST["Year"]))){
						echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
					}

					// Execute statement
					if(!$stmt->execute()){
						echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					
					// Bind results to table
					if(!$stmt->bind_result($title, $image, $series, $width, $height, $year)){
						echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}

					// Fetch results and print to table
					while($stmt->fetch()){
						// If a.sid is NULL, set to placeholder
						if($series == NULL){
							$series = "--";
						}

						// If a.image is NULL, set to placeholder
						if($image == NULL) {
							$image = "http://web.engr.oregonstate.edu/~volairn/images/NoImage.png";
						}				

						echo "<tr>\n<td>\n" . $title . "\n</td>\n<td>\n<img src={$image} height=100>\n</td>\n<td>\n" . $series . 
						"\n</td>\n<td>\n" . $width . "\n</td>\n<td>\n" . $height . "\n</td>\n<td>\n" . $year . "\n</td>\n</tr>";
					}

					// Close statement
					$stmt->close();
				?>
			</table>
		</div>

		<br>

		<div><a href="artwork.php">Back to Artwork Mainpage</a></div>
	</body>
</html>
