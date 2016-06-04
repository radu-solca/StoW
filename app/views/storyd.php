<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>StoW // <?php echo "Dynamic page title pls" ?></title>
	
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

		<div class="storyById fullWidth flex center1 center2 first">
			<div class="guide960">
				<div id="story" class="margin20 storyByIdContent presetColorGreen flex center1 center2 column topBottom40">

					<div id="storyDetails" class="flex row overlay">
						<section id="left">
							<h1>Ayylmao story title</h1>
							<p>Author Lalala</p>
							<p>[rating...]</p>
						</section>

						<hr class="vertical">

						<section id="right">ayy dreapta</section>
					</div>

					<div id="storyAndProgress" class="flex row">
						AYYLMAO I AM GONNA HAB DETAILS
					</div>

				</div>


			</div>
		</div>


		<?php 
		require "../app/views/footer.php";
		?>

	</div>


	<script src="<?php echo App::makeAbsolute("assets/js/global.js"); ?>"></script>

</body>
</html>