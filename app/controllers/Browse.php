<?php

	class Browse extends Controller{

		public function index(){

			$categories = $this->model('Category');
			$data = [];

			$genres = $categories->getGenres();
			$ageGroupes = $categories->getAgeGroupes();

			$data['genres'] = $genres;
			$data['ageGroupes'] = $ageGroupes;

			$this->view('browse',$data);

		}
	}

?>