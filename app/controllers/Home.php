<?php 

	class Home extends Controller{

		public function index($name = ''){
			//get a user object
			//$user = $this->model('Connection');
			//give it a name
			//$user->name = $name;

			$db = Connection::getConnection();
			$sql = "SELECT * FROM STORIES";
			$stmt = $db->prepare($sql);
			$stmt->execute();

			$result = $stmt->fetchAll();

			foreach($result as $key => $row) //fiecare row contine:
			{
					echo "
					<tr>
						<td>$row[ST_ID]
						</td>
						<td>$row[ST_TITLE]
						</td>
						<td>$row[ST_CONTENT]
						</td>
						<td>$row[ST_COVER]
						</td>
						<td>$row[ST_DATE_ADDED]
						</td>
						<td>
						<a href=\"#\" title=\"EDIT\" onclick=\"editEntry($row[ST_ID])\" class=\"iconic pen_alt_stroke\"></a>
						<a href=\"#\" title=\"DELETE\" onclick=\"deleteStoryEntry($row[ST_ID])\" class=\"iconic trash_stroke\"></a>
						</td>
					</tr>
					";
			}
			
			//load a few views and pass some data for them to show to the user.
			//$this->view('home/index', ['name' => $user->name]);
			//$this->view('home/view2', ['whatAmI' => 'home/view2']);
		}
	}

 ?>