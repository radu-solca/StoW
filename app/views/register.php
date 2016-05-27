<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>StoW // Stories on the Web</title>
</head>
<body>
	<form action="register" method="post">
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
		<div>
			Repeat password: <input type="password" name="repeat_password" value="<?php echo @$_POST['repeat_password']; ?>">
		</div>
		<div>
			<?php 
				if(isset($data['errors'])){
					echo $data['errors']->first('repeat_password');
				}
			 ?>
		</div>
		<div>
			Email: <input type="text" name="email" value="<?php echo @$_POST['email']; ?>">
		</div>
		<div>
			<?php 
				if(isset($data['errors'])){
					echo $data['errors']->first('email');
				}
			 ?>
		</div>
		<div>
			Name: <input type="text" name="name" value="<?php echo @$_POST['name']; ?>">
		</div>
		<div>
			<?php 
				if(isset($data['errors'])){
					echo $data['errors']->first('name');
				}
			 ?>
		</div>
		<div>
			Surname: <input type="text" name="surname" value="<?php echo @$_POST['surname']; ?>">
		</div>
		<div>
			<?php 
				if(isset($data['errors'])){
					echo $data['errors']->first('surname');
				}
			 ?>
		</div>
		<input type="submit">
	</form>
</body>