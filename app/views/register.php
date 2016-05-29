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

	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
</head>
<body>

	<?php 
	require_once '../app/views/menu.php';
	?>

	<div class="flexWrap flex column">

		<div class="register fullWidth flex center1 center2 first">
			<div class="guide960">
				<div class="margin20 flex center2">
					<div class="flex formContent center2 center1 column">
						<h1 class="title">Sign Up</h1>
						<p class="description">
							With an account, you can add bookmarks, ratings, comments and more!
						</p> 

						<form action="" class="flex column center1" method="post">
							<div id="username">
								Username: <input type="text" name="username">
								<p class="error"></p>
							</div>
							<div id="password">
								Password: <input type="password" name="password">
								<p class="error"></p>
							</div>
							<div id="repeat_password">
								Repeat password: <input type="password" name="repeat_password">
								<p class="error"></p>
							</div>
							<div id="email">
								Email: <input type="text" name="email">
								<p class="error"></p>
							</div>
							<div id="name">
								Name: <input type="text" name="name">
								<p class="error"></p>
							</div>
							<div id="surname">
								Surname: <input type="text" name="surname">
								<p class="error"></p>
							</div>
							<input type="button" value="submit" onclick="submitRegister()">
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
	function submitRegister(){
		var username=encodeURIComponent(document.querySelector("#username input").value),
		password=encodeURIComponent(document.querySelector("#password input").value),
		repeat_password=encodeURIComponent(document.querySelector("#repeat_password input").value),
		email=encodeURIComponent(document.querySelector("#email input").value),
		name=encodeURIComponent(document.querySelector("#name input").value),
		surname=encodeURIComponent(document.querySelector("#surname input").value),

		params = "username="+username
		+"&password="+password
		+"&repeat_password="+repeat_password
		+"&email="+email
		+"&name="+name
		+"&surname="+surname;

		ajaxPost(	"register", 
			params, 
			function(responseText){
				var responseJSON = JSON.parse(responseText);
				if(responseJSON["ok"] == true){
					redirect("");
				}
				else{
					document.querySelector("#username .error").innerHTML = responseJSON.hasOwnProperty('username') ? responseJSON["username"][0] : "";
					document.querySelector("#password .error").innerHTML = responseJSON.hasOwnProperty('password') ? responseJSON["password"][0] : "";
					document.querySelector("#repeat_password .error").innerHTML = responseJSON.hasOwnProperty('repeat_password') ? responseJSON["repeat_password"][0] : "";
					document.querySelector("#email .error").innerHTML = responseJSON.hasOwnProperty('email') ? responseJSON["email"][0] : "";
					document.querySelector("#name .error").innerHTML = responseJSON.hasOwnProperty('name') ? responseJSON["name"][0] : "";
					document.querySelector("#surname .error").innerHTML = responseJSON.hasOwnProperty('surname') ? responseJSON["surname"][0] : "";
				}
			});
	}
	</script>

	<script src="assets/js/nav.js"></script>

</body>