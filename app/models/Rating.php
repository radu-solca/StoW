<?php

	class Rating{

		protected $storyId = null;
		protected $userId = null;
		protected $ratingValue = null;


		public function find(){
			$query = 'SELECT * FROM ratings';

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

			 if (!is_null($this->ratingValue)) {
			     $cond[] = "PAGE_ID = ?";
		    	$params[] = $this->ratingValue;
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

		public function withRatingValue($ratingValue){
			$this->ratingValue = $ratingValue;
			return $this;
		}
	}


?>
