<title>Login</title>
<div class="content-bg" style="background-image:url(images/searain.gif);">
	<span>
		<form method="post">
			<h1>Login</h1>
			<input class="intext struct" type="text" name="login_username" placeholder="Username">
			<input class="intext struct" type="password" name="login_pass" placeholder="Password">
			<input class="struct btn" type="submit" name="login_login" value="Login">
			<?php

			if(isset($_POST['login_login'])){
				$user = new User(0);
				$user->username = $_POST['login_username'];
				$user->password = $_POST['login_pass'];

				if(!user_name_exists($user->username)){
					echo "<p>This user is not registered!</p>";
					return;
				}

				if($user->login()){
					?>	
						<script>
							window.location.href="index.php";
						</script>
					<?php
				}else{
					echo "<p>Wrong password!</p>";
				}
			}

		?>
		</form>
	</span>
</div>