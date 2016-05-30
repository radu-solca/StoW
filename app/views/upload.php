<!DOCTYPE html>
<html lang="en">
<head>
<!-- 	<meta charset="UTF-8">
	<title>StoW // Register</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,400italic,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Amatic+SC:700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" media="screen and (max-width:500px)" href="assets/css/style_mobile.css" />

	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico"> -->
</head>
<body style="color:black;margin-top:4%">

<?php 
	require "../app/views/menu.php";
	?>


<form action="upload" method="post" enctype="multipart/form-data">
    	Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

	<script src="assets/js/nav.js"></script>

	<script type="text/javascript">
	var form = document.getElementById('file-form');
	var fileSelect = document.getElementById('file-select');
	var uploadButton = document.getElementById('upload-button');
	var params = document.getElementById("file-select").value();
		
		var gigi = function(event) {
		  event.preventDefault();

		  ajaxPost(	"upload", 
			params, 
			function(responseText){
				//Errors handler'n shit
			});

		}
	</script>
	
</body>