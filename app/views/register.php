<?php 

require_once '../app/core/ErrorHandler.php';
require_once '../app/core/Validator.php';

if(!empty($_POST)){
	$errorHandler = new ErrorHandler;
	$validator = new Validator($errorHandler);

	$validation = $validator->check($_POST,[
		'username' => [
			'required' => true,
			'maxlength' => 32,
			'minlength' => 3
		],
		'password' => [
			'required' => true,
			'maxlength' => 32,
			'minlength' => 6
		],
		'repeat_password' => [
			'match' => 'password'
		],
		'email' => [
			'required' => true,
			'maxlength' => 255,
			'email' => true
		]
	]);

	if ($validation->failed()) {
		echo '<pre>' , print_r($validation->errors()->all()) , '</pre>';
	}
}

 ?>

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
			Password: <input type="password" name="password" value="<?php echo @$_POST['password']; ?>">
		</div>
		<div>
			Repeat password: <input type="password" name="repeat_password" value="<?php echo @$_POST['repeat_password']; ?>">
		</div>
		<div>
			Email: <input type="text" name="email" value="<?php echo @$_POST['email']; ?>">
		</div>
		<div>
			Name: <input type="text" name="name" value="<?php echo @$_POST['name']; ?>">
		</div>
		<div>
			Surname: <input type="text" name="surname" value="<?php echo @$_POST['surname']; ?>">
		</div>
		<input type="submit">
	</form>
</body>