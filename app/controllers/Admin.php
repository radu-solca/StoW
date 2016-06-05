<?php

	class Admin extends Controller{

		public function index(){

			if(!App::userSignedIn()){
				App::redirect("notLoggedIn");
			}

			if($_SESSION['userData']['ADMIN']==0){
				App::redirect("notLoggedIn");
			}

			$category = $this->model('Category');
			$data = [];

			$genres = $category->withType('genre')->orderBy('CAT_ID')->find();
			$ageGroupes = $category->withType('age_group')->orderBy('CAT_ID')->find();

			$data['genres'] = $genres;
			$data['ageGroups'] = $ageGroupes;

			$this->view('admin',$data);
		}

		public function getFilteredStories(){
			//print_r($_POST);
			//echo json_encode($_POST);
			$story = $this->model('Story');
			$story->withCategory('approval','pending');

			if(isset($_POST['categories'])){
				$categories = json_decode($_POST['categories']);
			
			    foreach($categories as $category){
					$story->withCategory($category->type, $category->name);
				}
			}

			if(isset($_POST['order'])){
				$order = json_decode($_POST['order']);
				$story->orderBy($order->ordBy, $order->ordType);
			}
			
			if(isset($_POST['searchBarInput'])){
				$searchBarInput = json_decode($_POST['searchBarInput']);
				$story->withTitleLike($searchBarInput);
			}

			$totalStories = count($story->find());
			$totalPages  = ceil($totalStories / $_POST["rowsPerPage"]);

			$response = [
				'totalPages'=>$totalPages,
				'page'=>$story->withPagination($_POST["rowsPerPage"], $_POST["page"])->find()
			];

			echo json_encode($response);

		}

		public function approve(){
			if(App::userSignedIn()){
				if($_SESSION['userData']['ADMIN']==1){
					$story = $this->model('Story');
					$story->withID($_POST["ID"])->approve();
				}
			}
		}

		public function remove(){
			if(App::userSignedIn()){
				if($_SESSION['userData']['ADMIN']==1){
					$story = $this->model('Story');
					$story->withID($_POST["ID"])->remove();

					$dirPath = str_replace(' ', '', $_POST["TITLE"]); // Replaces all spaces with hyphens.
	   				$dirPath = preg_replace('/[^A-Za-z0-9\-]/', '', $dirPath); // Removes special chars.
	   				$dirPath = "../stories/".$dirPath;

	   				unlink($dirPath);
				}
			}
		}
	}

?>