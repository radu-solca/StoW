<?php

class Upload extends Controller{

	protected $errorHandler;

	protected $storyTitle = "";

	public function __construct(){
		require_once '../app/core/ErrorHandler.php';
		$this->errorHandler = new ErrorHandler;
	}

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
						      	$this->errorHandler->addError("Can't decode json file,check it again");
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
			} else{
				return false;
			}
		   	

		zip_close($zip);
		
			
		return true;
	}

	protected function validateFields($jsonObject){

	     if(!isset($jsonObject['story']['meta']['title'])){
	     	$this->errorHandler->addError("Missing title");
	     	return false;
	      }

	      if(isset($jsonObject['story']['categories'])){
	      	foreach ($jsonObject['story']['categories'] as $key => $value) {
	      		if(!isset($value['type']) || !isset($value['name']) || $value['type'] == "" || $value['name'] == ""){
	      			$this->errorHandler->addError("Fields in categories must not be empty");
	      			return false;
	      			}
	      		}
	      	}

	      	if(!isset($jsonObject['story']['content']['pages'])){
	      		$this->errorHandler->addError("There must be at least one page in the contents field");
	      		return false;
	      	}else{
	      		foreach ($jsonObject['story']['content'] as $key => $value) {
	      			if(isset($value['nextList'])){
	      				foreach ($value['nextList'] as $position => $val) {
	      					if(!isset($val['index']) || $val['index'] == ""){
	      						$this->errorHandler->addError("The index(next page of the story) section cannot be empty");
	      						return false;
	      					} 

	      					if($val['index'] > sizeof($jsonObject['story']['content']['pages'])){
	      						$this->errorHandler->addError("Index of the next page of a story is too large");
	      						return false;
	      					}
	      				}
	      			}
	      		}
	      	}

	      	return true;
	}
	
	public function index(){
		if(!App::userSignedIn()){
			App::redirect('notloggedin');
		}
		if(!empty($_POST)){ //the form was previously completed

			$validJSON = 1;
			$target_dir = "../stories/";
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		
				// Check file size
			if ($_FILES["fileToUpload"]["size"] > 500000000) {
				$this->errorHandler->addError("Sorry, your file is too large.");
				$uploadOk = 0;
			}
				// Allow certain file formats
			if($imageFileType != "zip") {
				$this->errorHandler->addError("Sorry, only ZIP files are allowed.");
			$uploadOk = 0;
			}
					// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				$this->errorHandler->addError("Sorry, your file was not uploaded.");
					// if everything is ok, try to upload file
			} else {
				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					if($this->validateJSON($target_file)){
						//$this->errorHandler->addError("The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.");
						
						$dirPath = str_replace(' ', '', $this->storyTitle); // Replaces all spaces with hyphens.

		   				$dirPath = strip_tags($dirPath);

		   				$dirPath = preg_replace('/[^A-Za-z0-9\-]/', '', $dirPath); // Removes special chars.



		   				$dirPath = "../stories/".$dirPath;

		   				//check if the directory with story's title allready exists
		   				if (file_exists($dirPath)) {
							$this->errorHandler->addError('Sorry, story already exists.');
							unlink($target_file);

						} else{
							mkdir($dirPath);
							//unziping the file in directory with storyTitle

							$zip = new ZipArchive;
							$res = $zip->open($target_file);
							if ($res === TRUE) {
							  $zip->extractTo($dirPath);
							  $zip->close();
							} else {
								$this->errorHandler->addError('Error at unzipping file!');
							}

							$this->model('Story');

							$storyErrors = Story::insertFromJSON($_SESSION['userData']['ID'],$dirPath);
							if($storyErrors->hasErrors()){
								$this->errorHandler->addError("There was a problem inserting into the database");
							}

							unlink($target_file);
						}
					} else{
						unlink($target_file);
						}	
				} else {
					$this->errorHandler->addError("Sorry, there was an error uploading your file.");
				}
			}	
			$errors = $this->errorHandler->hasErrors()? $this->errorHandler->all() : ['Your story was succesfully updated!'];
			$this->view('upload',['errors'=>$errors]);
		}
		else{ //the form hasn't been completed.
			$this->view('upload');
		}


	}	



}
?>