<?php 

	class StoryList{

		public $list = [];

		public function getStories($title = null, $categories = [], $ordby = '', $ordtype = 'ASC' ){

			// $title = 'Patrick';
			// $lastname = 'Allaert';

			$query = 'SELECT * FROM stories';

			$cond = array();
			$params = array();

			if (!is_null($title)) {
			    $cond[] = "st_title = ?";
			    $params[] = $title;
			}

			// foreach($categories as $category){

			// }

			// if (!empty($lastname)) {
			//     $cond[] = "lastname = ?";
			//     $params[] = $lastname;
			// }

			if (count($cond)) {
			    $query .= ' WHERE ' . implode(' AND ', $cond);
			}

			$db = Connection::getConnection();

			$stmt = $db->prepare($query);
			$stmt->execute($params);

			$this->list = $stmt->fetchAll(PDO::FETCH_ASSOC);

		}
	}

 ?>