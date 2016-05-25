<?php 

	class Register extends Controller{

		public function index(){

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


			$this->view('register');
		}
	}

 ?>