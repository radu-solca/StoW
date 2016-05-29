<!DOCTYPE html>
<html lang="en">

<head>
		<meta charset="UTF-8">
	<title>StoW // Browse</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,400italic,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Amatic+SC:700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" media="screen and (max-width:500px)" href="assets/css/style_mobile.css" />

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
					foreach($data['ageGroupes'] as $key => $ageGroup){
						foreach ($ageGroup as $key => $value) {
						echo "
						<a class=\"ageGroup\" href=\"#\" style=\"color:black\">". $value ."</a></br>";
						}
					}	
				?>	
				
			</div>
			<div class="genreContainer">
				<p>Genre</p>
				<?php
					foreach($data['genres'] as $key => $genre){
						foreach ($genre as $key => $value) {
						echo "
						<a class=\"genre\" href=\"#\" style=\"color:black\">". $value ."</a></br>";
						}
					}	
				?>	
			</div>	

		</div>
		<div class="right-container">
			
		</div>
	</div>
		

	<script src="assets/js/nav.js"></script>


</body>
</html>