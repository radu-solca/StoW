<?php 

	class Profile extends Controller{

		public function index(){

			if(!App::userSignedIn()){
				App::redirect('notloggedin');
			}

			$bookmarkModel = $this->model('Bookmark');
			$story = $this->model('Story');
			$data = null;


			$bookmarkResult = $bookmarkModel->withUserId($_SESSION['userData']['ID'])->find();

			foreach ($bookmarkResult as $key => $value) {

				$userId = $value['USR_ID'];
				$storyId = $value['ST_ID'];
				$pageId = $value['PAGE_ID'];

				$storyResult = $story->withId($storyId)->find();

				$storyTitle = $storyResult[$key]['TITLE'];

				$data[$key]['storyTitle'] = $storyTitle;
				$data[$key]['bookmarkId'] = $pageId;
				$data[$key]['storyId'] = $storyId;

			}

			$this->view('profile',$data);

		}
	}

 ?>