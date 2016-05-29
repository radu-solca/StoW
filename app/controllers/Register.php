<?php 

	class Register extends Controller{

		public function index(){
			require_once '../app/core/Validator.php';

			if(!empty($_POST)){ //the form was previously completed
				$this->validate();
			}
			else{ //the form hasn't been completed.
				$this->view('register');
			}
		}

		protected function validate(){
			$validator = new Validator;
			$validation = $validator->check($_POST,[
				'username' => [
					'required' => true,
					'maxlength' => 3,
					'maxlength' => 32,
					'usrUnique' => 'withUsername',
					'alphaNumPlus' => true,
					'minAlpha' => 3
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
				],
				'name' => [
					'alpha' => true,
					'minAlpha' => 3
				],
				'surname' => [
					'alpha' => true,
					'minAlpha' => 3
				]
			]);

			if ($validation->failed()) { //form validation failed
				echo json_encode($validation->errors()->all());
			}
			else{ //form validation succeeded

				if(isset($_POST['done'])){
					$user = $this->model('User');
					$user 	->withUsername($_POST['username'])
							->withPassword($_POST['password'])
							->withEmail($_POST['email'])
							->withName($_POST['name'])
							->withSurname($_POST['surname'])
							->register();

					if($user->failed()){ //database validation failed.
						echo json_encode($user->errors()->all());
					}
					else{ // all is good
						$user->login();
						echo json_encode(['success'=>true]);
					}
				}
				else{
					echo json_encode([]);
				}
			}
		}
	}

 ?>