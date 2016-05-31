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
			// print_r($_POST);
			//echo json_encode($_POST);
			$story = $this->model('Story');
			$filters = json_decode($_POST['filters']);

		    foreach($filters as $filter){
				$story = $story->withCategory($filter->type,$filter->name);
			}
			

			echo json_encode($story->find());

		}
	}

?>