<?php


	class StoryRead extends Controller{

		public function index(){
			$storyId = 56;

			$storyModel = $this->model('Story');

			$result = $storyModel->withId($storyId)->find();

			$storyPath = $result[0]['CONTENT'];
			$rating = $storyModel->getStoryRating($storyId);

			$indexJsonContents = file_get_contents($storyPath.'/index.json');

			$json = json_decode($indexJsonContents);

			$data['json'] = $indexJsonContents;
			$data['rating'] = $rating;
			$data['path'] = $storyPath;
			$data['storyId'] = $storyId;


			$this->view("storyRead",$data);

			
		}

		public function addBookmark(){
			print_r($_POST);
		}
	}
?>