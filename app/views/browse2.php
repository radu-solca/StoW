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

						<section id="filterPanel">
							<p>Filter stories</p>

							<div class="ageGroup">
								<p>Age group</p>
								<ul>
									<!-- DUMMIES, TREBUIE DIN BAZA DE DATE-->
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
									<!-- DUMMIES, TREBUIE DIN BAZA DE DATE-->
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
							</div>

						</section>	

						<hr class="vertical">	

						<section id="filteredResults">	
							<p>Filtered results</p>

							
						</section>	
					</div>

			</div>
		</div>


		<?php 
		require "../app/views/footer.php";
		?>	

	</div>	



	<script src="assets/js/nav.js"></script>


</body>
</html>