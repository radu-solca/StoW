<?php 

	class StoryList{

		public $list;

		//This method populates $list with rows form the database representing stories.
		//
		//Parameters:
		//$title - a string representing an SQL regex for the title
		//$categories - an array of strings, formated like "<category_type>:<category_name>"
		//$limit - an integer, representing how many rows should be returned at most
		//$ordby - the name of the column by which the results should be ordered (note that they are ordered before $limit is applied)
		//$ordtype - ASC or DESC
		//
		//If all parameters are left null, then all rows in the database will be returned
		//
		//usage example: getStories(null, ['genre:porno','genre:fiction'], null, 'st_id', 'DESC');
		//this populates $list with all stories that are in the porno and fiction genres simultaneously, in descending order by id.
		public function getStories($title = null, $categories = null, $limit = null, $ordby = null, $ordtype = null ){
			$query = 'SELECT * FROM stories';

			$cond = array();
			$params = array();

			if (!is_null($title)) {
				$title = "%".$title."%";
			    $cond[] = "st_title LIKE ?";
			    $params[] = $title;
			}

			foreach($categories as $category){
				$category = explode(":",$category);
				$cond[] = "st_scripts.st_in_category(st_id, ?, ?) = 1";
				$params[] = $category[0];
				$params[] = $category[1];
			}

			if (count($cond)) {
			    $query .= ' WHERE ' . implode(' AND ', $cond);
			    //$query .= ' ORDER BY ' . $orderBy);
			}

			if (!is_null($ordby)) {
				if(is_null($ordtype)){
					$ordtype = 'ASC';
				}
			    $query .= " ORDER BY $ordby $ordtype";
			}

			if (!is_null($limit)) {
			     $query = "SELECT * FROM ( " . $query . ") WHERE rownum <= ?";
			     $params[] = $limit;
			}

			$db = Connection::getConnection();

			$stmt = $db->prepare($query);
			$stmt->execute($params);

			echo $query;
			echo '</br>';
			print_r($params);

			$this->list = $stmt->fetchAll(PDO::FETCH_ASSOC);

			echo '</br>';
			print_r($this->list);
		}
	}

 ?>