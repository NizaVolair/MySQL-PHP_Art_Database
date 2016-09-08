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
		<title>Art Archive: Mediums</title>
		<link rel="stylesheet" href="style.css" type="text/css">
	</head>

 	<body>
 		<h1>Mediums</h1>

 		<!--All mediums-->
		<div>
			<fieldset>
				<h3>View All Mediums</h3>	
				<form method="post" action="mediumsAll.php"> 
					<fieldset>
						<legend>View All Mediums</legend>
						<input type="submit" name="mediumsAll" value="Go To Mediums"/>
					</fieldset>
				</form>
			</fieldset>
		</div>

		<br>

		<!--Add mediums-->
		<div>
			<fieldset>
				<h3>Add Mediums</h3>	
				<form method="post" action="mediumsAdd.php"> 
					<fieldset>
						<legend>Enter Medium Information</legend>
						<p>Medium Name: <input type="text" name="Name" required="required"/></p>
						<p>Description: <input type="text" name="Description"/></p>
						<input type="submit" name="mediumsAdd" value="Add Medium"/>
					</fieldset>
				</form>
			</fieldset>
		</div>

		<br>
		
		<!--Artwork-Mediums association-->
		<div>
			<fieldset>
				<h3>View Artwork Composition</h3>	
				<form method="post" action="mediumsComposition.php"> 
					<fieldset>
						<legend>View Artwork Composition</legend>
						<input type="submit" name="mediumsComposition" value="View Artwork Composition"/>
					</fieldset>
				</form>
			</fieldset>
		</div>

		<br>

		<!--Artwork medium filter-->
		<div>
			<fieldset>
				<h3>View Artwork By Medium</h3>	
				<form method="post" action="mediumsFilter.php"> 
					<fieldset>
						<legend>Select Medium</legend>
						<p>Medium: <select name="Medium">
							<?php
								// Prepare mediums selection statement
								if(!($stmt = $mysqli->prepare("SELECT id, name FROM mediums"))){
									echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
								}

								// Execute statement
								if(!$stmt->execute()){
									echo "Execute failed: ". $mysqli->connect_errno . " " . $mysqli->connect_error;
								}

								// Bind results to drop down menu
								if(!$stmt->bind_result($id, $name)){
									echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
								}

								// Fetch results and print to drop down menu
								while($stmt->fetch()){
									echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
								}

								// Close statement
								$stmt->close();
							?>
						</select></p>
						<input type="submit" name="mediumsFilter" value="Artwork by Medium" />
					</fieldset>
				</form>	
			</fieldset>
		</div>

		<!--Add artwork-medium association-->
		<div>
			<fieldset>
				<h3>Associate Artwork To Medium</h3>	
				<form method="post" action="mediumsArtworkAssociate.php"> 
					<fieldset>
						<legend>Select Artwork and Medium Information</legend>
						<p>Artwork: <select name="Artwork">
							<?php
								// Prepare artwork selection statement
								if(!($stmt = $mysqli->prepare("SELECT id, title FROM artwork"))){
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
									echo '<option value=" '. $id . ' "> ' . $title . '</option>\n';
								}

								// Close statement
								$stmt->close();
							?>
						</select></p>
						<p>Medium: <select name="Medium">
							<?php
								// Prepare mediums selection statement
								if(!($stmt = $mysqli->prepare("SELECT id, name FROM mediums"))){
									echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
								}

								// Execute statement
								if(!$stmt->execute()){
									echo "Execute failed: ". $mysqli->connect_errno . " " . $mysqli->connect_error;
								}

								// Bind results to drop down menu
								if(!$stmt->bind_result($id, $name)){
									echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
								}

								// Fetch results and print to drop down menu
								while($stmt->fetch()){
									echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
								}

								// Close statement
								$stmt->close();
							?>
						</select></p>
						<input type="submit" name="mediumsArtworkAssociate" value="Associate Artwork to Medium"/>
					</fieldset>
				</form>
			</fieldset>
		</div>
	
		<br>	

		<!--Pager-->
		<div>	
			<div><a href="artwork.php">Artwork</a></div>

			<br>

			<div><a href="series.php">Series</a></div>

			<br>

			<div><a href="exhibitions.php">Exhibitions</a></div>

			<br>

			<div><a href="artArchiveHome.html">Home</a></div>
		</div>
 	</body>
</html>
