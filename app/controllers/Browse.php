<?php

	class Browse extends Controller{

		public function index(){
			if(!empty($_POST)){ //the form was previously completed
				$this->getFilteredStories();
			}
			else{ //the form hasn't been completed.

				$category = $this->model('Category');
				$data = [];

				$genres = $category->withType('genre')->orderBy('CAT_ID')->find();
				$ageGroupes = $category->withType('age_group')->orderBy('CAT_ID')->find();

				$data['genres'] = $genres;
				$data['ageGroups'] = $ageGroupes;

				$story = $this->model('Story');
				$data['stories'] = $story->find();

				$this->view('browse',$data);
			}
		}

		protected function getFilteredStories(){
			//print_r($_POST);
			//echo json_encode($_POST);
			$story = $this->model('Story');

			$categories = json_decode($_POST['categories']);
			if(!empty($categories)){
			    foreach($categories as $category){
					$story->withCategory($category->type, $category->name);
				}
			}

			$order = json_decode($_POST['order']);
			$story->orderBy($order->ordBy, $order->ordType);
			

			echo json_encode($story->find());

		}
	}

?>