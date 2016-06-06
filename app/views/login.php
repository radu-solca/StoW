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

		<div class="login fullWidth flex center1 center2 first">
			<div class="guide960">
				<div class="margin20 flex center2 topBottom40">
					<div class="flex formContent center2 center1 column">
						<h1 class="title">Sign In</h1>
						<p class="description">
							Welcome back! :)
						</p> 

						<form onsubmit="return false;" action="" class="flex column center1" method="post">
							<div id="username">
								<span>Username</span>
								<input type="text" name="username">
								<p class="error"></p>
							</div>
							<div id="password">
								<span>Password</span>
								<input type="password" name="password">
								<p class="error"></p>
							</div>
							<input type="submit" value="submit" onclick="submitLogin()">
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
					if(responseJSON["storyRedirect"]){
						redirect("storyRead/" + responseJSON["storyRedirect"]);
					} else{
						redirect("");
					}
				}
				else{
					document.querySelector("#username .error").innerHTML = responseJSON.hasOwnProperty('username') ? responseJSON["username"][0] : "";
					document.querySelector("#password .error").innerHTML = responseJSON.hasOwnProperty('password') ? responseJSON["password"][0] : "";
				}
			});
	}
	</script>


</body>
</html>