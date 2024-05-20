
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
	if (event.target == modal) {
		modal.style.display = "none";
	}
}

//make the cancel button link back to home page and errorcheck with signup
$(document).ready(function () {
	$('#cancel').click(function(){
		window.location.href = '../../index.html';
	});

	$('#signup').click(function(){
		var email = $("#email").val();
		var password = $("#psw").val();
		var password2 = $("#psw-repeat").val();

	if(email == '' || password == ''){
		alert("Please fill in all fields!");
		return false;
	}

	if(password != password2){
		alert("Passwords don't match!");
		return false;
	}

	$addUser = true;

	if($addUser == true){
		//sends email and password to addUser.php, and then sends user to index.php of the preferences page
		$.ajax({
			type: 'POST',
			url: 'signUpResources/addUser.php',
			data: { email: email, pwd: password },
			success: function(response) {
				window.location.href = '../preferencesFolder/index.php';
			},
			error: function(xhr, status, error) {
				console.error(error);
			}
		});
	}else{
		alert("Account is already a user!");
		return false;
	}
	
	return false;
	});
});