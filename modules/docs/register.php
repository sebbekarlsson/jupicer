<title>Register</title>
<div class="content-bg" style="background-image:url(images/searain.gif);">
	<span>
		<form method="post">
			<h1>Register</h1>
			<input class="intext struct" type="text" name="reg_username" placeholder="Username">
			<input class="intext struct" type="email" name="reg_email" placeholder="Email">
			<input class="intext struct" type="password" name="reg_pass" placeholder="Password">
			<input class="intext struct" type="password" name="reg_passconfirm" placeholder="Confirm Password">
			<input class="struct btn" type="submit" name="reg_register" value="Register">
			<?php

			if(isset($_POST['reg_register'])){
				$user = new User(0);
				$user->username = $_POST['reg_username'];
				$user->email = $_POST['reg_email'];
				$user->password = $_POST['reg_pass'];

				if(strlen($user->username) < 3){
					echo "<p>Enter a valid username</p>";
					return;
				}
				else if(strlen($user->email) < 3){
					echo "<p>Enter a valid email</p>";
					return;
				}
				else if(strlen($user->password) < 3){
					echo "<p>Enter a valid password</p>";
					return;
				}

				if(user_email_exists($user->email)){
					echo "<p>An account connected to this email has already been created!</p>";
					return;
				}

				if(user_name_exists($user->username)){
					echo "<p>An account with this username has already been created!</p>";
					return;
				}

				if($user->password != $_POST['reg_passconfirm']){
					echo "<p>Passwords does not match!</p>";
					return;
				}

				$user->register();
				echo "<p>Registration complete!</p>";
			}

		?>
		</form>
	</span>
</div>