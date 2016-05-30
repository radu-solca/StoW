<?php 

	class Profile extends Controller{

		public function index(){

			$story = $this->model('Story');

			$this->view('profile');
		}
	}

 ?>