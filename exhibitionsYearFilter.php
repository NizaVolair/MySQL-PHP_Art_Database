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
		<title>Art Archive: Exhibitions - By Year</title>
		<link rel="stylesheet" href="style.css" type="text/css">
	</head>

	<body>
		<h1>Exhibitions by Year</h1>
		
		<div>
			<table>
				<tr>
					<th>Exhibition Title</th>
					<th>Location</th>
					<th>Featured Series</th>
					<th>Year</th>
				</tr>
				<?php
					// Prepare exhibitions selection statement
					if(!($stmt = $mysqli->prepare("SELECT e.title, e.location, s.title, e.year FROM exhibitions e
													INNER JOIN series s ON e.sid = s.id
													WHERE e.year = ?
													ORDER BY e.title ASC"))){
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
					if(!$stmt->bind_result($title, $location, $series, $year)){
						echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}

					// Fetch results and print to table
					while($stmt->fetch()){
						// If e.location is NULL, set to placeholder
						if($location == NULL){
							$location = "--";
						}
						
						echo "<tr>\n<td>\n" . $title . "\n</td>\n<td>\n" . $location . "\n</td>\n<td>\n" . $series . 
						"\n</td>\n<td>\n" . $year . "\n</td>\n</tr>";
					}

					// Close statement
					$stmt->close();
				?>
			</table>
		</div>

		<br>

		<div><a href="exhibitions.php">Back To Exhibitions Mainpage</a></div>
	</body>
</html>
