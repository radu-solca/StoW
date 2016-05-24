<?php 

	class Home extends Controller{

		public function index(){

			$stList = $this->model('StoryList');

			//get the newest 5 stories;
			$stList->getStories(null, null, 5, 'st_date_added', null);
			$result = $stList->list;

			$this->view('home/index');
		}
	}

 ?>