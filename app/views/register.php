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
			Username: <input type="text" name="username">
		</div>
		<div>
			Password: <input type="password" name="password">
		</div>
		<div>
			Repeat password: <input type="password" name="repeat_password">
		</div>
		<div>
			Email: <input type="text" name="email">
		</div>
		<div>
			Name: <input type="text" name="name">
		</div>
		<div>
			Surname: <input type="text" name="surname">
		</div>
		<input type="submit">
	</form>
</body>