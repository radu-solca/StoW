<?php

	class Comment{		
		protected $storyId = null;
		protected $userId = null;
		protected $content = null;

		protected $ordby = null;
		protected $ordtype = null;

		protected $limit = null;

		protected $page = 1;
		protected $rowsPerPage = null;


		public function find(){
			$query = 'SELECT * FROM comments_view';

			$cond = array();
			$params = array();

			if (!is_null($this->userId)) {
			    $cond[] = "USER_ID = ?";
		    	$params[] = $this->userId;	
			}

			if (!is_null($this->storyId)) {
			    $cond[] = "STORY_ID = ?";
		    	$params[] = $this->storyId;
			}

			if (!is_null($this->content)) {
				$contentRegex = "%".$this->content."%";
			    $cond[] = "CONTENT LIKE ?";
		    	$params[] = $this->content;
			}

			if (count($cond)) {
			    $query .= ' WHERE ' . implode(' AND ', $cond);
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

			
			 
			if (!is_null($this->rowsPerPage)){
				$query = "SELECT * FROM (select results.*, ROWNUM rnum FROM (" . $query . ") results WHERE ROWNUM<=?) WHERE rnum >= ?";

				$lastRowNumberInPage  = $this->rowsPerPage * ($this->page - 1);

				$sum = $lastRowNumberInPage+$this->rowsPerPage;
				$lastRowNumberInPage = $lastRowNumberInPage+1; //60 => 61 on next page

				$params[] = $sum;
				$params[] = $lastRowNumberInPage;
			}

			$db = Connection::getConnection();

			// echo $query;
			// print_r($params);

			$stmt = $db->prepare($query);
			$stmt->execute($params);

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function insert(){
			$query = 'INSERT INTO comments (usr_id, st_id, cmt_content) VALUES (?,?,?)';

			$params = [$this->userId, $this->storyId, htmlspecialchars(($this->content))];

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

		public function withContent($content){
			$this->content = $content;
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

		public function withPagination($rowsPerPage, $page = 1){

			$this->rowsPerPage = $rowsPerPage;
			$this->page = $page;
			return $this;
		}

}

?>