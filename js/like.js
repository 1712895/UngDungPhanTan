$(".heart").click(function () {
    $(this).toggleClass("red");
});




/*
// check for saved 'darkMode' in localStorage
let like = localStorage.getItem('red'); 

const likeToggle = $(this).querySelector('heart');

const like = () => {
  // 1. Add the class to the body
  $(this).toggleClass("red");
  // 2. Update darkMode in localStorage
  localStorage.setItem('red', 'enabled');
}

const unlike = () => {
  // 1. Remove the class from the body
  $(this).toggleClass("heart");
  // 2. Update darkMode in localStorage 
  localStorage.setItem('red', null);
}
 
// If the user already visited and enabled darkMode
// start things off with it on
if (like === 'enabled') {
  like();
}

// When someone clicks the button
likeToggle.addEventListener('click', () => {
  // get their darkMode setting
  like = localStorage.getItem('red'); 
  
  // if it not current enabled, enable it
  if (like !== 'enabled') {
    like();
  // if it has been enabled, turn it off  
  } else {  
    unlike(); 
  }
});*/