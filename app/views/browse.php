<!DOCTYPE html>
<html lang="en">

<head>
		<meta charset="UTF-8">
	<title>StoW // Browse</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,400italic,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Amatic+SC:700' rel='stylesheet' type='text/css'>

<!-- 	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" media="screen and (max-width:500px)" href="assets/css/style_mobile.css" /> -->

	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
</head>

<body>
	
	<div class="flexWrap flex">
		<?php 
			require "../app/views/menu.php";
		?>
		<div class="left-container" style="color:black;margin-top:4%">
			<div class="ageGroupContainer">
				<p>ageGroup</p>
				<?php
					foreach($data['ageGroups'] as $ageGroup){
						echo "<a class=\"ageGroup\" href=\"#\" style=\"color:black\" onclick=\"addFilter('age_group', '". $ageGroup['CAT_NAME']."')\">". $ageGroup['CAT_NAME'] ."</a></br>";
					}	
				?>	
				
			</div>
			<div class="genreContainer">
				<p>Genre</p>
				<?php
					foreach($data['genres'] as $genre){
						echo "<a class=\"genre\" href=\"#\" style=\"color:black\" onclick=\"addFilter('genre', '". $genre['CAT_NAME']."')\">". $genre['CAT_NAME'] ."</a></br>";
					}	
				?>
			</div>	

			<div id="filterView"></div>

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

		</div>
		<div class="right-container">
			
		</div>
	</div>
		

	<script src="assets/js/nav.js"></script>
	<script src="assets/js/ajax.js"></script>
	<script src="assets/js/browse.js"></script>


</body>
</html>