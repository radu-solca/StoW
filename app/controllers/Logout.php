<?php 

class Logout extends Controller{
	
	public function index(){

		if(isset($_SESSION['storyRedirect'])){
			unset($_SESSION['storyRedirect']);
		}

		if(!App::userSignedIn()){
			App::redirect('notloggedin');
		}
		

		$this->model('User')->logout();
		App::redirect();
	}
}

 ?>