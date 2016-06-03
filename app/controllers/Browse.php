<?php

	class Browse extends Controller{

		public function index(){
			// if(!empty($_POST)){ //the form was previously completed
			// 	$this->getFilteredStories();
			// }
			// else{ //the form hasn't been completed.

				$category = $this->model('Category');
				$data = [];

				$genres = $category->withType('genre')->orderBy('CAT_ID')->find();
				$ageGroupes = $category->withType('age_group')->orderBy('CAT_ID')->find();

				$data['genres'] = $genres;
				$data['ageGroups'] = $ageGroupes;

				$this->view('browse',$data);
			// }
		}

		public function getFilteredStories(){
			//print_r($_POST);
			//echo json_encode($_POST);
			$story = $this->model('Story');

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

			echo json_encode($story->find());

		}
	}

?>