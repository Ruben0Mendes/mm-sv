document.addEventListener("DOMContentLoaded", function() {
    // Get all the page links
    const pageLinks = document.querySelectorAll('.page-link');
  
    // Get the current URL (or you can use a variable for the current page number)
    const currentUrl = window.location.href;
  
    // Loop through each link and check if it matches the current page URL
    pageLinks.forEach(link => {
        if (currentUrl.includes(link.getAttribute('href'))) {
            link.classList.add('active'); // Add the 'active' class to the link
        }
    });
});
