<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>StoW // Browse 2</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,400italic,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Amatic+SC:700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="<?php echo App::makeAbsolute("assets/css/style.css"); ?>">
	<link rel="stylesheet" media="screen and (max-width:500px)" href="<?php echo App::makeAbsolute("assets/css/style_mobile.css"); ?>" />

	<link rel="shortcut icon" type="image/x-icon" href="<?php echo App::makeAbsolute("assets/img/favicon.ico"); ?>">
	
</head>

<body>

	<?php 
	require "../app/views/menu.php";
	?>
	
	<div class="flexWrap flex column">

		<div class="browse fullWidth flex center1 center2 first">
			<div class="guide960">
				<div class="browseContent margin20 flex flexStart center2 row topBottom40">

					<section id="filterPanel" class="left-container">
							 <p>Filter stories</p>

							<div class="ageGroupContainer">
								<p>ageGroup</p>
								<?php
								foreach($data['ageGroups'] as $ageGroup){
									echo "<a class=\"ageGroup\" href=\"#\" style=\"color:black\" onclick=\"addCategoryFilter('age_group', '". $ageGroup['CAT_NAME']."')\">". $ageGroup['CAT_NAME'] ."</a></br>";
								}	
								?>	

							</div>
							<div class="genreContainer">
								<p>Genre</p>
								<?php
								foreach($data['genres'] as $genre){
									echo "<a class=\"genre\" href=\"#\" style=\"color:black\" onclick=\"addCategoryFilter('genre', '". $genre['CAT_NAME']."')\">". $genre['CAT_NAME'] ."</a></br>";
								}	
								?>
							</div>	


						</section>	

						<hr class="vertical">	

						<section id="filteredResults" class="right-container">	
							<p>Filtered results</p>

							<div id="filterView"></div>

							<div id="order">
								<select onchange="updateOrdBy(this)">
									<option value="RATING">Rating</option>
									<option value="DATE_ADDED">Date added</option>
									<option value="TITLE">Alphabetic</option>
								</select> 
								<select onchange="updateOrdType(this)">
									<option value="ASC">Ascending</option>
									<option value="DESC">Descending</option>
								</select>
							</div>

							<div id="storyView">
							</div>
							
						</section>	
					</div>

				</div>
			</div>


			<?php 
			require "../app/views/footer.php";
			?>	

		</div>	

		<script src="<?php echo App::makeAbsolute("assets/js/ajax.js"); ?>"></script>
		<script src="<?php echo App::makeAbsolute("assets/js/browse.js"); ?>"></script>

	</body>
	</html>