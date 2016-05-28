<?php 

/**
	This will serve as a playground for the developers.
	To add a test, just create another method within the Test class.
	Then you can access this test via StoW/test/testname.
**/
class Test extends Controller{

	public function index(){
		echo "test";
	}

	public function user(){

		$user = $this->model('User');

		$result = $user->withUsername('user_1')->limit(3)->find();

		foreach($result as $key => $user){
			echo '<pre>'; print_r($user); echo '</pre>';
		}
	}

	public function login(){
		$user = $this->model('User');

		$result = $user->withUsername('aleliua')->withPassword('aleliua')->login();
	}

	public function logout(){
		$user = $this->model('User');

		$user->logout();
	}

	public function whoAmI(){
		if(isset($_SESSION['userData'])){
			echo 'You are logged in as ' . $_SESSION['userData']['USERNAME'];
		}
		else{
			echo 'You are not logged in';
		}
	}
}

 ?>