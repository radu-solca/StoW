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

					<form action="login" class="flex column" method="post">
						<div>
							Username: <input type="text" name="username" value="<?php echo @$_POST['username']; ?>">
						</div>
						<div>
							<?php 
							if(isset($data['errors'])){
								echo $data['errors']->first('username');
							}
							?>
						</div>
						<div>
							Password: <input type="password" name="password" value="<?php echo @$_POST['password']; ?>">
						</div>
						<div>
							<?php 
							if(isset($data['errors'])){
								echo $data['errors']->first('password');
							}
							?>
						</div>
						<input type="submit">
					</form>

				</div>
			</div>
		</div>
	</div>

	<?php 
		require_once '../app/views/footer.php';
	 ?>

	<script src="assets/js/mobile.js"></script>

</body>