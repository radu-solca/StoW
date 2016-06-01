<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>StoW // Login</title>
	
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

		<div class="uploadForm fullWidth flex center1 center2 first">
			<div class="guide960">
				<div class="margin20 flex center2 topBottom40">
					<div class="flex formContent center2 center1 column">
						<h1 class="title">Upload</h1>
						<p class="description">

							Select .zip file to be uploaded.
						</p> 

						<form action="upload" method="post" enctype="multipart/form-data" class="flex column center1">
							<div class="fileUpload">

								<?php
									if (!isset($_SESSION['userData']))
										echo "  <label id=\"fileToUploadLabel\" for=\"file\">
												<span>You are not logged in!</span>
												</label>";
									else
										echo "  <input type=\"file\" name=\"fileToUpload\" id=\"fileToUpload\" accept=\".zip\">
												<label id=\"fileToUploadLabel\" for=\"file\">
													Click here to select file.
												</label>";
								?>

							</div>
							<input type="submit" value="Submit" name="submit">
						</form>

					</div>
				</div>
			</div>
		</div>


		<?php 
		require "../app/views/footer.php";
		?>

	</div>


	<script src="assets/js/global.js"></script>
	<script src="assets/js/ajax.js"></script>
	<script src="assets/js/nav.js"></script>
	<script src="assets/js/upload_filename.js"></script>

	<!--
	<script type="text/javascript">
	function submitUpload(){
		var file = encodeURIComponent(document.getElementById('fileToUpload').value);
		var params = "fileToUpload="+file;
		
		//alert();
		ajaxPost(	"upload", 
			params, 
			function(responseText){
				alert(responseText);
			});

	}
	</script>
-->

</body>
</html>

