<?php 

	class Profile extends Controller{

		public function index(){

			if(!App::userSignedIn()){
				App::redirect('notloggedin');
			}

			$bookmarkModel = $this->model('Bookmark');
			$storyModel = $this->model('Story');
			$ratingModel = $this->model('Rating');
			$favoriteModel = $this->model('Favorite');
			//$commentModel = $this->model('Comment');

			$data = null;

			$bookmarkResult = $bookmarkModel->withUserId($_SESSION['userData']['ID'])->find();

			if($bookmarkResult){
				foreach ($bookmarkResult as $key => $value) {

					$userId = $value['USR_ID'];
					$storyId = $value['ST_ID'];
					$pageId = $value['PAGE_ID'];

					$storyResult = $storyModel->withId($storyId)->find();
					$storyTitle = $storyResult[0]['TITLE'];

					$data['bookmarks'][$key]['storyTitle'] = $storyTitle;
					$data['bookmarks'][$key]['bookmarkId'] = $pageId;
					$data['bookmarks'][$key]['storyId'] = $storyId;

				}
			} else{
				$data['bookmarks'] = null;
			}

			$ratingResult = $ratingModel->withUserId($_SESSION['userData']['ID'])->find();

			if($ratingResult){
				foreach ($ratingResult as $key => $value) {
					
					$ratingValue = $value['RAT_VALUE'];

					$storyId = $value['ST_ID'];

					$storyResult = $storyModel->withId($storyId)->find();
					$storyTitle = $storyResult[0]['TITLE'];

					$data['ratings'][$key]['storyTitle'] = $storyTitle;
					$data['ratings'][$key]['ratingValue'] = $ratingValue;
					$data['ratings'][$key]['storyId'] = $storyId;

				}
			} else{
				$data['ratings'] = null;
			}

			$favouritesResult = $favoriteModel->withUserId($_SESSION['userData']['ID'])->find();
			$i = 0;

			if($favouritesResult){
				foreach ($favouritesResult as $value) {
					$userId = $value['USR_ID'];
					$storyId = $value['ST_ID'];

					$storyResult = $storyModel->withId($storyId)->find();
					$storyTitle = $storyResult[0]['TITLE'];

					$data['favourites'][$i]['storyTitle'] = $storyTitle;
					$data['favourites'][$i]['storyId'] = $storyId; 

					$i++;

				}
			} else{
				$data['favourites'] = null;
			}


			$this->view('profile',$data);

		}
	}

 ?>