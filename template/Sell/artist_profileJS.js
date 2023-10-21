

// Get the file input and label elements
const profileUpload = document.getElementById('profile-upload');
const uploadLabel = document.getElementById('upload-label');

// Listen for file input changes
profileUpload.addEventListener('change', function () {
    if (this.files && this.files[0]) {
        // A file is selected, show the uploaded image
        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('profile-img').src = e.target.result;
            // Hide the upload label
            uploadLabel.classList.add('hide');

            // Perform the database update
            const file = profileUpload.files[0];
            const formData = new FormData();
            formData.append('profile-upload', file);

            // Create a new XMLHttpRequest object
            const xhr = new XMLHttpRequest();

            // Prepare the request
            xhr.open('POST', 'artistProfile.php', true);

            // Set up the data to send
            xhr.send(formData);

            // Handle the response
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Success - do something here if needed
                        console.log('Profile picture updated successfully');
                    } else {
                        // Error - do something here if needed
                        console.error('Error updating profile picture');
                    }
                }
            };
        };
        reader.readAsDataURL(this.files[0]);
    }
});

// Listen for clicks on the profile picture to trigger file input click
document.getElementById('profile-img').addEventListener('click', function () {
    profileUpload.click();
});
