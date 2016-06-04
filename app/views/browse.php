<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>StoW // Browse</title>
	
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
							<div class="ageGroup">
								<p>Age group</p>
								<ul>

									<?php
									foreach($data['ageGroups'] as $ageGroup){
										echo "<li class=\"ageGroup\" onclick=\"addCategoryFilter('age_group', '". $ageGroup['CAT_NAME']."')\">". $ageGroup['CAT_NAME'] ."</li>";
									}	
									?>	

								</ul>
							</div>
						</div>

						<div class="genreContainer">
							<div class="genre">
								<p>Genre</p>
								<ul>

									<?php
									foreach($data['genres'] as $genre){
										echo "<li class=\"genre\" onclick=\"addCategoryFilter('genre', '". $genre['CAT_NAME']."')\">". $genre['CAT_NAME'] ."</li>";
									}	
									?>

								</ul>
							</div>	
						</div>

					</section>	

					<hr class="vertical">	

					<section id="filteredResults" class="right-container">	
						<p>Filtered results</p>

						<ul id="filterView" class="flex row"></ul>

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

						<!-- <div id="pageControlTop">
						</div> -->

						<div id="storyView" class="flex row spaceBetween">
						</div>

						<div id="pageControlBottom">
						</div>

					</section>	
				</div>

			</div>
		</div>


		<?php 
		require "../app/views/footer.php";
		?>	

	</div>	

	<script src="<?php echo App::makeAbsolute("assets/js/global.js"); ?>"></script>
	<script src="<?php echo App::makeAbsolute("assets/js/ajax.js"); ?>"></script>
	<script src="<?php echo App::makeAbsolute("assets/js/browse.js"); ?>"></script>
	<script src="<?php echo App::makeAbsolute("assets/js/storyThumbnail.js"); ?>"></script>
	<script type="text/javascript">
		<?php 
			if (isset($_POST['searchBarInput'])) {
				echo "searchBarInput = \"".$_POST['searchBarInput']."\";";
			}
		 ?>
		updateStories();
		updatePaginationControl();
	</script>

	<script>
		assignColors();
		trailingText(".storyThumbnail .title",32);
		trailingText(".storyThumbnail .authors",18);
	</script>

</body>
</html>