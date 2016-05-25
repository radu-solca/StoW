<?php 

	class Home extends Controller{

		public function index(){

			$stList = $this->model('StoryList');

			//get the newest 5 stories;
			$stList->getStories(null, null, 5, 'DATE_ADDED', null);
			$result = $stList->list;

			$this->view('menu');
			$this->view('home');

		}
	}

 ?>