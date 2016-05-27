<?php 

	class Register extends Controller{

		public function index(){

			require_once '../app/core/ErrorHandler.php';
			require_once '../app/core/Validator.php';

			if(!empty($_POST)){ //if the form has been completed, validate it
				$errorHandler = new ErrorHandler;
				$validator = new Validator($errorHandler);

				$validation = $validator->check($_POST,[
					'username' => [
						'required' => true,
						'maxlength' => 32,
						'minlength' => 3,
						'usrUnique' => 'withUsername'
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
						'email' => true,
						'usrUnique' => 'withEmail'
					]
				]);

				if ($validation->failed()) { //if we have errors, reload the form and print the errors
					//echo '<pre>' , print_r($validation->errors()->all()) , '</pre>';
					$this->view('register',['errors' => $validation->errors()]);
				}
				else{ //finish the registration if all is ok.
					$user = $this->model('User');
					$user 	->withUsername($_POST['username'])
							->withEmail($_POST['email'])
							->withPassword($_POST['password'])
							->withName($_POST['name'])
							->withSurname($_POST['surname'])
							->register();
					App::redirect();
				}
			}
			else{ //if the form wasn't completed, give it to the user.
				$this->view('register');
			}
		}
	}

 ?>