<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	<title>StoW // <?php print_r( $data['json']->story->meta->title);?>: Characters</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,400italic,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Amatic+SC:700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="<?php echo App::makeAbsolute("assets/css/style.css"); ?>">
	<link rel="stylesheet" href="<?php echo App::makeAbsolute("assets/css/iconic_fill.css"); ?>">
	<link rel="stylesheet" href="<?php echo App::makeAbsolute("assets/css/iconic_stroke.css"); ?>">
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
							<h1>
								<?php
								if($data){
									print_r($data['json']->story->meta->title);
									echo " - Characters";
								}else{
									print_r("No title");
								}
								?>

							</h1>
							
							<div id="rating"></div>

						</section>
					</div>

					<div id="storyAndProgress" class="flex column storyCharacters">
						
						<div id="bothStoryPages" class="flex column">
						
							<?php
								foreach($data['json']->story->characters as $character){
									$src = App::makeAbsolute($data['path'].'/'.$character->img);
							?>
								
									<img src="<?php echo $src; ?>"/>
									<h1><?php echo $character->name; ?></h1>
									<span><?php echo $character->description; ?></span>
									<hr>
							<?php
							}//end foreach
							?>

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

</body>
</html>
