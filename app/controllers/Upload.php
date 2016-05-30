<?php

class Upload extends Controller{

	protected $storyTitle = "";
	protected function validateJSON($target_file){
		$valid = true;
		$zip = zip_open("$target_file");

		if ($zip)
		  {
			  while ($zip_entry = zip_read($zip))
			    {
			   		if(zip_entry_name($zip_entry) == "index.json"){

					    if (zip_entry_open($zip, $zip_entry))
					      {
						      $contents = zip_entry_read($zip_entry,10000000);

						      if(!$jsonObject = json_decode($contents,true)){
						      	echo "Can't decode json file,check it again";
						      	return false;
						      }

						      if(!$this->validateFields($jsonObject)){
						      	return false;
						      }

						      $this->storyTitle = $jsonObject['story']['meta']['title'];
						      zip_entry_close($zip_entry);
						  }

					    }
				}
			}
		   	

		zip_close($zip);
		
			
		return true;
	}

	protected function validateFields($jsonObject){

	     if(!isset($jsonObject['story']['meta']['title'])/* || $jsonObject['story']['meta']['title'] == NULL*/){
	     	echo "Missing title";
	     	return false;
	      }

	      if(isset($jsonObject['story']['categories'])){
	      	foreach ($jsonObject['story']['categories'] as $key => $value) {
	      		if(!isset($value['type']) || !isset($value['name']) || $value['type'] == "" || $value['name'] == ""){
	      			echo "Fields in categories must not be empty";
	      			return false;
	      			}
	      		}
	      	}

	      	if(!isset($jsonObject['story']['content']['pages'])){
	      		echo "There must be at least one page in the contents field";
	      		return false;
	      	}else{
	      		foreach ($jsonObject['story']['content'] as $key => $value) {
	      			if(isset($value['nextList'])){
	      				foreach ($value['nextList'] as $position => $val) {
	      					if(!isset($val['index']) || $val['index'] == ""){
	      						echo "The index(next page of the story) section cannot be empty";
	      						return false;
	      					} 

	      					if($val['index'] > sizeof($jsonObject['story']['content']['pages'])){
	      						echo "Index of the next page of a story is too large";
	      						return false;
	      					}
	      				}
	      			}
	      		}
	      	}

	      	return true;

	    }
	

	public function index(){
		$this->view('upload');

		$validJSON = 1;
		$target_dir = "../stories/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 0;
			} else {
				echo "File is a ZIP.";
				$uploadOk = 1;
			}
		}
			// Check if file already exists
		if (file_exists($target_file)) {
			echo "Sorry, file already exists.";
			$uploadOk = 0;
		}
			// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000) {
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}
			// Allow certain file formats
		if($imageFileType != "zip") {
			echo "Sorry, only ZIP files are allowed.";
		$uploadOk = 0;
	}
			// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			if($this->validateJSON($target_file)){
				echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
				//todo:fac directorul
				mkdir("../stories/$this->storyTitle");
				//unziping the file in directory with storyTitle

				$zip = new ZipArchive;
				$res = $zip->open($target_file);
				if ($res === TRUE) {
				  $zip->extractTo("../stories/$this->storyTitle");
				  $zip->close();
				} else {
				  echo 'Error at unzipping file!';
				}

				$this->model('Story');

				Story::insertFromJSON($_SESSION['userData']['ID'],"../stories/$this->storyTitle");

				unlink($target_file);
			} else{
				unlink($target_file);
			}
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}			
}


}
?>