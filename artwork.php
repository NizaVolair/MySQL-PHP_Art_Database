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
		<title>Art Archive: Artwork</title>
		<link rel="stylesheet" href="style.css" type="text/css">

		<!--JavaScript for disabling series drop down menu-->
		<script language="javascript">
			function DisableDropDown() {
				document.addArtwork.Series.disabled = true;
			}

			function EnableDropDown() {
				document.addArtwork.Series.disabled = false;
			}
		</script>
	</head>

 	<body>
 		<h1>Artwork</h1>

 		<!--All artwork-->
		<div>
			<fieldset>
				<h3>View All Artwork</h3>	
				<form method="post" action="artworkAll.php"> 
					<fieldset>
						<legend>View All Artwork</legend>
						<input type="submit" name="artworkAll" value="Go To Artwork"/>
					</fieldset>
				</form>
			</fieldset>
		</div>

		<br>

		<!--Artwork search bar-->
		<div>
			<fieldset>
				<h3>Search For Artwork</h3>	
				<form method="post" action="artworkSearch.php"> 
					<fieldset>
						<legend>Enter Artwork Title</legend>
						<p>Artwork Title: <input type="string" name="Title" required="required"/>
							<input type="submit" name="artworkSearch" value="Search for Artwork"/>
						</p>
					</fieldset>
				</form>
			</fieldset>
		</div>

		<br>
	
		<!--Add artwork-->
		<div>
			<fieldset>
				<h3>Add Artwork</h3>	
				<form method="post" action="artworkAdd.php" name ="addArtwork"> 
					<fieldset>
						<legend>Enter Artwork Information</legend>
						<p>Artwork Title: <input type="text" name="Title" required="required"/></p>
						<p>Image URL: <input type="url" name="Image"/></p>
						<fieldset>
							<legend>Part Of A Series</legend>
							<span>
								Yes <input type="radio" name="SeriesBool" value="true" checked="checked" onclick="EnableDropDown()"/>
								No  <input type="radio" name="SeriesBool" value="false" onclick="DisableDropDown()"/>
							</span>
							<span>Select Series: <select name="Series">
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
							</select></span>
						</fieldset>
						<p>Width: <input type="number" name="Width"/></p>
						<p>Height: <input type="number" name="Height"/></p>
						<p>Year: <input type="number" name="Year"/></p>
						<input type="submit" name="artworkAdd" value="Add Artwork"/>
					</fieldset>
				</form>
			</fieldset>
		</div>

		<br>
		
		<!--Artwork size filter-->
		<div>
			<fieldset>
				<h3>View Artwork By Size</h3>	
				<form method="post" action="artworkSizeFilter.php"> 
					<fieldset>
						<legend>Enter Largest Deminsions</legend>
						<p>Max Width: <input type="number" name="Width" required="required"/></p>
						<p>Max Height: <input type="number" name="Height" required="required"/></p>
						<input type="submit" name="artworkSizeFilter" value="Artwork by Size"/>
					</fieldset>
				</form>
			</fieldset>
		</div>
		
		<br>

		<!--Artwork year filters-->
		<div>
			<fieldset>
				<h3>View Artwork By Year</h3>	
				<form method="post" action="artworkYearFilter.php"> 
					<fieldset>
						<legend>Enter Year</legend>
						<p>Year: <input type="number" name="Year" required="required"/></p>
						<input type="submit" name="artworkYearFilter" value="Artwork by Year"/>
					</fieldset>
				</form>
				<br>
				<form method="post" action="artworkLatestFilter.php">
					<fieldset>
						<legend>View Latest Artwork</legend>
						<input type="submit" name="artworkLatestFilter" value="Latest Artwork"/>
					</fieldset>
				</form>
				<br>
				<form method="post" action="artworkEarliestFilter.php">
					<fieldset>
						<legend>View Earliest Artwork</legend>
						<input type="submit" name="artworkEarliestFilter" value="Earliest Artwork"/>
					</fieldset>
				</form>
			</fieldset>
		</div>
		
		<br>

		<!--Artwork non series filter-->
		<div>
			<fieldset>
				<h3>View Artwork Not In A Series</h3>	
				<form method="post" action="artworkNonSeriesFilter.php"> 
					<fieldset>
						<legend>View Artwork Not In A Series</legend>
						<input type="submit" name="artworkNonSeriesFilter" value="Artwork Not In a Series"/>
					</fieldset>
				</form>
			</fieldset>
		</div>

		<br>

		<!--Artwork non image filter-->
		<div>
			<fieldset>
				<h3>View Artwork Without Images</h3>	
				<form method="post" action="artworkNonImageFilter.php"> 
					<fieldset>
						<legend>View Artwork Without Images</legend>
						<input type="submit" name="artworkNonImageFilter" value="Artwork Without Images"/>
					</fieldset>
				</form>
			</fieldset>
		</div>

		<br>

		<!--Pager-->
		<div>	
			<div><a href="mediums.php">Mediums</a></div>

			<br>

			<div><a href="series.php">Series</a></div>

			<br>

			<div><a href="exhibitions.php">Exhibitions</a></div>

			<br>

			<div><a href="artArchiveHome.html">Home</a></div>
		</div>
 	</body>
</html>
