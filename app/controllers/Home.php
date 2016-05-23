<?php 

	class Home extends Controller{

		public function index($name = ''){
			//get a user object

			//$user = $this->model('User');
			//give it a name
			//$user->name = $name;

			$stList = $this->model('StoryList');

			$stList->getStories('story_467');
			$result = $stList->list;

			// $db = Connection::getConnection();
			// $sql = "SELECT * FROM STORIES";
			// $stmt = $db->prepare($sql);
			// $stmt->execute();

			// $result = $stmt->fetchAll();



			// echo '<table style="border-collapse: collapse">';
			// foreach($result as $key => $row) //fiecare row contine:
			// {
			// 		echo "
			// 		<tr style=\"border: 1px solid black\">
			// 			<td style=\"border: 1px solid black\">$row[ST_ID]
			// 			</td>
			// 			<td style=\"border: 1px solid black\">$row[ST_TITLE]
			// 			</td>
			// 			<td style=\"border: 1px solid black\">$row[ST_CONTENT]
			// 			</td>
			// 			<td style=\"border: 1px solid black\">$row[ST_COVER]
			// 			</td>
			// 			<td style=\"border: 1px solid black\">$row[ST_DATE_ADDED]
			// 			</td>
			// 		</tr>
			// 		";
			// }
			// echo '</table>';
			
			//load a few views and pass some data for them to show to the user.
			//$this->view('home/index', ['name' => $user->name]);
			//$this->view('home/view2', ['whatAmI' => 'home/view2']);
		}
	}

 ?>