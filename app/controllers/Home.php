<?php 

	class Home extends Controller{

		public function index($name = ''){

			$stList = $this->model('StoryList');

			$stList->getStories('story_467');
			$result = $stList->list;

			$this->view('home/index');
		}
	}

 ?>