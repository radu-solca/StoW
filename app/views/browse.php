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

							<!--
							<div class="ageGroup">
								<p>Age group</p>
								<ul>
									<li>0-3</li>
									<li>3-5</li>
									<li>5-7</li>
									<li>7-12</li>
									<li>12-15</li>
									<li>15-18</li>
									<li>18+</li>
								</ul>
							</div>

							<div class="genre">
								<p>Genre</p>
								<ul>
									<li>drama</li>
									<li>classic</li>
									<li>comic</li>
									<li>crime</li>
									<li>fable</li>
									<li>fairy tale</li>
									<li>biography</li>
									<li>autobiography</li>
									<li>memoir</li>
									<li>fantasy</li>
									<li>folklore</li>
									<li>historical</li>
									<li>poetry</li>
									<li>horror</li>
									<li>legend</li>
									<li>mystery</li>
									<li>mythology</li>
								</ul>
							</div> -->

							<div class="ageGroupContainer">
								<div class="ageGroup">
									<p>Age group</p>
									<ul>

										<?php
										foreach($data['ageGroups'] as $ageGroup){
											echo "<li class=\"ageGroup\" onclick=\"addFilter('age_group', '". $ageGroup['CAT_NAME']."')\">". $ageGroup['CAT_NAME'] ."</li>";
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
											echo "<li class=\"genre\" onclick=\"addFilter('genre', '". $genre['CAT_NAME']."')\">". $genre['CAT_NAME'] ."</li>";
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

							<div id="storyView">
								<?php
								foreach($data['stories'] as $key => $story)
								{
									echo "<br>
									<div class=\"title\">".$story['TITLE']."</div>
									<div class=\"authors\">".$story['AUTHORS']."</div>
									<br>";
								}
								?>
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