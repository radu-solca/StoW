<?php

	class Favorite{

		protected $storyId = null;
		protected $userId = null;


		public function find(){
			$query = 'SELECT * FROM favourites';

			$cond = array();
			$params = array();

			if (!is_null($this->userId)) {
			    $cond[] = "USR_ID = ?";
		    	$params[] = $this->userId;	
			 }

			if (!is_null($this->storyId)) {
			     $cond[] = "ST_ID = ?";
		    	$params[] = $this->storyId;
			 }

			 if (count($cond)) {
			    $query .= ' WHERE ' . implode(' AND ', $cond);
			}

			$db = Connection::getConnection();

			$stmt = $db->prepare($query);
			$stmt->execute($params);

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function withStoryId($storyId){
			$this->storyId = $storyId;
			return $this;
		}

		public function withUserId($userId){
			$this->userId = $userId;
			return $this;
		}

		public function insert(){
			$query = 'INSERT INTO favourites (usr_id, st_id) VALUES (?,?)';

			$params = [$this->userId, $this->storyId];
			
			$db = Connection::getConnection();

			$stmt = $db->prepare($query);
			$stmt->execute($params);
		}

		public function remove(){
		$query = 'DELETE FROM favourites';

		if (!is_null($this->storyId)) {
		    $cond[] = "ST_ID = ?";
		    $params[] = $this->storyId;
		}

		if (!is_null($this->userId)) {
		    $cond[] = "USR_ID = ?";
		    $params[] = $this->userId;
		}


		if (count($cond)) {
		    $query .= ' WHERE ' . implode(' AND ', $cond);
		}

		$db = Connection::getConnection();

		// echo $query;
		// echo '<br>';
		// print_r($params);

		$stmt = $db->prepare($query);
		$stmt->execute($params);
		}
	}
?>