

<?php

class Category{

	protected $type = null;
	protected $name = null;

	protected $ordby = null;
	protected $ordtype = null;
	protected $limit = null;

	protected $errorHandler;
	public function errors(){

		return $this->errorHandler;
	}

	public function failed(){
		
		return $this->errorHandler->hasErrors();
	}


	public function find(){
		try{
			$query = "SELECT * FROM categories";

			if (!empty($this->type)) {
			    $cond[] = "CAT_TYPE = ?";
			    $params[] = $this->type;
			}

			if (!empty($this->name)) {
			    $cond[] = "CAT_NAME = ?";
			    $params[] = $this->name;
			}

			if (count($cond)) {
			    $query .= ' WHERE ' . implode(' AND ', $cond);
			}

			if (!empty($this->ordby)) {
				if(empty($this->ordtype)){
					$this->ordtype = 'ASC';
				}
			    $query .= " ORDER BY $this->ordby $this->ordtype";
			}

			if (!empty($this->limit)) {
			     $query = "SELECT * FROM ( " . $query . ") WHERE rownum <= ?";
			     $params[] = $this->limit;
			}

			$db = Connection::getConnection();

			$stmt = $db->prepare($query);
			$stmt->execute($params);

			return $stmt->fetchAll(PDO::FETCH_ASSOC);

		} catch (PDOException $e) {
		    switch($db->errorInfo()[1]){
		    	default:
		    		$this->errorHandler->addError('An unknown error has occured');
		    }
		    return false;
		}
		
	}

	public function withType($type){
		$this->type = $type;
		return $this;
	}
	public function withName($name){
		$this->name = $name;
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
}
?>