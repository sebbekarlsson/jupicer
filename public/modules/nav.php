<nav id="top-nav">
	<div class="left">
		<ul>
			<li><img src="images/jupicter.png" id="brand-image"></li>
			<li><a class="navbtn" href="index.php" id="brand">Jupicer</a></li>

			<form method="get" style="display:inline;">
				<li><input type="text" id="search-input" name="folder" placeholder="Search"></li>
			</form>
		</ul>
	</div>
	<div class="right">
		<ul>
			<?php if(!is_loggedin()){ ?>
			<li><a class="navbtn" href="index.php?doc=login.php">Login</a></li>
			<li><a class="navbtn" href="index.php?doc=register.php">Register</a></li>
			<?php }else{ ?>
			<li><a class="navbtn" href="index.php?doc=upload.php">Upload</a></li>
			<li><a class="navbtn" href="index.php?doc=logout.php">Logout</a></li>
			<?php } ?>
		</ul>
	</div>
</nav>