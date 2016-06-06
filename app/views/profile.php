<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>StoW // Profile</title>
	
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

		<div class="profile fullWidth flex center1 center2 first">
			<div class="guide960">
				<div class="margin20 flex center1 center2 column topBottom40">

					<div class="flex formContent column">

						<div id="firstHalf" class="flex row">
							<section>			
								<h1 class="title">Account</h1>

								<form action="" class="flex column center1 sectionContent" method="post">
									<div id="username">
										<span>Username</span>
										<?php 
											echo "<span class=\"viewOnly\">".$_SESSION["userData"]['USERNAME']."</span>";
		 								?>
									</div>
									<div id="email">
										<span>Email</span>
										<?php 
											echo "<span class=\"viewOnly\">".$_SESSION["userData"]['EMAIL']."</span>";
		 								?>
									</div>
									<div id="name">
										<span>Name</span>
										<?php 
											echo "<span class=\"viewOnly\">".$_SESSION["userData"]['NAME']."</span>";
		 								?>
									</div>
									<div id="surname">
										<span>Surname</span>
										<?php 
											echo "<span class=\"viewOnly\">".$_SESSION["userData"]['SURNAME']."</span>";
		 								?>
								</form>
							</section>	

							<hr class="vertical">	

							<section>	
								<h1 class="title">Bookmarks</h1>

								<form action="" class="flex column center1" method="post">
									<?php
										if($data['bookmarks']){

											foreach ($data['bookmarks'] as $key => $value) {
												echo  '<a href="storyRead/'.$value['storyId'].'">'.$value['storyTitle'].'-> bookmark at page '.$value['bookmarkId'].'</a>'; 
											}
										}
									?>
								</form>
							</section>	
						</div>

						<hr>

						<div id="secondHalf" class="flex row">
							<section>
							<h1 class="title">Favorites</h1>

							<form action="" class="flex column center1" method="post">
								<?php
									if($data['favourites']){
										foreach ($data['favourites'] as $key => $value) {
											echo '<a href="storyRead/'.$value['storyId'].'">'.$value['storyTitle'].'</a>';
										}
								}
								?>
							</form>
							</section>

							<hr class="vertical">	
						
							<section>
							<h1 class="title">Ratings</h1>

							<form action="" class="flex column center1" method="post">
								<?php
										if($data['ratings']){

											foreach ($data['ratings'] as $key => $value) {
												echo  '<a href="storyRead/'.$value['storyId'].'">'.$value['storyTitle'].'->'.$value['ratingValue'].' stars </a>'; 
											}
									}
								?>
							</form>
							</section>

							<hr class="vertical">	

						</div>

					</div>

				</div>
			</div>
		</div>


		<?php 
		require "../app/views/footer.php";
		?>

	</div>


	<script src="<?php echo App::makeAbsolute("assets/js/global.js"); ?>"></script>
	<script src="<?php echo App::makeAbsolute("assets/js/profile.js"); ?>"></script>
	<script src="<?php echo App::makeAbsolute("assets/js/storyThumbnail.js"); ?>"></script>


</body>
</html>