<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>StoW // Profile</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,400italic,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Amatic+SC:700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" media="screen and (max-width:500px)" href="assets/css/style_mobile.css" />

	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
</head>
<body>

	<?php 
	require "../app/views/menu.php";
	?>

	<div class="flexWrap flex column">

		<div class="profile fullWidth flex center1 center2 first">
			<div class="guide960">
				<div class="margin20 flex center1 center2 column topBottom40">

					<div id ="userViewEdit" class="flex formContent center2 center1 column">
					
						<h1 class="title">User</h1>

						<form action="" class="flex column center1" method="post">
							<div id="username">
								<span>Username</span>
								<?php 
									echo "<input value=\"".$_SESSION["userData"]['USERNAME']."\" type=\"text\" name=\"username\" onkeyup=\"\">";
 								?>
								<p class="error"></p>
							</div>
							<div id="email">
								<span>Email</span>
								<?php 
									echo "<input value=\"".$_SESSION["userData"]['EMAIL']."\" type=\"text\" name=\"email\" onkeyup=\"\">";
 								?>
								<p class="error"></p>
							</div>
							<div id="name">
								<span>Name</span>
								<?php 
									echo "<input value=\"".$_SESSION["userData"]['NAME']."\" type=\"text\" name=\"name\" onkeyup=\"\">";
 								?>
								<p class="error"></p>
							</div>
							<div id="surname">
								<span>Surname</span>
								<?php 
									echo "<input value=\"".$_SESSION["userData"]['SURNAME']."\" type=\"text\" name=\"surname\" onkeyup=\"\">";
 								?>
								<p class="error"></p>
							</div>
							<input type="button" value="save" onclick="submitRegister('all', true)">
						</form>

					</div>

					<!--=============== SEP ==============-->

					<div id="bookmarksViewEdit" class="flex formContent center2 center1 column">
					
						<h1 class="title">Bookmarks</h1>

						<form action="" class="flex column center1" method="post">
						</form>

					</div>

					<div id="favoritesViewEdit" class="flex formContent center2 center1 column">
					
						<h1 class="title">Favorites</h1>

						<form action="" class="flex column center1" method="post">
						</form>

					</div>


					<div id="ratingsViewEdit" class="flex formContent center2 center1 column">
					
						<h1 class="title">Ratings</h1>

						<form action="" class="flex column center1" method="post">
						</form>

					</div>

					<div id="commentsViewEdit" class="flex formContent center2 center1 column">
					
						<h1 class="title">Comments</h1>

						<form action="" class="flex column center1" method="post">
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

	<script src="assets/js/nav.js"></script>

</body>
</html>