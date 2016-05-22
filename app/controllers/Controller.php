<?php 

//This is the base class for all controllers
class Controller{
	
	//This is a method that returns an instance of the model specified by name
	public function model($model){
		require_once '../app/models/'.$model.'.php';
		return new $model();
	}

	//This is a method that
	public function view($view, $data = []){
		require_once '../app/views/'.$view.'.php';
	}
}

 ?>