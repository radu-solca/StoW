<?php


	class StoryRead extends Controller{

		public function index($storyId){


			$storyModel = $this->model('Story');

			$result = $storyModel->withId($storyId)->find();

			$storyPath = $result[0]['CONTENT'];
			$rating = $storyModel->getStoryRating($storyId);

			$indexJsonContents = file_get_contents($storyPath);

			$json = json_decode($indexJsonContents);

			$data['json'] = $indexJsonContents;
			$data['rating'] = $rating; 
			
			$this->view("storyRead",$data);

			
		}
	}
?>