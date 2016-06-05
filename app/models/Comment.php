<?php

	class Comment{		
		protected $storyId = null;
		protected $userId = null;
		protected $content = null;


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

			 $db = Connection::getConnection();

			$stmt = $db->prepare($query);
			$stmt->execute($params);

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function insert(){
			$query = 'INTO comments (usr_id, st_id, cmt_content) VALUES (?,?,?)';

			$params = [$this->userId, $this->storyId, $this->content];

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

		public function withPageId($content){
			$this->content = $content;
			return $this;
		}
}

?>