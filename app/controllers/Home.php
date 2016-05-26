<?php 

	class Home extends Controller{

		public function index(){

			$storyList = $this->model('StoryList');

			//get the newest 5 stories;
			$result = $storyList->orderBy('ID')->limit(5)->findStories();

			$this->view('menu');
			$this->view('home', ['latestStories'=>$result]);
		}
	}

 ?>