$(document).ready(function() {
  
  $(".sidebar").tabs();

  $('#findMatch').click(function(){
    window.location.href = '../swipeFolder/index.html'; 
  });

  $(".deleteMentorButton").click(function() {
    if(confirm("Are you sure you want to unmatch with this mentor?")) {
      var mentorId = $(this).attr('id');
      console.log(mentorId);

      $.ajax({
        type: "POST",
        url: "resources/deleteMentor.php",
        data: {mentorId: mentorId},
        success: function(responseData, status){
          window.location.href = 'index.php';
        },
        error: function(msg) {
          // there was a problem
          alert(msg.status + " " + msg.statusText);
        }
      })
    }
  })

});

