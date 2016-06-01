<?php 

class Logout extends Controller{
	
	public function index(){

		if(!App::userSignedIn()){
			App::redirect('notloggedin');
		}
		
		$this->model('User')->logout();
		App::redirect();
	}
}

 ?>