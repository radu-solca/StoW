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

	public function whoIs($username){

		$user = $this->model('User');

		$result = $user->withUsername($username)->find();

		foreach($result as $key => $user){
			unset($user['PASSWORD']);
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
			echo '</br>';
			echo 'Aditional info:';
			echo '</br> <pre>';
			print_r($_SESSION['userData']);
			echo '</pre>';
		}
		else{
			echo 'You are not logged in';
		}
	}

	public function insert($title = null, $content=null, $cover=null){
		$title = $title === null ? 'Titlu generic' : $title;

		if(isset($_SESSION['userData'])){
			$story = $this->model('Story');

			$story->withTitle($title)
			->withCategory('genre','porno')
			->withCategory('genre','fiction')
			->withCategory('genzscre','horror')
			->withCategory('age_group','18+asd')
			->insert($_SESSION['userData']['ID'], $content, $cover);
		}
		else{
			echo 'You are not logged in';
		}
		
	}
}

 ?>