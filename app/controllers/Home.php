<?php 

	class Home extends Controller{

		public function index(){

			$stList = $this->model('StoryList');

			//get the newest 5 stories;
			$stList->getStories(null, null, 5, 'ID', 'ASC');

			$result = $stList->list;

			$this->view('menu');
			$this->view('home', ['latestStories'=>$result]);
		}
	}

 ?>