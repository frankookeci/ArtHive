// Smooth scrolling function
function smoothScroll(targetId) {
    const targetElement = document.getElementById(targetId);
    if (targetElement) {
      const targetOffset = targetElement.getBoundingClientRect().top;
      const windowHeight = window.innerHeight;
      const scrollToPosition = targetOffset + window.pageYOffset - (windowHeight / 10);
      window.scrollTo({
        top: scrollToPosition,
        behavior: 'smooth'
      });
    }
  }
  

  // Event listeners for smooth scrolling
  document.addEventListener('DOMContentLoaded', function() {
    const homeLink = document.querySelector('.homeHover a');
    homeLink.addEventListener('click', function(event) {
      event.preventDefault();
      smoothScroll('home_area');
    });

    const aboutLink = document.querySelector('.aboutHover a');
    aboutLink.addEventListener('click', function(event) {
      event.preventDefault();
      smoothScroll('about_area');
    });

    const catalogLink = document.querySelector('.catalogeHover a');
    catalogLink.addEventListener('click', function(event) {
      event.preventDefault();
      smoothScroll('catalog_area');
    });

    const contact = document.querySelector('.contactHover a');
      contact.addEventListener('click', function(event) {
      event.preventDefault();
      smoothScroll('contact_area');
    });
  });


 
  document.addEventListener('DOMContentLoaded', function() {
    var links = document.querySelectorAll('.navDiv a');
  
    links.forEach(function(link) {
      link.addEventListener('click', function(e) {
        e.preventDefault();
        links.forEach(function(link) {
          link.classList.remove('clicked');
        });
        this.classList.add('clicked');
      });
    });
  });
  
  
  
  