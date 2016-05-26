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

		$result = $user->orderBy('ID')->limit(3)->find();

		foreach($result as $key => $user){
			echo '<pre>'; print_r($user); echo '</pre>';
		}
	}
}

 ?>