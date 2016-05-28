<?php 

	class Login extends Controller{

		public function index(){

			require_once '../app/core/Validator.php';

			if(!empty($_POST)){ //the form was previously completed
				$validator = new Validator;

				$validation = $validator->check($_POST,[
					'username' => [
						'required' => true,
					],
					'password' => [
						'required' => true,
					],
				]);

				if ($validation->failed()) { //form validation failed
					$this->view('login',['errors' => $validation->errors()]);
				}
				else{ //form validation succeeded
					$user = $this->model('User');
					$user 	->withUsername($_POST['username'])
							->withPassword($_POST['password'])
							->login();

					if($user->failed()){ //database validation failed.
						$this->view('login',['errors' => $user->errors()]);
					}
					else{ // all is good
						App::redirect();
					}
				}
			}
			else{ //the form hasn't been completed.
				$this->view('login');
			}
		}
	}

 ?>