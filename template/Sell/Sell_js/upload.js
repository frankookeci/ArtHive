const profileImage = document.getElementById('profileImage');
const imageUpload = document.getElementById('imageUpload');
console.log("hahahahaha");
profileImage.addEventListener('click', function() {
  imageUpload.click();
});

imageUpload.addEventListener('change', function(e) {
  const file = e.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function(e) {
      profileImage.src = e.target.result;
    }
    reader.readAsDataURL(file);
  }
});
