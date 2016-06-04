<?php

	class Comment extends Model{		
		protected storyId = null;
		protected userId = null;


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

		 	 $db = Connection::getConnection();

			$stmt = $db->prepare($query);
			$stmt->execute($params);

			return $stmt->fetchAll(PDO::FETCH_ASSOC);

	}
}

?>