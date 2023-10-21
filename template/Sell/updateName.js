// // Get the input fields and buttons
// var nameContainer1 = document.getElementById("nameContainer");
// var bioContainer1 = document.getElementById("bioContainer");
// var nameInput1 = document.getElementById("nameInput");
// var bioInput1 = document.getElementById("bioInput");
// var editBtn = document.getElementById("edit-profile-btn");
// var saveBtn = document.getElementById("save-profile-btn");

// // Add event listener to the edit button
// editBtn.addEventListener("click", function () {
//     // Hide the name and bio elements
//     nameContainer1.style.display = "block";
//     bioContainer1.style.display = "block";

//     // Show the input fields and save button
//     nameInput1.style.display = "none";
//     bioInput1.style.display = "none";
//     saveBtn.style.display = "none";
// });

// // Add event listener to the save button
// saveBtn.addEventListener("click", function () {
//     // Get the values from the input fields
//     var name = nameInput1.value;
//     var bio = bioInput1.value;

//     // Create a new XMLHttpRequest object
//     var xhr = new XMLHttpRequest();

//     // Prepare the request
//     xhr.open("POST", "update_profile.php", true);
//     xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

//     // Set up the data to send
//     var data = "name=" + encodeURIComponent(name) + "&bio=" + encodeURIComponent(bio);

//     // Send the request
//     xhr.send(data);

//     // Handle the response
//     xhr.onreadystatechange = function () {
//         if (xhr.readyState === XMLHttpRequest.DONE) {
//             if (xhr.status === 200) {
//                 // Success - do something here if needed
//                 // For example, display a success message
//                 console.log("Profile updated successfully");

//                 // Hide the input fields and save button
//                 nameInput1.style.display = "none";
//                 bioInput1.style.display = "none";
//                 saveBtn.style.display = "none";

//                 // Show the name and bio elements with updated values
//                 nameContainer1.style.display = "block";
//                 bioContainer1.style.display = "block";
//                 document.getElementById("artistName").textContent = name;
//                 document.getElementById("bioText").textContent = bio;
//             } else {
//                 // Error - do something here if needed
//                 // For example, display an error message
//                 console.error("Error updating profile");
//             }
//         }
//     };
// });
