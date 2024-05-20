$(document).ready(function () {
    //go to log in page when log in button clicked
    $('#logInButton').click(function(){
        window.location.href = 'pagesFolder/logInFolder/index.php';
    });

    $('#signUpButton').click(function(){
        window.location.href = 'pagesFolder/signUpFolder/index.php';
    });

    //create account button
    var create = document.getElementById('create');
    create.addEventListener('click', function(){
        window.location.href = 'pagesFolder/signUpFolder/index.php';
    })
    //make logo go to home
    var home = document.getElementById('homeButtonImg');
    home.addEventListener('click', function(){
        window.location.href = 'index.html';
    })

    //add background sparkle to page
    function createSparkle() {
        const sparkle = document.createElement('div');
        sparkle.className = 'sparkle';
        document.getElementById('sparkle-container').appendChild(sparkle);
      
        // Position randomly within the container
        sparkle.style.top = `${Math.random() * window.innerHeight}px`;
        sparkle.style.left = `${Math.random() * window.innerWidth}px`;
      
        // Remove sparkle after animation ends to keep DOM clean
        sparkle.addEventListener('animationend', () => {
          sparkle.parentNode.removeChild(sparkle);
        });
      
        // Create new sparkles periodically
        setTimeout(createSparkle, Math.random() * 1000);
      }
      
      // Start creating sparkles
      createSparkle();
      
});