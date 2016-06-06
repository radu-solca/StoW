<?php 

	class Login extends Controller{

		public function index(){

			require_once '../app/core/Validator.php';

			if(!empty($_POST)){ //the form was previously completed
				$this->validate();
			}
			else{ //the form hasn't been completed.
				$this->view('login');
			}
		}

		protected function validate(){
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
					echo json_encode($validation->errors()->all());
				}
				else{ //form validation succeeded
					$user = $this->model('User');
					$user 	->withUsername($_POST['username'])
							->withPassword($_POST['password'])
							->login();

					if($user->failed()){ //database validation failed.
						echo json_encode($user->errors()->all());
					}
					else{ // all is good
						if(isset($_SESSION["storyRedirect"])){
							echo json_encode(['ok'=>true,'storyRedirect'=>$_SESSION['storyRedirect']]);
						} else{
							echo json_encode(['ok'=>true]);
						}
					}
				}
		}
	}

 ?>