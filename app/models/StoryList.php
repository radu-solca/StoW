<?php 

class StoryList{

	protected $title = null;
	protected $categories = [];
	protected $ordby = null;
	protected $ordtype = null;
	protected $limit = null;

	/**	
		This method returns a list of rows form the database representing stories, according to the object's parameters.
		
		Conditions for the query can be set prior to calling this method
		
		usage example: 
		$result = (new StoryList)->withCategory('genre','porno')
								 ->withCategory('genre','fiction')
								 ->orderBy('ID','DESC')
								 ->limit(5)
								 ->getStories();
		this returns all stories that are in the porno and fiction genres simultaneously, in descending order by id.
	**/
	public function findStories(){
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

	public function like($title){
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