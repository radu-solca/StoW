<?php 

	class Profile extends Controller{

		public function index(){

			$this->view('profile', ["userData"=>$_SESSION["userData"]] );

		}
	}

 ?>