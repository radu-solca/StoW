<?php 

	class Profile extends Controller{

		public function index(){

			if(!App::userSignedIn()){
				App::redirect('notloggedin');
			}

			$this->view('profile', ["userData"=>$_SESSION["userData"]] );

		}
	}

 ?>