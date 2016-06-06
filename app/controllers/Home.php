<?php 

	class Home extends Controller{

		public function index(){

			$story = $this->model('Story');

			//get the newest 5 stories;
			$result = $story->orderBy('DATE_ADDED','DESC')->withCategory('approval','approved')->limit(5)->find();

			// $this->view('menu');
			$this->view('home', ['latestStories'=>json_encode($result)]);
		}
	}

 ?>