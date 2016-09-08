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
		<title>Art Archive: Series</title>
		<link rel="stylesheet" href="style.css" type="text/css">
	</head>
 	<body>
		<h1>Series</h1>

		<!--All series-->
		<div>
			<fieldset>
				<h3>View All Series</h3>	
				<form method="post" action="seriesAll.php"> 
					<fieldset>
						<legend>View All Series</legend>
						<input type="submit" name="seriesAll" value="Go To Series"/>
					</fieldset>
				</form>
			</fieldset>
		</div>

		<br>

		<!--Add series-->
		<div>
			<fieldset>
				<h3>Add Series</h3>	
				<form method="post" action="seriesAdd.php"> 
					<fieldset>
						<legend>Enter Series Information</legend>
						<p>Series Title: <input type="text" name="Title" required="required"/></p>
						<p>Description: <input type="text" name="Description"/></p>
						<p>Artwork Title: <select name="Artwork" required="required">
							<?php
								// Prepare series selection statement
								if(!($stmt = $mysqli->prepare("SELECT id, title FROM artwork
																WHERE sid IS NULL"))){
									echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
								}

								// Execute statement
								if(!$stmt->execute()){
									echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
								}

								// Bind results to table
								if(!$stmt->bind_result($id, $title)){
									echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
								}

								// Fetch results and print to drop down menu
								while($stmt->fetch()){
									echo '<option value=" ' . $id . ' "> ' . $title . '</option>\n';
								}

								// Close statement
								$stmt->close();
							?>
						</select> Note: Add a new work of art if none are available.</p>
						<input type="submit" name="seriesAdd" value="Add Series"/>
					</fieldset>
				</form>
			</fieldset>
		</div>

		<br>
		
		<!--Artwork series filter-->
		<div>
			<fieldset>
				<h3>View Artwork By Series</h3>	
				<form method="post" action="seriesFilter.php"> 
					<fieldset>
						<legend>Select Series</legend>
						<p>Series: <select name="Series">
							<?php
								// Prepare series selection statement
								if(!($stmt = $mysqli->prepare("SELECT id, title FROM series"))){
									echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
								}

								// Execute statement
								if(!$stmt->execute()){
									echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
								}

								// Bind results to drop down menu
								if(!$stmt->bind_result($id, $title)){
									echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
								}

								// Fetch results and print to drop down menu
								while($stmt->fetch()){
									echo '<option value=" ' . $id . ' "> ' . $title . '</option>\n';
								}

								// Close statement
								$stmt->close();
							?>
						</select></p>
						<input type="submit" name="seriesFilter" value="Artwork by Series"/>
					</fieldset>
				</form>
			</fieldset>
		</div>
		
		<br>

		<!--Pager-->
		<div>	
			<div><a href="artwork.php">Artwork</a></div>

			<br>

			<div><a href="mediums.php">Mediums</a></div>

			<br>

			<div><a href="exhibitions.php">Exhibitions</a></div>

			<br>

			<div><a href="artArchiveHome.html">Home</a></div>
		</div>
	</body>
</html>
