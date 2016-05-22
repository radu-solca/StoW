<?php 

	class Home extends Controller{

		public function index($name = ''){
			//get a user object
			$user = $this->model('User');
			//give it a name
			$user->name = $name;
			
			//load a few views and pass some data for them to show to the user.
			$this->view('home/index', ['name' => $user->name]);
			$this->view('home/view2', ['whatAmI' => 'home/view2']);
		}
	}

 ?>