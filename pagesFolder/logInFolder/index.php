<!DOCTYPE html>
<html lang="en">

<head>
   <title>Log in</title>
   <meta charset="UTF-8" />
   <link href="logInResources/logInStyle.css" rel="stylesheet" type="text/css" />
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script type="text/javascript" src="logInResources/logIn.js"></script>

</head>


<body style="background-image: url('logInResources/background.png'); background-size: cover;">

	<!--Responsible for alerting user if username and/or password are invalid -->
	<script>
		<?php
		session_start();
		if(isset($_SESSION['alert'])){
			echo 'alert("' . $_SESSION['alert'] . '");';
			unset($_SESSION['alert']); 
		}
		?>
	</script>

	<!--Creates a login form -->
	<div id="bodyBlock">
		<!--When user clicks submit, js function for validation/setting active user gets called -->
		<form onsubmit="submitForm()" style="border:1px solid #ccc; background-color: white;">
			<div class="container">
				<img id="homeButtonImg" src="../../resources/mentorMatchLogo.png" width=400px alt="Ohm symbol" style="background-color: rgb(12, 12, 12);">
				<h2>Log In</h2>
				<p>Please fill in this form to login to your account.</p>
				<hr>
		
				<label for="emailId"><b>Email</b></label>
				<input type="text" placeholder="Enter Email" id="emailId" name="email" required>
		
				<label for="pwdId"><b>Password</b></label>
				<input type="password" placeholder="Enter Password" id="pwdId" name="psw" required>
		
				<label>
						<input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
				</label>

				<p>Don't have an account? <a href="../signUpFolder/index.php">Create one</a></p>

				<div class="clearfix">
						<button type="button" id="cancel" class="cancelbtn">Cancel</button>
						<button type="submit" id="login" class="signupbtn">Log In</button>
				</div>
			</div>
		</form>
	</div>
</body>