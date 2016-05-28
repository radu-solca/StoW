	<nav class="fullWidth fixedTop flex center1 center2">
		<div class="navDeco fullWidth fixedTop flex center1 center2"></div>
		<div class="guide960">
			<div class="margin20">

				<div id="navContent" class="flex center1 spaceBetween" >
					<div id="left" class="flex centerV flexStart">
						<a href="" class="iconic home"></a>
						<a href="" class="iconic book"></a>
						<a href="" class="iconic upload"></a>
					</div>
					<div id="right" class="flex centerV flexEnd">
						<a href="" class="iconic magnifying_glass"></a>
						<?php 
						echo "<a href=\"#\" data-attr=\"Welcome, ";
						echo isset($_SESSION['userData'])?$_SESSION['userData']['USERNAME']:"visitor";
						echo "\" class=\"iconic user\"></a>";
						?>
					</div>
				</div>

				<div id="navContentMobile" class="flex center1 spaceBetween">
						<a href="" class="iconic home"></a>
						<a href="" class="iconic book"></a>
						<a href="" class="iconic upload"></a>
						<a href="" class="iconic magnifying_glass"></a>
						<a href="" class="iconic user"></a>					
				</div>

			</div>
		</div>
	</nav>

