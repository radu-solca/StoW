<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>StoW // Register</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,400italic,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Amatic+SC:700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" media="screen and (max-width:500px)" href="assets/css/style_mobile.css" />

	<script type="text/javascript" src="assets/js/mobile.js"></script>

	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
</head>
<body>

	<?php 
		require_once '../app/views/menu.php';
	 ?>

	<div class="form fullWidth">
		<div class="guide960">
			<div class="margin20">
				<div class="formContent flex">

					<form action="" class="flex column" method="post">
						<div id="username">
							Username: <input type="text" name="username">
							<p class="error" style="display:inline"></p>
						</div>
						<div id="password">
							Password: <input type="password" name="password">
							<p class="error" style="display:inline"></p>
						</div>
						<input type="button" value="submit" onclick="submitLogin()" style="width:100px">
					</form>

				</div>
			</div>
		</div>
	</div>

	<?php 
		require_once '../app/views/footer.php';
	 ?>

	<script src="assets/js/global.js"></script>
	<script src="assets/js/mobile.js"></script>
	<script src="assets/js/ajax.js"></script>

	<script type="text/javascript">
		function submitLogin(){

			var username = encodeURIComponent(document.querySelector("#username input").value),
				password = encodeURIComponent(document.querySelector("#password input").value),
				params = "username="+username+"&password="+password;

			ajaxPost(	"login", 
						params, 
						function(responseText){
							 var responseJSON = JSON.parse(responseText);
	                        if(responseJSON["ok"] == true){
	                            redirect("");
	                        }
	                        else{
	                            document.querySelector("#username .error").innerHTML = responseJSON.hasOwnProperty('username') ? responseJSON["username"][0] : "";
	                            document.querySelector("#password .error").innerHTML = responseJSON.hasOwnProperty('password') ? responseJSON["password"][0] : "";
	                        }
						});
		}
	</script>

</body>