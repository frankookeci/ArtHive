//Customer

const registerButton = document.getElementById("register");
const loginButton = document.getElementById("login");

const popup = document.getElementById("popup");

registerButton.addEventListener("click", () => {
    popup.classList.add("right-panel-active");
});

loginButton.addEventListener("click", () => {
    popup.classList.remove("right-panel-active");
});


