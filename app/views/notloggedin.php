<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>StoW // Not logged in</title>
	
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

		<div class="notLogged fullWidth flex center1 center2 first">
			<div class="guide960">
				<div class="margin20 flex center2 topBottom40">
					<div class="flex formContent center2 center1 column">
						<h1 class="title">Sorry!</h1>
						<p class="description">
							You need to be signed in to access this feature.
							Please sign in or sign up below!
						</p> 
						<div class="splashButtons flex row">
							<a href="<?php echo App::makeAbsolute("login"); ?>" class="browseBtn">Sing In</a>
							<a href="<?php echo App::makeAbsolute("register"); ?>" class="uploadBtn">Sign Up</a>
						</div>
					</div>
				</div>
			</div>
		</div>


		<?php 
		require "../app/views/footer.php";
		?>

	</div>

</body>
</html>

