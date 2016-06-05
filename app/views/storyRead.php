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
				<div id="story" class="margin20 storyByIdContent flex center1 center2 column topBottom40">

					<div id="storyDetails" class="flex row overlay">
						<section id="left">
							<h1>Ayylmao story title</h1>
							<p>Author Lalala</p>
							<p>[rating...]</p>
						</section>

						<hr class="vertical">

						<section id="right" class="flex column">
							<a href="" class="iconic comment_alt2_stroke"></a>
							<a href="" class="iconic heart_stroke"></a>
						</section>
					</div>

					<div id="storyAndProgress" class="flex column">
						
						<div id="bothStoryPages" class="flex row">
							<div id="leftPage" class="flex column spaceBetween">
							</div>

							<hr class="vertical" class="flex column spaceBetween">

							<div id="rightPage">
							</div>
						</div>

						

						<div class="flex row">
							<span class="clickable" id="prev">Prev</span>
							<span class="clickable" id="next">Next</span>
							<span class="clickable" id="bookmark">Bookmark</span>
						</div>

					</div>

				</div>


			</div>
		</div>


		<?php 
		require "../app/views/footer.php";
		?>

	</div>

	<script src="<?php echo App::makeAbsolute("assets/js/ajax.js"); ?>"></script>
	<script src="<?php echo App::makeAbsolute("assets/js/global.js"); ?>"></script>
	<script>
		assignColors("storyByIdContent");
	</script>
	<?php
	$bookmarkPage = isset($data['bookmarkedPage']) ? $data['bookmarkedPage'] : 0;
	echo '<script src="../assets/js/storyRead.js"></script>'	
	,'<script> init(' . json_encode($data['json']) . ',' . "\"" . $data['path'] . "\"" .  ' , ' . $data['storyId'] . ' , '. $bookmarkPage  .' ) </script>';

	?>

</body>
</html>