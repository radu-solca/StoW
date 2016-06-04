<?php

	class Bookmark extends Model{

		protected storyId = null;
		protected userId = null;
		protected pageId = null;


			public function find(){
				$query = 'SELECT * FROM stories_view';

				$cond = array();
				$params = array();

				if (!is_null($this->storyId)) {
				     $query = "SELECT * FROM ( " . $query . ") WHERE id = ?";
				     $params[] = $this->storyId;
				 }

				 if (!is_null($this->userId)) {
				     $query = "SELECT * FROM ( " . $query . ") WHERE id = ?";
				     $params[] = $this->userId;
				 }

				 if (!is_null($this->pageId)) {
				     $query = "SELECT * FROM ( " . $query . ") WHERE id = ?";
				     $params[] = $this->pageId;
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

		public function withPageId($pageId){
			$this->pageId = $pageId;
			return $this;
		}

	}

?>