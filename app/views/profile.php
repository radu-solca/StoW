<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>StoW // Profile</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,400italic,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Amatic+SC:700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" media="screen and (max-width:500px)" href="assets/css/style_mobile.css" />

	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
</head>
<body>

	<?php 
	require "../app/views/menu.php";
	?>

	<div class="flexWrap flex column">

		<div class="profile fullWidth flex center1 center2 first">
			<div class="guide960">
				<div class="margin20 flex center1 center2 column topBottom40">

					<div class="flex formContent column">

						<div id="firstHalf" class="flex row">
							<section>			
								<h1 class="title">Account</h1>

								<form action="" class="flex column center1 sectionContent" method="post">
									<div id="username">
										<span>Username</span>
										<?php 
											echo "<span class=\"viewOnly\">".$_SESSION["userData"]['USERNAME']."</span>";
		 								?>
									</div>
									<div id="email">
										<span>Email</span>
										<?php 
											echo "<span class=\"viewOnly\">".$_SESSION["userData"]['EMAIL']."</span>";
		 								?>
									</div>
									<div id="name">
										<span>Name</span>
										<?php 
											echo "<span class=\"viewOnly\">".$_SESSION["userData"]['NAME']."</span>";
		 								?>
									</div>
									<div id="surname">
										<span>Surname</span>
										<?php 
											echo "<span class=\"viewOnly\">".$_SESSION["userData"]['SURNAME']."</span>";
		 								?>
								</form>
							</section>	

							<hr class="vertical">	

							<section>	
								<h1 class="title">Bookmarks</h1>

								<form action="" class="flex column center1" method="post">
									Lorem ipsum dolor sit amet, timeam oporteat duo ad, eum id audiam erroribus. Duo prima laoreet ei, ut has autem malorum. Ius eu prima etiam vocibus, cum dolore sapientem id. In dicit scaevola mel, mea epicurei erroribus instructior te.
								</form>
							</section>	
						</div>

						<hr>

						<div id="secondHalf" class="flex row">
							<section>
							<h1 class="title">Favorites</h1>

							<form action="" class="flex column center1" method="post">
								Assum civibus at pri, te rebum persecuti eum, mel cu assentior consetetur disputationi. Detracto assentior eloquentiam ei vel, mea id nemore dolorem. An summo dicit eam, nostrum iracundia at per. Duo choro referrentur no. Ea sed denique conceptam, no eum lorem numquam utroque. His ad erant adolescens. Ornatus interpretaris ne est, facete eirmod te eos.
							</form>
							</section>

							<hr class="vertical">	
						
							<section>
							<h1 class="title">Ratings</h1>

							<form action="" class="flex column center1" method="post">
								Omnis viderer constituto eum ad, ei omnium regione has, ea sed rebum harum. Nec vocibus delicatissimi ad, pro eu nisl accommodare interpretaris, tantas nostrud no nec. Mel ad zril tollit, mei an audiam neglegentur, mei ea viris vocibus explicari. Eos cu suas veri referrentur, ut scripta accumsan pri, ius in dicat partem intellegat.
							</form>
							</section>

							<hr class="vertical">	

							<section>
							<h1 class="title">Comments</h1>

							<form action="" class="flex column center1" method="post">
								Alia nostrud tractatos eos et, no brute consul eam. Solet volumus senserit te eam, cu rebum doming quo. Graece suscipiantur pro id, mea id nihil facilisis, vocibus abhorreant sea ei. At putant aperiri est, vix lorem signiferumque in, has odio scribentur et.
							</form>
							</section>
						</div>

					</div>

				</div>
			</div>
		</div>


		<?php 
		require "../app/views/footer.php";
		?>

	</div>


	<script src="assets/js/global.js"></script>

	<script src="assets/js/nav.js"></script>

	<script src="assets/js/profile.js"></script>

</body>
</html>