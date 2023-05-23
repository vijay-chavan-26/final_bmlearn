
const navMenuBars = document.querySelector('.fa-bars')
const navMenuCross = document.querySelector('.fa-xmark')
const navIcons = document.querySelector('.nav-icons')
const navMenu = document.querySelector('.nav-menu')

// for toggling navbar icons on click
navIcons.addEventListener("click", (e)=>{
    if(e.target === navMenuBars){
        navMenuBars.classList.remove('d-block')
        navMenuBars.classList.add('d-none')
        navMenuCross.classList.remove('d-none')
        navMenuCross.classList.remove('d-block')
        navMenu.classList.add('active-nav')
    }
})

// for closing navigation menu box on clicking outside of it and on clicking cross icon
document.addEventListener('click', (e)=>{
    if(e.target !== navMenu && e.target !== navMenuBars){
        navMenuCross.classList.remove('d-block')
        navMenuCross.classList.add('d-none')
        navMenuBars.classList.remove('d-none')
        navMenuBars.classList.remove('d-block')
        navMenu.classList.remove('active-nav')
    }
})


// for changing color of active link
const links = document.querySelectorAll('nav .nav-menu a');
const currentUrl = window.location.href;
// console.log(currentUrl)
links.forEach(link => {
  if (link.href === currentUrl){
    link.classList.remove('nav-color');
    link.classList.add('theme-color');
  } 
});