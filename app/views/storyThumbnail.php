<?php 

echo "
			<div class=\"storyThumbnail\">
				<div class=\"container\">
					<a href=\"storyRead/". $story['ID'] . "\" >
						<div class=\"overlay\">
							<div class=\"title\">".$story['TITLE']."</div>
							<div class=\"authors\">".$story['AUTHORS']."</div>
							<div class=\"rating\">";
								require "../app/views/rating.php";
							echo "
							</div>
						</div>
						<img class=\"storyCover\" alt=\"story cover\" src=\"";
							$cover = isset($story['COVER']) 
							?
								file_exists ($story['COVER'])
								?
								App::makeAbsolute($story['COVER'])
								:
								App::makeAbsolute("assets/img/nocover.png")
							:
							App::makeAbsolute("assets/img/nocover.png");
							echo $cover;
						echo"\">
					</a>
				</div>
			</div>
		";

 ?>