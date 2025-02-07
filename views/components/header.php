<div class="container-fluid bg-light">
	<div class="row justify-content-center">
		<div class="col-lg-8">
			<nav class="navbar navbar-expand-lg navbar-light row justify-content-between bg-light">
				<a class="navbar-brand" href="/">Home</a>
				
				
				<div class="collapse navbar-collapse mr-5" id="navbarSupportedContent">
					<?php
						if (isLoggedIn()) {
							echo "<a class='btn' href='/reports'>Reports</a>
                                  <a href='/logout' class='btn'>
                                     Logout
                                  </a>";
						} else {
						
						}
					?>
				</div>
			</nav>
		</div>
	</div>
</div>
