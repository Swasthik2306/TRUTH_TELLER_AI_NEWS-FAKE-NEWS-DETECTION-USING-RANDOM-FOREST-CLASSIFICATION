// Create a GSAP animation to fade out the loading page
gsap.to(".loading-page", {
  opacity: 0,
  duration: 5, // Adjust the duration as needed
  onComplete: function () {
    // After the fade-out animation is complete, navigate to the login page
    window.location.href = 'login.php'; // Replace 'login.php' with the actual URL of your login page
  },
});

// Create a GSAP animation to fade in the logo and name
gsap.fromTo(
  ".logo-name",
  {
    y: 50,
    opacity: 0,
  },
  {
    y: 0,
    opacity: 1,
    duration: 1, // Adjust the duration as needed
    delay: 0.5,
  }
);

