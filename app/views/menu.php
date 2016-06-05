	<nav class="fullWidth fixedTop flex center1 center2">
		<div class="navDeco fullWidth fixedTop flex center1 center2"></div>
		<div class="guide960">
			<div class="margin20">

				<div id="navContent" class="flex center1 spaceBetween" >
					<div id="left" class="flex centerV flexStart">
						<a href="<?php echo App::makeAbsolute("home"); ?>" class="iconic home"></a>
						<a href="<?php echo App::makeAbsolute("browse"); ?>" class="iconic book"></a>
						<a href="<?php echo App::makeAbsolute("upload"); ?>" class="iconic upload"></a>
					</div>
					<div id="right" class="flex centerV flexEnd">

						<form id="searchBar" class="flex row center1" action="<?php echo App::makeAbsolute("browse"); ?>" method="post">
							<input id="searchBarInput" name="searchBarInput" type="text" placeholder="Search">
							<button class="iconic magnifying_glass"></button>
						</form>

						<?php 
						echo "<div data-attr=\"";
						echo isset($_SESSION['userData'])
						?
						( isset($_SESSION['userData']['NAME']) ? $_SESSION['userData']['NAME'] : $_SESSION['userData']['USERNAME'] )
						:
						"Account";
						echo "\" class=\"iconic user multi\">";
						?>
							<div class="userExt">
								<div class="content">
									<?php 
									
									if(isset($_SESSION['userData'])){
										echo "
											<a href=\"".App::makeAbsolute("profile")."\" class=\"profile\"></a>";

										if($_SESSION['userData']['ADMIN'] == 1){
												echo "
												<a href=\"".App::makeAbsolute("admin")."\" class=\"admin\"></a>
												";
											}	

										echo "
											<a href=\"".App::makeAbsolute("logout")."\" class=\"signOut\"></a>";									
									}
									else
										echo "
											<a href=\"".App::makeAbsolute("login")."\" class=\"signIn\"></a>
											<a href=\"".App::makeAbsolute("register")."\" class=\"register\"></a>
										";

									?>									
								</div>
							</div>
						</div>
						
						
					</div>
				</div>

				<!-- ==================== MOBILE ======================= -->

				<div id="navContentMobile" class="flex center1 spaceBetween">
						<a href="<?php echo App::makeAbsolute("home"); ?>" class="iconic home"></a>
						<a href="<?php echo App::makeAbsolute("browse"); ?>" class="iconic book"></a>
						<a href="<?php echo App::makeAbsolute("upload"); ?>" class="iconic upload"></a>
						<div class="iconic magnifying_glass multi">
							<div class="searchExt">
								<div class="content flex row">
									<form id="searchBar" action="browse" method="post" class="flex row">
										<input id="searchBarInput" name="searchBarInput" type="text" placeholder="Search">
										<input type="submit" value="GO">
									</form>
								</div>
							</div>
						</div>
						
						<div class="iconic user multi">
							<div class="userExt">
								<div class="content">
									
									<?php 

									echo isset($_SESSION['userData'])
									?
									(	
										"<span>".

									 	(
											isset($_SESSION['userData']['NAME']) 
											?
											$_SESSION['userData']['NAME'] 
											:
											$_SESSION['userData']['USERNAME'] 
										)

										."</span>
										<hr>
										"

									)
									:
									"";


									
									if(isset($_SESSION['userData'])){
										echo "
											<a href=\"".App::makeAbsolute("profile")."\" class=\"profile\"></a>";

										if($_SESSION['userData']['ADMIN'] == 1){
												echo "
												<a href=\"".App::makeAbsolute("admin")."\" class=\"admin\"></a>
												";
											}	

										echo "
											<a href=\"".App::makeAbsolute("logout")."\" class=\"signOut\"></a>";											
									}
									else
										echo "
											<a href=\"".App::makeAbsolute("login")."\" class=\"signIn\"></a>
											<a href=\"".App::makeAbsolute("register")."\" class=\"register\"></a>
										";

									?>									
								</div>
							</div>
						</div>	
									
				</div>

			</div>
		</div>
	</nav>

	<script src="<?php echo App::makeAbsolute("assets/js/nav.js"); ?>"></script>

