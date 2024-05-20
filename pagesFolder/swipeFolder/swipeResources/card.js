// card class
class Card {
  // constructor
  constructor({
    imageUrl,
    id,
    onDismiss,
    onLike,
    onDislike
  }) {
    // initialize properties
    this.imageUrl = imageUrl;
    this.onDismiss = onDismiss;
    this.onLike = onLike;
    this.onDislike = onDislike;
    // initialize card
    this.#init();
  }

  // private properties
  #startPoint;
  #offsetX;
  #offsetY;

  // check if the device is touch-enabled
  #isTouchDevice = () => {
    return (('ontouchstart' in window) ||
      (navigator.maxTouchPoints > 0) ||
      (navigator.msMaxTouchPoints > 0));
  }

  // initialize the card
  #init = () => {
    // create card element
    const card = document.createElement('div');
    card.classList.add('card');
    const img = document.createElement('img');
    img.src = this.imageUrl;
    card.append(img);
    // assign card element to instance
    this.element = card;
    // determine whether the device is touch activated or if you need to use a mouse 
    if (this.#isTouchDevice()) {
      this.#listenToTouchEvents();
    } else {
      this.#listenToMouseEvents();
    }
  }

  // add touch event listeners
  #listenToTouchEvents = () => {
    // touch start event listener
    this.element.addEventListener('touchstart', (e) => {
      const touch = e.changedTouches[0];
      if (!touch) return;
      const { clientX, clientY } = touch;
      this.#startPoint = { x: clientX, y: clientY }
      document.addEventListener('touchmove', this.#handleTouchMove);
      this.element.style.transition = 'transform 0s';
    });

    // touch end event listeners
    document.addEventListener('touchend', this.#handleTouchEnd);
    document.addEventListener('cancel', this.#handleTouchEnd);
  }

  // add mouse event listeners
  #listenToMouseEvents = () => {
    // mouse down event listener
    this.element.addEventListener('mousedown', (e) => {
      const { clientX, clientY } = e;
      this.#startPoint = { x: clientX, y: clientY }
      document.addEventListener('mousemove', this.#handleMouseMove);
      this.element.style.transition = 'transform 0s';
    });

    // mouse up event listener
    document.addEventListener('mouseup', this.#handleMoveUp);

    // prevent dragging of the card 
    this.element.addEventListener('dragstart', (e) => {
      e.preventDefault();
    });
  }

  // handle card movement based on mouse coordinates
  #handleMove = (x, y) => {
    this.#offsetX = x - this.#startPoint.x;
    this.#offsetY = y - this.#startPoint.y;
    const rotate = this.#offsetX * 0;
    this.element.style.transform = `translate(${this.#offsetX}px, ${this.#offsetY}px) rotate(${rotate}deg)`;
    // dismiss card if dragged enough
    if (Math.abs(this.#offsetX) > this.element.clientWidth * 0.7) {
     this.#dismiss(this.#offsetX > 0 ? 1 : -1);
    }
  }

  // mouse move event handler
  #handleMouseMove = (e) => {
    e.preventDefault();
    if (!this.#startPoint) return;
    const { clientX, clientY } = e;
    this.#handleMove(clientX, clientY);
  }

  // mouse up event handler
  #handleMoveUp = () => {
    this.#startPoint = null;
    document.removeEventListener('mousemove', this.#handleMouseMove);
    this.element.style.transform = '';
  }

  // handle card movement based on touch coordinates
  #handleTouchMove = (e) => {
    if (!this.#startPoint) return;
    const touch = e.changedTouches[0];
    if (!touch) return;
    const { clientX, clientY } = touch;
    this.#handleMove(clientX, clientY);
  }

  // touch end event handler
  #handleTouchEnd = () => {
    this.#startPoint = null;
    document.removeEventListener('touchmove', this.#handleTouchMove);
    this.element.style.transform = '';
  }

  // dismiss the card
  #dismiss = (direction) => {
    this.#startPoint = null;
    // remove all of the event listeners from the card
    document.removeEventListener('mouseup', this.#handleMoveUp);
    document.removeEventListener('mousemove', this.#handleMouseMove);
    document.removeEventListener('touchend', this.#handleTouchEnd);
    document.removeEventListener('touchmove', this.#handleTouchMove);
    this.element.style.transition = 'transform 1s';
    this.element.style.transform = `translate(${direction * window.innerWidth}px, ${this.#offsetY}px) rotate(${0 * direction}deg)`;
    this.element.classList.add('dismissing');
    // remove the card after transition
    setTimeout(() => {
      this.element.remove();
    }, 1000);
    // trigger dismissal, like, or dislike callbacks
    if (typeof this.onDismiss === 'function') {
      this.onDismiss();
    }
    if (typeof this.onLike === 'function' && direction === 1) {
      this.onLike();
    }
    if (typeof this.onDislike === 'function' && direction === -1) {
      this.onDislike();
    }
  }
}