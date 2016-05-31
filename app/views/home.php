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
							<div class="flex recentData row spaceBetween center1 center2">

								<?php
								foreach($data['latestStories'] as $key => $story)
								{

									echo "
									<div class=\"storyThumbnail\">
										<div class=\"container\">
											<a href=\"#\">
												<div class=\"overlay\">
													<div class=\"title\">".$story['TITLE']."</div>
													<div class=\"authors\">".$story['AUTHORS']."</div>
													<div class=\"rating\">";
														require "../app/views/rating.php";
													echo "
													</div>
												</div>
												<img class=\"storyCover\" alt=\"story cover\" src=\"";
													$cover = isset($story['COVER']) 
													?
														file_exists ($story['COVER'])
														?
														App::makeAbsolute($story['COVER'])
														:
														App::makeAbsolute("assets/img/nocover.png")
													:
													App::makeAbsolute("assets/img/nocover.png");
													echo $cover;
												echo"\">
											</a>
										</div>
									</div>
									";
								}
								?>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php 
		require "../app/views/footer.php";
		?>

		<script src="<?php echo App::makeAbsolute("assets/js/nav.js"); ?>"></script>
		<script src="<?php echo App::makeAbsolute("assets/js/home.js"); ?>"></script>

		<script src="<?php echo App::makeAbsolute("assets/js/global.js"); ?>"></script>

		<script>
			assignColors();
			trailingText(".storyThumbnail .title",32);
			trailingText(".storyThumbnail .authors",18);
		</script>

	</div>
	
</body>
</html>

