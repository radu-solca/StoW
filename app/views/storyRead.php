<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	<?php $json=json_decode($data['json']); ?>
	<title>StoW // <?php print_r( $json->story->meta->title);?></title>
	
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
							<h1>
								<?php
									print_r( $json->story->meta->title);
								?>
							</h1>
							<p>
								<?php
								
								$authors = $json->story->meta->authors;
								echo implode($authors, ', ');
									
								?>
							</p>
							<div id="rating"></div>
						</section>

						<hr class="vertical">

						<section id="right" class="flex column">
						
							<a href="#pageControlBottom" class="iconic comment_alt2_stroke clickable">
								<!-- duce la commenturi da oleaca mai sus -->
								<div class="tooltip">comment</div>
							</a>
							<a class="iconic heart_stroke clickable" onclick="addToFavourites()">
								<div class="tooltip">favorite</div>
							</a>	
							</a>
							<a id="bookmark" class="iconic book_alt2 clickable">
								<div class="tooltip">bookmark</div>
							</a>

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

						<div id="pageControlBottom" class="flex row center2">
						</div>

					</div>
					
					<div id="commentContainer" class="flex column formContent">
						<form onsubmit="return false;">
							<textarea placeholder="Write your thoughts on this story..." id="comment" name="comment" onkeyup="validateComment(this)"></textarea>
							<p class="error"></p>
							<input type="submit" value="submit" onclick="submitComment()">
						</form>
						
						<ul id="commentSection" class="flex column">
						</ul>
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
	<script src="<?php echo App::makeAbsolute("assets/js/storyThumbnail.js"); ?>"></script>
	<script>
		assignColors("storyByIdContent");
	</script>
	<?php
	$bookmarkPage = isset($data['bookmarkedPage']) ? $data['bookmarkedPage'] : 0;
	echo '<script src="../assets/js/storyRead.js"></script>'	
	,'<script> init(' . json_encode($data['json']) . ',' . "\"" . $data['path'] . "\"" .  ' , ' . $data['storyId'] . ' , '. $bookmarkPage  .','.$data['isFavourite'].' ) </script>';

	?>
	<script type="text/javascript">document.getElementById('rating').innerHTML = getRatingStars(<?php echo $data['rating'] ?>, true);</script>

</body>
</html>