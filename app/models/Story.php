<?php 

class Story{

	protected $title = null;
	protected $categories = [];
	protected $ordby = null;
	protected $ordtype = null;
	protected $limit = null;

	protected $errorHandler;

	public function __construct(){
		require_once '../app/core/ErrorHandler.php';
		$this->errorHandler = new ErrorHandler;
	}

	/**	
		This method returns a list of rows form the database representing stories, according to the object's parameters.
		
		Conditions for the query can be set prior to calling this method
		
		usage example: 
		$result = (new StoryList)->withCategory('genre','porno')
								 ->withCategory('genre','fiction')
								 ->orderBy('ID','DESC')
								 ->limit(5)
								 ->find();
		this returns all stories that are in the porno and fiction genres simultaneously, in descending order by id.
	**/
	public function find(){
		$query = 'SELECT * FROM stories_view';

		$cond = array();
		$params = array();

		if (!is_null($this->title)) {
			$titleRegex = "%".$this->title."%";
		    $cond[] = "TITLE LIKE ?";
		    $params[] = $titleRegex;
		}

		if(!empty($this->categories)){
			foreach($this->categories as $category){
				$category = explode(":",$category);
				$cond[] = "st_scripts.st_in_category(ID, ?, ?) = 1";
				$params[] = $category[0];
				$params[] = $category[1];
			}
		}

		if (count($cond)) {
		    $query .= ' WHERE ' . implode(' AND ', $cond);
		    //$query .= ' ORDER BY ' . $orderBy);
		}

		if (!is_null($this->ordby)) {
			if(is_null($this->ordtype)){
				$this->ordtype = 'ASC';
			}
		    $query .= " ORDER BY $this->ordby $this->ordtype";
		}

		if (!is_null($this->limit)) {
		     $query = "SELECT * FROM ( " . $query . ") WHERE rownum <= ?";
		     $params[] = $this->limit;
		}

		$db = Connection::getConnection();

		$stmt = $db->prepare($query);
		$stmt->execute($params);

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function insert($usrID, $content, $cover){
		$db = Connection::getConnection();
		$storyID = null;

		//insert the story itself
		try{
			$query =   'DECLARE
							v_id_output stories.st_id%type;
						BEGIN
							v_id_output := st_scripts.insert_story(?,?,?,?);
						END;'; 

			$params = [$usrID, $this->title, $content, $cover];

			$stmt = $db->prepare($query);
			$stmt->execute($params);


			$query =   'SELECT st_id FROM stories WHERE st_title = ?';
			$params = [$this->title];
			$stmt = $db->prepare($query);
			$stmt->execute($params);

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			print_r($result);
			$storyID = $result[0]['ST_ID'];

		} catch (PDOException $e) {
		    switch($db->errorInfo()[1]){
		    	case "20001":
		    		$this->errorHandler->addError('A story with this title already exists');
		    		break;
		    	default:
		    		$this->errorHandler->addError('An unknown error has occured');
		    }
		    print_r($this->errorHandler->all());
		}

		//add the categories
		if(!empty($this->categories))
		try{
			$query =   'DECLARE
							v_id_output stories.st_id%type;
						BEGIN
							v_id_output := st_scripts.add_cat_to_st(?,?,?);
						END;'; 


			foreach($this->categories as $category){
				$category = explode(":",$category);
				$params = [$storyID, $category[0], $category[1]];
				$stmt = $db->prepare($query);
				$stmt->execute($params);
			}

		} catch (PDOException $e) {
		    switch($db->errorInfo()[1]){
		    	default:
		    		$this->errorHandler->addError('An unknown error has occured');
		    }
		}

	}

	public function withTitleLike($title){
		$this->title = $title;
		return $this;
	}

	public function withTitle($title){
		$this->title = $title;
		return $this;
	}

	public function withCategory($cat_type, $cat_name){
		$this->categories[] = $cat_type.':'.$cat_name;
		return $this;
	}

	public function orderBy($ordby, $ordtype = 'ASC'){
		$this->ordby = $ordby;
		$this->ordtype = $ordtype;
		return $this;
	}

	public function limit($limit){
		$this->limit = $limit;
		return $this;
	}

	public function reset(){
		$this->title = null;
		$this->categories = [];
		$this->ordby = null;
		$this->ordtype = null;
		$this->limit = null;
	}
}

 ?>