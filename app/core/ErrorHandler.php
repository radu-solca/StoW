<?php 

class ErrorHandler{
	
	protected $errors = [];

	/**

		This method adds an error to the log that can be viewed via the all and first methods.
		Params:
		$errorMsg - The message corresponding to the error;
		$key - A key by which to group the errors; (optional)
	**/
	public function addError($errorMsg, $key = null){

		if ($key) {
			$this->errors[$key][] = $errorMsg;
		}
		else{
			$this->errors[] = $errorMsg;
		}
	}

	/**
		
		This method returns all errors correspnding to a key.
		If no key is provided, then it will return all errors.
	**/
	public function all($key = null){
		return isset($this->errors[$key]) ? $this->errors[$key] : $this->errors;
	}

	/**

		This method return true if at least one error has been logged.
	**/
	public function hasErrors(){
		return count($this->all()) ? true : false;
	}

	/**

		This method returns the first error of a specific key.
		A key MUST be provided.
	**/
	public function first($key){
		return isset($this->all($key)[0]) ? $this->all($key)[0] : '' ;
	}
}

 ?>