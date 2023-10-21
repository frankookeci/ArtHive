//update the text when the buttons are clicked
const nameInput = document.getElementById("nameInput");
const saveButton = document.getElementById("save-profile-btn");
const artistName = document.getElementById("artistName");

saveButton.addEventListener("click", () => {
    const name = nameInput.value;
    artistName.textContent = name;
});

const bioInput = document.getElementById("bioInput");
const bioText = document.getElementById("bioText");

saveButton.addEventListener("click", () => {
    const name = nameInput.value;
    artistName.textContent = name;
});


//appear and disappear the forms
const editProfileBtn = document.getElementById('edit-profile-btn');
const saveProfileBtn = document.getElementById('save-profile-btn');
const nameContainer = document.getElementById('nameContainer');
const bioContainer = document.getElementById('bioContainer');





editProfileBtn.addEventListener('click', () => {
    artistName.style.display = 'none';
    bioText.style.display = 'none';
    editProfileBtn.style.display = 'none';

    nameContainer.style.display = 'block';
    bioContainer.style.display = 'block';
    saveProfileBtn.style.display = 'block';
});

saveProfileBtn.addEventListener('click', () => {
    const nameInput = document.getElementById('nameInput');
    const bioInput = document.getElementById('bioInput');

    artistName.textContent = nameInput.value;
    bioText.textContent = bioInput.value;

    nameContainer.style.display = 'none';
    bioContainer.style.display = 'none';
    saveProfileBtn.style.display = 'none';

    artistName.style.display = 'block';
    bioText.style.display = 'block';
    editProfileBtn.style.display = 'block';
});

// Add event listener to the edit button
editProfileBtn.addEventListener("click", function () {
    // Hide the name and bio elements
    artistName.style.display = "none";
    bioText.style.display = "none";

    // Show the input fields and save button
    nameContainer.style.display = "block";
    bioContainer.style.display = "block";
    saveProfileBtn.style.display = "block";

    // Set the input values to the current artist name and bio
    nameInput.value = artistName.textContent;
    bioInput.value = bioText.textContent;
});

// Add event listener to the save button
saveProfileBtn.addEventListener("click", function () {
    // Get the values from the input fields
    var name = nameInput.value;
    var bio = bioInput.value;

    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Prepare the request
    xhr.open("POST", "update_name.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    // Set up the data to send
    var data = "name=" + encodeURIComponent(name) + "&bio=" + encodeURIComponent(bio);

    // Send the request
    xhr.send(data);

    // Handle the response
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Success - do something here if needed
                // For example, display a success message
                console.log("Profile updated successfully");

                // Hide the input fields and save button
                nameContainer.style.display = "none";
                bioContainer.style.display = "none";
                saveProfileBtn.style.display = "none";

                // Show the name and bio elements with updated values
                artistName.style.display = "block";
                bioText.style.display = "block";
                artistName.textContent = name;
                bioText.textContent = bio;
            } else {
                // Error - do something here if needed
                // For example, display an error message
                console.error("Error updating profile");
            }
        }
    };
});