<?php

class Upload extends Controller{


	protected function validateJSON($target_file){
		$result = file_get_contents("$target_file#index.json"); 
		echo $result;

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
			}
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}			
}


}
?>