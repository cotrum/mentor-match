<!DOCTYPE html>
<html lang="en">

<head>
   <title>Sign Up</title>
   <meta charset="UTF-8" />
   <link href="signUpResources/signUpStyle.css" rel="stylesheet" type="text/css" />
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script type="text/javascript" src="signUpResources/signUp.js"></script>
</head>


<body style="background-image: url('signUpResources/background.png'); background-size: cover;">
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

	<div id="bodyBlock">
		<form onsubmit="submitForm()" style="border:1px solid #ccc; background-color: white;">
			<div class="container">
				<img id="homeButtonImg" src="../../resources/mentorMatchLogo.png" width=400px alt="Ohm symbol" style="background-color: rgb(12, 12, 12);">
				<h2>Sign Up</h2>
				<p>Please fill in this form to create an account.</p>
				<hr>
		
				<label for="email"><b>Email</b></label>
				<input type="text" placeholder="Enter Email" id="email" name="email" required>
		
				<label for="psw"><b>Password</b></label>
				<input type="password" placeholder="Enter Password" id="psw" name="psw" required>
		
				<label for="psw-repeat"><b>Repeat Password</b></label>
				<input type="password" placeholder="Repeat Password" id="psw-repeat" name="psw-repeat" required>
		
				<label>
						<input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
				</label>
		
				<p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>
		
				<div class="clearfix">
						<button type="button" id="cancel" class="cancelbtn">Cancel</button>
						<button type="submit" id="signup" class="signupbtn">Sign Up</button>
				</div>
			</div>
		</form>
	</div>
</body>