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
		<title>Art Archive: Mediums - Artwork Composition</title>
		<link rel="stylesheet" href="style.css" type="text/css">
	</head>

	<body>
		<h1>Artwork Composition</h1>

		<div>
			<table>
				<tr>
					<th>Artwork Title</th>
					<th>Image</th>
					<th>Mediums</th>
				</tr>
					<?php
						// Prepare artwork selection statement
						if(!($stmt = $mysqli->prepare("SELECT a.title, a.image, m.name FROM artwork a
														INNER JOIN composed_of c ON a.id = c.aid
														INNER JOIN mediums m ON m.id = c.mid
														ORDER BY a.title"))){
							echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
						}
						
						// Execute statement
						if(!$stmt->execute()){
							echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}

						// Bind results to table
						if(!$stmt->bind_result($title, $image, $name)){
							echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}

						// Fetch results and print to table
						while($stmt->fetch()){
							if($image == NULL) {
								$image = "http://web.engr.oregonstate.edu/~volairn/images/NoImage.png";
							}
							echo "<tr>\n<td>\n" . $title . "\n</td>\n<td>\n<img src={$image} height=100>\n</td>\n<td>\n" . 
							$name ."\n</td>\n</tr>";
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
