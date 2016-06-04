<!DOCTYPE html>
<html lang="en">
<head>
<!-- 	<meta charset="UTF-8">
	<title>StoW // Register</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,400italic,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Amatic+SC:700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="<?php echo App::makeAbsolute("assets/css/style.css"); ?>">
	<link rel="stylesheet" media="screen and (max-width:500px)" href="<?php echo App::makeAbsolute("assets/css/style_mobile.css"); ?>" />

	<link rel="shortcut icon" type="image/x-icon" href="<?php echo App::makeAbsolute("assets/img/favicon.ico"); ?>">
	 -->
</head>
<body>

	<div id="leftPage">

	</div>

	<div id="rightPage">
	</div>

	<span class="clickable" id="prev">Prev</span>
	<span class="clickable" id="next">Next</span>

	<span class="clickable" id="bookmark">Bookmark here</span>


	<script src="<?php echo App::makeAbsolute("assets/js/ajax.js"); ?>"></script>
	<script src="<?php echo App::makeAbsolute("assets/js/global.js"); ?>"></script>

	<?php

		echo '<script src="../assets/js/storyRead.js"></script>'	
	   ,'<script> init(' . json_encode($data['json']) . ',' . "\"" . $data['path'] . "\"" .  ' , ' . $data['storyId'] . ' ) </script>';
 
	?>


</body>

</html>