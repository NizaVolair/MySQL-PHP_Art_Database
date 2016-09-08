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
		<title>Art Archive: Exhibitions</title>
		<link rel="stylesheet" href="style.css" type="text/css">
	</head>
 	<body>
		<h1>Exhibitions</h1>

		 <!--All exhibitions-->
		<div>
			<fieldset>
				<h3>View All Exhibitions</h3>	
				<form method="post" action="exhibitionsAll.php"> 
					<fieldset>
						<legend>View All Exhibitions</legend>
						<input type="submit" name="exhibitionsAll" value="Go To Exhibitions"/>
					</fieldset>
				</form>
			</fieldset>
		</div>

		<br>

		<!--Add exhibition-->
		<div>
			<fieldset>
				<h3>Add Exhibition</h3>	
				<form method="post" action="exhibitionsAdd.php"> 
					<fieldset>
						<legend>Enter Exhibition Information</legend>
						<p>Exhibition Title: <input type="text" name="Title" required="required"/></p>
						<p>Location: <input type="text" name="Location"/></p>
						<p>Series: <select name="Series" required="required">
							<?php
								// Prepare series selection statement
								if(!($stmt = $mysqli->prepare("SELECT id, title FROM series"))){
									echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
								}

								// Execute statement
								if(!$stmt->execute()){
									echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
								}

								// Bind results to table
								if(!$stmt->bind_result($id, $stitle)){
									echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
								}

								// Fetch results and print to drop down menu
								while($stmt->fetch()){
									echo '<option value=" ' . $id . ' "> ' . $stitle . '</option>\n';
								}

								// Close statement
								$stmt->close();
							?>
						</select></p>
						<p>Year: <input type="number" name="Year"/></p>
						<input type="submit" name="exhibitionsAdd" value="Add Exhibition"/>
					</fieldset>
				</form>
			</fieldset>
		</div>

		<br>
		
		<!--Exhibitions year filter-->
		<div>
			<fieldset>
				<h3>View Exhibition By Year</h3>	
				<form method="post" action="exhibitionsYearFilter.php"> 
					<fieldset>
						<legend>Enter Year</legend>
						<p>Year: <input type="number" name="Year" required="required"/></p>
						<input type="submit" name="exhibitionsYearFilter" value="Exhibition by Year"/>
					</fieldset>
				</form>
			</fieldset>
		</div>

		<!--Artwork exhibition filter-->
		<div>
			<fieldset>
				<h3>View Artwork By Exhibition</h3>	
				<form method="post" action="exhibitionsFilter.php"> 
					<fieldset>
						<legend>Select Exhibition Title</legend>
						<p>Exhibition: <select name="Exhibition">
							<?php
								// Prepare series selection statement
								if(!($stmt = $mysqli->prepare("SELECT id, title FROM exhibitions"))){
									echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
								}

								// Execute statement
								if(!$stmt->execute()){
									echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
								}

								// Bind results to table
								if(!$stmt->bind_result($id, $stitle)){
									echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
								}

								// Fetch results and print to drop down menu
								while($stmt->fetch()){
									echo '<option value=" ' . $id . ' "> ' . $stitle . '</option>\n';
								}

								// Close statement
								$stmt->close();
							?>
						</select></p>
						<input type="submit" name="exhibitionsFilter" value="Artwork by Exhibition"/>
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

			<div><a href="series.php">Series</a></div>

			<br>

			<div><a href="artArchiveHome.html">Home</a></div>
		</div>
	</body>
</html>
