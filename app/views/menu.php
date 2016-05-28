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
							<div class="userExt">
								<div class="content">
									ayylmao pass the border cocaina
								</div>
							</div>
						</div>

						<?php 
						echo "<div data-attr=\"Welcome, ";
						echo isset($_SESSION['userData'])?$_SESSION['userData']['USERNAME']:"visitor";
						echo "\" class=\"iconic user\">";
						?>
							<div class="userExt">
								<div class="content">
									<?php ?>
									
									if(isset($_SESSION['userData'])?$_SESSION['userData'])

									<a href="home" class="iconic home"></a>
									<a href="browse" class="iconic book"></a>
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

