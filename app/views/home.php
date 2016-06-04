<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>StoW // Home</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,400italic,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Amatic+SC:700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="<?php echo App::makeAbsolute("assets/css/style.css"); ?>">
	<link rel="stylesheet" media="screen and (max-width:500px)" href="<?php echo App::makeAbsolute("assets/css/style_mobile.css"); ?>" />

	<link rel="shortcut icon" type="image/x-icon" href="<?php echo App::makeAbsolute("assets/img/favicon.ico"); ?>">

</head>
<body>


	<!-- MAKE PATH ABSOLUTE (LOCALHOST) 
	<?php echo App::makeAbsolute("something"); ?>
	-->


	<?php 
	require "../app/views/menu.php";
	?>

	<div class="flexWrap flex column">

		<div class="splash fullWidth flex center1 center2 first">
			<div class="guide960">
				<div class="margin20">
					<div class="flex splashContent center2 column">
						<h1 class="title">Stories on the Web</h1>
						<p class="description">
							Welcome to our collection of online stories for kids of all ages, from preschoolers to highschoolers.
							Make an account to save your favorites!
						</p> 
						<div class="splashButtons flex row">
							<a href="<?php echo App::makeAbsolute("browse"); ?>" class="browseBtn">Browse Stories</a>
							<a href="<?php echo App::makeAbsolute("upload"); ?>" class="uploadBtn">Upload</a>
						</div>
					</div>
				</div>
			</div>
		</div>



		<div class="recent fullWidth flex center1 center2">
			<div class="guide960">
				<div class="margin20">
					<div class="flex recentContent column">
						<p>Recently added...</p>

						<div class="marginNeg flex center2">
							<div id="storyView" class="flex recentData row spaceBetween center1 center2">

								<!-- <?php
								// foreach($data['latestStories'] as $key => $story)
								// {

								// 	//Story::printThumbnail($story);

								// 	// echo "<script>";

								// 	// getStoryThumbnail($story);

								// 	// "</script>";
								// }
								?>-->

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php 
		require "../app/views/footer.php";
		?>

		<script src="<?php echo App::makeAbsolute("assets/js/storyThumbnail.js"); ?>"></script>

		<script src="<?php echo App::makeAbsolute("assets/js/home.js"); ?>"></script>

		<script src="<?php echo App::makeAbsolute("assets/js/global.js"); ?>"></script>

		

		<script>

		var stories = <?php echo $data['latestStories']; ?>;

		stories.forEach(function(entry) {
		    document.getElementById("storyView").innerHTML += getStoryThumbnail(entry);
		});

		</script>

		<script>
			assignColors();
			trailingText(".storyThumbnail .title",32);
			trailingText(".storyThumbnail .authors",18);
		</script>

	</div>
	
</body>
</html>

