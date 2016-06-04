<?php

	class Bookmark{

		protected $storyId = null;
		protected $userId = null;
		protected $pageId = null;


		public function find(){
			$query = 'SELECT * FROM bookmarks';

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

			 if (!is_null($this->pageId)) {
			     $cond[] = "PAGE_ID = ?";
		    	$params[] = $this->pageId;
			 }

			 if (count($cond)) {
			    $query .= ' WHERE ' . implode(' AND ', $cond);
			}

			 $db = Connection::getConnection();

			$stmt = $db->prepare($query);
			$stmt->execute($params);

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function insert(){
			$query = 'CALL st_scripts.bookmark(?,?,?)';

			if (!is_null($this->userId)) {
			     $params[] = $this->userId;
			 }

			if (!is_null($this->storyId)) {
			     $params[] = $this->storyId;
			 }

			 if (!is_null($this->pageId)) {
			     $params[] = $this->pageId;
			 }

			 $db = Connection::getConnection();

			$stmt = $db->prepare($query);
			$stmt->execute($params);

		}


		public function withStoryId($storyId){
			$this->storyId = $storyId;
			return $this;
		}

		public function withUserId($userId){
			$this->userId = $userId;
			return $this;
		}

		public function withPageId($pageId){
			$this->pageId = $pageId;
			return $this;
		}

	}

?>