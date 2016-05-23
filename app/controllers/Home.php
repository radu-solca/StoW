<?php 

	class Home extends Controller{

		public function index($name = ''){

			$stList = $this->model('StoryList');

			$stList->getStories(null, ['genre:porno','genre:fiction'], null, 'st_id', null);
			$result = $stList->list;

			$this->view('home/index');
		}
	}

 ?>