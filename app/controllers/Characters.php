<?php 

class Characters extends Controller{

	public function index($storyId){
		$storyModel = $this->model('Story');
		$result = $storyModel->withId($storyId)->find();

		$storyPath = $result[0]['CONTENT'];
		$json = json_decode(file_get_contents($storyPath.'/index.json'));

		$this->view("characters",["json"=>$json,"path"=>$storyPath]);
	}
}

 ?>