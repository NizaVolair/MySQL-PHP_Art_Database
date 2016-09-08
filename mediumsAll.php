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
		<title>Art Archive: Mediums - All</title>
		<link rel="stylesheet" href="style.css" type="text/css">
	</head>

	<body>
		<h1>Mediums</h1>

		<div>
			<table>
				<tr>
					<th>Medium Name</th>
					<th>Description</th>
				</tr>
				<?php
					// Prepare mediums selection statement
					if(!($stmt = $mysqli->prepare("SELECT name, description FROM mediums"))){
						echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
					}

					// Execute statement
					if(!$stmt->execute()){
						echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}

					// Bind results to table
					if(!$stmt->bind_result($name, $description)){
						echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}

					// Fetch results and print to table
					while($stmt->fetch()){
						// If description is NULL, set to placeholder
						if($description == NULL){
							$description = "--";
						}

						echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $description . "\n</td>\n</tr>";
					}

					// Close statement
					$stmt->close();
				?>
			</table>
		</div>

		<br>

		<div><a href="mediums.php">Back to Mediums Mainpage</a></div>
	</body>
</html>
