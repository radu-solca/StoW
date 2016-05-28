<?php 

	class Register extends Controller{

		public function index(){

			require_once '../app/core/Validator.php';

			if(!empty($_POST)){ //the form was previously completed
				$validator = new Validator();

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

				if ($validation->failed()) { //form validation failed
					$this->view('register',['errors' => $validation->errors()]);
				}
				else{ //form validation succeeded
					$user = $this->model('User');
					$user 	->withUsername($_POST['username'])
							->withEmail($_POST['email'])
							->withPassword($_POST['password'])
							->withName($_POST['name'])
							->withSurname($_POST['surname'])
							->register();

					if($user->failed()){ //database validation failed.
						$this->view('register',['errors' => $user->errors()]);
					}
					else{ // all is good
						$user->login();
						App::redirect();
					}
				}
			}
			else{ //the form hasn't been completed.
				$this->view('register');
			}
		}
	}

 ?>