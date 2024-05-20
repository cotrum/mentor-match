// select DOM elements (swiper, like, and dislike)
const swiper = document.querySelector('#swiper'); 
const like = document.querySelector('#like'); 
const dislike = document.querySelector('#dislike');

// initialize variables
let cardCount = 0; // counter for the number of cards appended

// when the document is ready, dynamically add the cards
$(document).ready(function() {
  // AJAX request to fetch JSON data
  $.ajax({
    type: "GET",
    url: "swipeResources/cards.json",
    dataType: "json",
    success: function(responseData) {
      // loop through each item in the JSON data
      responseData.menuItem.forEach(function(item) {
          appendNewCard(item.link, item.id); // append a new card with the specified image URL
      });
    },
    error: function(msg) {
      // handle error response
      console.error("Error fetching JSON data:", msg); 
      alert("There was a problem: " + msg.status + " " + msg.statusText); // show an alert with the error status and message
    }
  });
});

// function to append a new card to the swiper container
function appendNewCard(imageUrl, id) {
  // create a new Card instance with the specified image URL and event handlers
  const card = new Card({
    imageUrl: imageUrl, // set the image URL of the card
    id: id,
    onDismiss: appendNewCard, // event handler for card dismissal
    // when like
    onLike: () => {
      like.style.animationPlayState = 'running'; // start the animation for the like button
      like.classList.toggle('trigger'); // toggle the 'trigger' class for animation effect
      //sends imageUrl data to validation.php to update which tutors user matches with
      $.ajax({
        type: "POST",
        url: "swipeResources/validation.php",
        data: { imageUrl: imageUrl },
        success: function() {
          console.log("Liked card");
        },
        error: function(msg) {
          // handle error response
          console.error("Error fetching JSON data:", msg); 
          alert("There was a problem: " + msg.status + " " + msg.statusText); // show an alert with the error status and message
        }
      });
    },
    // when dislike
    onDislike: () => {
      dislike.style.animationPlayState = 'running'; // start the animation for the dislike button
      dislike.classList.toggle('trigger'); // toggle the 'trigger' class for animation effect
    }
  });
  if(cardCount < 16) {
    swiper.append(card.element); // append the card element to the swiper container
  }
  cardCount++; // increment the card count

  // adjust the position of each card in the swiper container
  const cards = swiper.querySelectorAll('.card:not(.dismissing)');
  cards.forEach((card, index) => {
    card.style.setProperty('--i', index);
  });
}
//make logo go to home
var home = document.getElementById('homeButtonImg');
home.addEventListener('click', function(){
    window.location.href = '../preferencesFolder/index.php';
})

//add sparkle to the page
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

