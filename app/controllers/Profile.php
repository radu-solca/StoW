<?php 

	class Profile extends Controller{

		public function index(){

			if(!App::userSignedIn()){
				App::redirect('notloggedin');
			}

			$bookmarkModel = $this->model('Bookmark');
			$storyModel = $this->model('Story');
			$ratingModel = $this->model('Rating');

			$data = null;

			$bookmarkResult = $bookmarkModel->withUserId($_SESSION['userData']['ID'])->find();

			foreach ($bookmarkResult as $key => $value) {

				$userId = $value['USR_ID'];
				$storyId = $value['ST_ID'];
				$pageId = $value['PAGE_ID'];

				$storyResult = $storyModel->withId($storyId)->find();

				$storyTitle = $storyResult[0]['TITLE'];

				$data['bookmark'][$key]['storyTitle'] = $storyTitle;
				$data['bookmark'][$key]['bookmarkId'] = $pageId;
				$data['bookmark'][$key]['storyId'] = $storyId;

			}

			$ratingResult = $ratingModel->withUserId($_SESSION['userData']['ID'])->find();
			foreach ($ratingResult as $key => $value) {
				
				$ratingValue = $value['RAT_VALUE'];

				$storyId = $value['ST_ID'];

				$storyResult = $storyModel->withId($storyId)->find();

				$storyTitle = $storyResult[0]['TITLE'];

				$data['rating'][$key]['storyTitle'] = $storyTitle;
				$data['rating'][$key]['ratingValue'] = $ratingValue;
				$data['rating'][$key]['storyId'] = $storyId;

			}

			$this->view('profile',$data);

		}
	}

 ?>