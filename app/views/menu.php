	<nav class="fullWidth fixedTop flex center1 center2">
		<div class="navDeco fullWidth fixedTop flex center1 center2"></div>
		<div class="guide960">
			<div class="margin20">

				<div id="navContent" class="flex center1 spaceBetween" >
					<div id="left" class="flex centerV flexStart">
						<a href="home" class="iconic home"></a>
						<a href="browse" class="iconic book"></a>
						<a href="upload" class="iconic upload"></a>
					</div>
					<div id="right" class="flex centerV flexEnd">
						<div class="iconic magnifying_glass">
							<div class="searchExt">
								<div class="content">
									ayylmao pass the border cocaina
								</div>
							</div>
						</div>

						<?php 
						echo "<div data-attr=\"";
						echo isset($_SESSION['userData'])
						?
						( isset($_SESSION['userData']['NAME']) ? $_SESSION['userData']['NAME'] : $_SESSION['userData']['USERNAME'] )
						:
						"Account";
						echo "\" class=\"iconic user\">";
						?>
							<div class="userExt">
								<div class="content">
									<?php 
									
									if(isset($_SESSION['userData'])){
										echo "
											<a href=\"profile\" class=\"profile\"></a>
											<a href=\"logout\" class=\"signOut\"></a>";
											if($_SESSION['userData']['ADMIN'] == 1){
												echo "
												<a href=\"admin\" class=\"admin\"></a>
												";
											}										
									}
									else
										echo "
											<a href=\"login\" class=\"signIn\"></a>
											<a href=\"register\" class=\"register\"></a>
										";

									?>									
								</div>
							</div>
						</div>
						
						
					</div>
				</div>

				<div id="navContentMobile" class="flex center1 spaceBetween">
						<a href="home" class="iconic home"></a>
						<a href="browse" class="iconic book"></a>
						<a href="upload" class="iconic upload"></a>
						<div class="iconic magnifying_glass">
							<div class="searchExt"></div>
						</div>
						
						<div class="iconic user">
							<div class="userExt"></div>	
						</div>	
									
				</div>

			</div>
		</div>
	</nav>

