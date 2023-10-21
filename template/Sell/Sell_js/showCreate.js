function toggleSection(activeLink, section) {
    const links = document.querySelectorAll('.artist-navBar a');
    links.forEach(function (link) {
        link.classList.remove('active');
    });
    if (activeLink && activeLink.classList) {
        activeLink.classList.add('active');
    }
    console.log("bc");
    const sections = document.querySelectorAll('.section');
    sections.forEach(function (section) {
        section.style.display = 'none';
    });
    if (section && section.style) {
        section.style.display = 'block';
    }
}



document.addEventListener('DOMContentLoaded', function () {
    const artworksLink = document.getElementById('artworksLink');
    const createLink = document.getElementById('createLink');
    const profitLink = document.getElementById('profitLink');
    const logoutLink = document.getElementById('logoutLink');
    const createSection = document.getElementById('createSection');
    const artworksSection = document.getElementById('artworksSection');
    const profitSection = document.getElementById('profitSection');
    const logoutSection = document.getElementById('logoutSection');

    artworksLink.classList.add('active');
    createSection.style.display = 'none';
    profitSection.style.display = 'none';
    logoutSection.style.display = 'none';

    createLink.addEventListener('click', function (event) {
        event.preventDefault();
        toggleSection(createLink, createSection); // Pass the element itself as activeLink
        console.log("Eriiiiiiiiiaaaaaaa");
    });

    artworksLink.addEventListener('click', function (event) {
        event.preventDefault();
        toggleSection(artworksLink, artworksSection); // Pass the element itself as activeLink
        console.log("ErA");
    });

    profitLink.addEventListener('click', function (event) {
        event.preventDefault();
        toggleSection(profitLink, profitSection); // Pass the element itself as activeLink
        console.log("ErAAAA");
    });

    logoutLink.addEventListener('click', function (event) {
        event.preventDefault();
        toggleSection(this, logoutSection); // Pass the element itself as activeLink
    });
});




//when clicking the get-started-btn
// document.addEventListener('DOMContentLoaded', function () {
//     // ...

//     const getStartedButton = document.getElementById('get-started-btn');

//     getStartedButton.addEventListener('click', function (event) {
//         event.preventDefault();
//         toggleSection(createLink, createSection);
//     });

//     // ...
// });










//to handle the form submission and send the artwork attributes to the PHP file

document.addEventListener('DOMContentLoaded', function () {
    const saveButton = document.getElementById('sell_save-button');
    console.log("SAVEEEEEE");
    saveButton.addEventListener('click', function () {
        // Get the artwork attributes from the form inputs
        const title = document.getElementById('sell-title').value;
        const category = document.getElementById('sell-category').value;
        const description = document.getElementById('sell-description').value;
        const price = document.getElementById('sell_price').value;
        const image = document.getElementById('imageUpload').files[0];

        // Create a FormData object to send the data as a multipart/form-data request
        const formData = new FormData();
        formData.append('title', title);
        formData.append('category', category);
        formData.append('description', description);
        formData.append('price', price);
        formData.append('image', image);

        // Send the artwork attributes to the PHP file using AJAX
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'save_artwork.php');
        xhr.onload = function () {
            if (xhr.status === 200) {
                // Handle the response from the PHP file
                console.log(xhr.responseText);
                // Reset the form or perform any other necessary actions
            } else {
                // Handle the error
                console.error('Error:', xhr.status);
            }
        };
        xhr.send(formData);
    });
});
