<?php

	class Browse extends Controller{

		public function index(){

			$category = $this->model('Category');
			$data = [];

			$genres = $category->withType('genre')->orderBy('CAT_ID')->find();
			$ageGroupes = $category->withType('age_group')->orderBy('CAT_ID')->find();

			$data['genres'] = $genres;
			$data['ageGroups'] = $ageGroupes;

			$this->view('browse',$data);

		}
	}

?>