<?php


	class StoryRead extends Controller{

		public function index($storyId){


			$storyModel = $this->model('Story');

			$result = $storyModel->withId($storyId)->find();

			$storyPath = $result[0]['CONTENT'];
			$rating = $storyModel->getStoryRating($storyId);

			$indexJsonContents = file_get_contents($storyPath.'/index.json');

			$json = json_decode($indexJsonContents);

			$data['json'] = $indexJsonContents;
			$data['rating'] = $rating;
			$data['path'] = $storyPath;
			
			$this->view("storyRead",$data);

			
		}
	}
?>