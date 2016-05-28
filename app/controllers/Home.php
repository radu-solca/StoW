<?php 

	class Home extends Controller{

		public function index(){

			$story = $this->model('Story');

			//get the newest 5 stories;
			$result = $story->orderBy('ID')->limit(5)->findStories();

			// $this->view('menu');
			$this->view('home', ['latestStories'=>$result]);
		}
	}

 ?>