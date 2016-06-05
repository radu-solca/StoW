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
			$data['storyId'] = $storyId;


			

			if(App::userSignedIn()){
				$bookmark = $this->model('Bookmark');

				$result = $bookmark->withUserId($_SESSION['userData']['ID'])->withStoryId($storyId)->find();
				// echo $_SESSION['userData']['ID'],$storyId;
				// print_r($result);
				if(!empty($result)){
					echo "mesaj2";
					$data['bookmarkedPage'] = $result[0]['PAGE_ID'];
				}

			}


			$this->view("storyRead",$data);

			
		}

		public function addBookmark(){
			//print_r($_POST);
			$bookmark = $this->model('Bookmark');

			$bookmark->withUserId($_SESSION['userData']['ID'])
					->withStoryId($_POST['storyId'])
					->withPageId($_POST['pageId'])
					->insert();

		}

		public function getComments(){
			$comment = $this->model('Comment'); 
			echo json_encode($comment->withStoryId($_POST['storyId'])->find());
		}

		public function addComments(){
			$comment = $this->model('Comment'); 
			$comment->withStoryId($_POST['storyId'])
					->withUserId($_POST['storyId'])
					->withContent($_POST['content'])
					->insert();

		}
	}
?>