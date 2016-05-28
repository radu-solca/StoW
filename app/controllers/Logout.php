<?php 

class Logout extends Controller{
	
	public function index(){
		$this->model('User')->logout();
		App::redirect();
	}
}

 ?>