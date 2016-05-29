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
								<span>Username</span>
								<input type="text" name="username" onkeyup="submitRegister('username', false)">
								<p class="error"></p>
							</div>
							<div id="password">
								<span>Password</span>
								<input type="password" name="password" onkeyup="submitRegister('password', false)">
								<p class="error"></p>
							</div>
							<div id="repeat_password">
								<span>Repeat password</span>
								<input type="password" name="repeat_password" onkeyup="submitRegister('repeat_password', false)">
								<p class="error"></p>
							</div>
							<div id="email">
								<span>Email</span>
								<input type="text" name="email" onkeyup="submitRegister('email', false)">
								<p class="error"></p>
							</div>
							<div id="name">
								<span>Name</span>
								<input type="text" name="name" onkeyup="submitRegister('name', false)">
								<p class="error"></p>
							</div>
							<div id="surname">
								<span>Surname</span>
								<input type="text" name="surname" onkeyup="submitRegister('surname', false)">
								<p class="error"></p>
							</div>
							<input type="button" value="submit" onclick="submitRegister('all', true)">
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
	function submitRegister(field, done){

		var username=encodeURIComponent(document.querySelector("#username input").value),
		password=encodeURIComponent(document.querySelector("#password input").value),
		repeat_password=encodeURIComponent(document.querySelector("#repeat_password input").value),
		email=encodeURIComponent(document.querySelector("#email input").value),
		name=encodeURIComponent(document.querySelector("#name input").value),
		surname=encodeURIComponent(document.querySelector("#surname input").value);

		var params = "username="+username
		+ "&password="+password
		+ "&repeat_password="+repeat_password
		+ "&email="+email
		+ "&name="+name
		+ "&surname="+surname;

		if(done == true){
			params += "&done=true";
		}

		alert(params);

		ajaxPost(	"register", 
					params, 
					function(responseText){
						var responseJSON = JSON.parse(responseText);
						alert(responseText);
						if(responseJSON["success"] == true){
							redirect("");
						}
						else{
							updateErrors(responseJSON, field);
						}
					});
	}

	function updateErrors(responseJSON, subject){
		switch(subject){
			case "username":
				updateError(responseJSON, "username");
				break;
			case "password":
				updateError(responseJSON, "password");
				break;
			case "repeat_password":
				updateError(responseJSON, "repeat_password");
				break;
			case "email":
				updateError(responseJSON, "email");
				break;
			case "name":
				updateError(responseJSON, "name");
				break;
			case "surname":
				updateError(responseJSON, "surname");				
				break;
			default:
				updateError(responseJSON, "username");
				updateError(responseJSON, "password");
				updateError(responseJSON, "repeat_password");
				updateError(responseJSON, "email");
				updateError(responseJSON, "name");
				updateError(responseJSON, "surname");		}
		
	}

	function updateError(responseJSON, subject){
		document.querySelector("#"+subject+" .error").innerHTML = responseJSON.hasOwnProperty(subject) ? responseJSON[subject][0] : "";
	}
	</script>

	<script src="assets/js/nav.js"></script>

</body>