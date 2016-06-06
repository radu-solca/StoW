<?php

	class StoryRead extends Controller{

		public function index($storyId){

			$storyModel = $this->model('Story');


			$result = $storyModel->withId($storyId)->find();

			$storyPath = $result[0]['CONTENT'];
			$rating = $result[0]['RATING'];

			$indexJsonContents = file_get_contents($storyPath.'/index.json');

			//$json = json_decode($indexJsonContents);

		

			$data['json'] = $indexJsonContents;
			$data['rating'] = $rating;
			$data['path'] = $storyPath;
			$data['storyId'] = $storyId;



			
			$isFavourite = 0;
			if(App::userSignedIn()){

				$bookmark = $this->model('Bookmark');
				$favouriteModel = $this->model('Favorite');

				$favouriteResult = $favouriteModel->withUserId($_SESSION['userData']['ID'])->withStoryId($storyId)->find();
				

				if(isset($favouriteResult)){
					$isFavourite = 1;

				} else{
					$isFavourite = 0;

				}

				

				$result = $bookmark->withUserId($_SESSION['userData']['ID'])->withStoryId($storyId)->find();
				// echo $_SESSION['userData']['ID'],$storyId;
				// print_r($result);
				if(!empty($result)){
					//echo "mesaj2";
					$data['bookmarkedPage'] = $result[0]['PAGE_ID'];			
				}

			}
			$data['isFavourite'] = $isFavourite;

			$this->view("storyRead",$data);

			
		}

		public function addBookmark(){
			//print_r($_POST);

			if(App::userSignedIn()){
				$bookmark = $this->model('Bookmark');

				$bookmark->withUserId($_SESSION['userData']['ID'])
						->withStoryId($_POST['storyId'])
						->withPageId($_POST['pageId'])
						->insert();
				echo json_encode([]);

				} else{
					$_SESSION["storyRedirect"] = $_POST["storyId"];
					echo json_encode(["notLoggedIn"=>"true","storyRedirect"=>$_SESSION["storyRedirect"]]);	
				}

		}

		public function getComments(){
			$comment = $this->model('Comment'); 
			echo json_encode($comment->withStoryId($_POST['storyId'])->orderBy("DATE_ADDED", "DESC")->find());
		}

		public function addComments(){

			if(App::userSignedIn()){
				$comment = $this->model('Comment'); 
				$comment->withStoryId($_POST['storyId'])
						->withUserId($_SESSION['userData']['ID'])
						->withContent($_POST['content'])
						->insert();
				echo json_encode([]);
			}
			else{
				$_SESSION["storyRedirect"] = $_POST["storyId"];
				echo json_encode(["notLoggedIn"=>"true","storyRedirect"=>$_SESSION["storyRedirect"]]);
			}
			

		}

		public function addFavourite(){
			$favouriteModel = $this->model('Favorite');


				if(App::userSignedIn()){
					$result = $favouriteModel->withStoryId($_POST['storyId'])->withUserId($_SESSION['userData']['ID'])->find();

					if(!$result){
						$favouriteModel->withStoryId($_POST['storyId'])
										->withUserId($_SESSION['userData']['ID'])
										->insert();
						echo json_encode(["inserted"=>"true"]);
					} else{
						$favouriteModel->withStoryId($_POST['storyId'])
										->withUserId($_SESSION['userData']['ID'])
										->remove();
						echo json_encode(["removed"=>"true"]);
					}

				} else{
					$_SESSION["storyRedirect"] = $_POST["storyId"];
					echo json_encode(["notLoggedIn"=>"true","storyRedirect"=>$_SESSION["storyRedirect"]]);
				}
		}

		public function updateRating(){
			if(App::userSignedIn()){

				$rating = $this->model('Rating');

				$rating->withStoryId($_POST["storyId"])
						->withUserId($_SESSION['userData']['ID'])
						->withRatingValue($_POST["ratingValue"])
						->insert();

				echo json_encode([]);

			} else{
				echo json_encode(["notLoggedIn"=>"true"]);
			}
		}
	}
?>