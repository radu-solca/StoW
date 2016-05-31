<?php 

class App{

	//this is the default controller
	protected $controller = 'home';

	//this is the default method within the controller
	protected $method = 'index';

	//those are the parameters that will be passed to the method
	protected $params = [];

	public function __construct(){
		$url = $this->parseURL();

		if(file_exists('../app/controllers/'.$url[0].'.php')){
			$this->controller = $url[0];
			unset($url[0]);
		}

		require_once '../app/controllers/'.$this->controller.'.php';

		$this->controller = new $this->controller;

		if(isset($url[1])){
			if(method_exists($this->controller, $url[1])){

				$this->method = $url[1];
				unset($url[1]);
			}
		}

		$this->params = $url ? array_values($url) : [];

		call_user_func_array([$this->controller, $this->method], $this->params);
	}

	// This method parses the url and returns an array as follows:
	//
	// localhost/StoW/public/story/index/30 
	// will be parsed to 
	// Array ( [0] => story [1] => index [2] => 30 )
	//
	// (Note: this url will be rewritten to localhost/StoW/public/index.php?url=story/index/30 by the .htaccess file)
	
	protected function parseURL(){
		if(isset($_GET['url'])){
			
			return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
		}
	}

	public static function redirect($path){
		$host  = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		header("Location: http://$host$uri/../$path");
		exit;
	}

	public static function makeAbsolute($path){
		$host  = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		return "http://$host$uri/$path";
	}
}

 ?>