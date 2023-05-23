
const navLinks = document.querySelectorAll(".offcanvas nav .navbar-nav li a");

const currentUrl = window.location.href;
navLinks.forEach(link => {
  if (link.href === currentUrl){
    link.classList.add('bg-theme-color');
  } 
});
