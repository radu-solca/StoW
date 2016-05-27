<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>StoW // Stories on the Web</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,400italic,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Amatic+SC:700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" media="screen and (max-width:500px)" href="assets/css/style_mobile.css" />

	<script type="text/javascript" src="assets/js/mobile.js"></script>

	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

</head>
<body>

	<div class="splash fullWidth">
		<div class="guide960 splashImg">
			<div class="margin20">
				<div class="flex splashContent center2 column">
					<h1 class="title">Stories on the Web</h1>
					<p class="description">
						Welcome to our collection of online stories for kids of all ages, from preschoolers to highschoolers.
						Make an account to save your favorites!
					</p> 
					<div class="splashButtons flex row">
						<a href="" class="browseBtn">Browse Stories</a>
						<a href="" class="uploadBtn">Upload</a>
					</div>
				</div>
			</div>
		</div>
	</div>



	<div class="recent fullWidth">
		<div class="guide960">
			<div class="margin20">
				<div class="flex recentContent column">
					<p>Recently added...</p>
					
					<div class="marginNeg">
						<div class="flex recentData row centerV spaceBetween">

							<?php
							foreach($data['latestStories'] as $key => $story)
							{

								echo "
								<div class=\"storyThumbnail\">
									<div class=\"container\">
										<a href=\"#\">
											<div class=\"overlay\">
												<div class=\"title\">".
													$story['TITLE']."
												</div>
												<div class=\"rating\">".
													$story['RATING']."
												</div>
											</div>
											<img src=\"assets/img/dummy.jpg\">
										</a>
									</div>
								</div>
								";

								// echo $story['TITLE'];
								// echo',';
								// echo $story['COVER'];
								// echo',';
								// echo $story['RATING'];

							}
							?>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="footer fullWidth">
		<div class="guide960">
			<div class="margin20">
				<div class="footerContent">
					<p>
						<span id="copyright"></span> 
						<span>2016 StoW Team. Illustrations designed by</span>
						<a href='http://www.freepik.com/freepik-exclusive-vectors'>Freepik</a>
					</p>
				</div>
			</div>
		</div>
	</div>

	<script src="assets/js/mobile.js"></script>
	
</body>
</html>

