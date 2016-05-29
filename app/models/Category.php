

<?php

	class Category{

		public function getGenres(){
			$query = "select CAT_NAME from categories where CAT_TYPE='genre'";

			$db = Connection::getConnection();

			$stmt = $db->prepare($query);
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_ASSOC); 
		}

	public function getAgeGroupes(){
			$query = "select CAT_NAME from categories where CAT_TYPE='age_group'";

			$db = Connection::getConnection();

			$stmt = $db->prepare($query);
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_ASSOC); 
		}


	}
?>