<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>StoW // Characters</title>
	
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

	<?php 
		echo '<h1>', $data['json']->story->meta->title, '</h1>';
	?>
		<ul>
	<?php
		foreach($data['json']->story->characters as $character){
			$src = App::makeAbsolute($data['path'].'/'.$character->img);
	?>
			<li>
				<img src="<?php echo $src; ?>"/>
				<span><?php echo $character->name; ?></span>
				<span><?php echo $character->description; ?></span>
			</li>
	<?php
		}//end foreach
	?>
		</ul>

	<?php 
	require "../app/views/footer.php";
	?>

	<script src="<?php echo App::makeAbsolute("assets/js/global.js"); ?>"></script>
</body>
</html>