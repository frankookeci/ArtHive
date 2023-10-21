//Artist

const registerButton2 = document.getElementById("register2");
const loginButton2 = document.getElementById("login2");

const popup2 = document.getElementById("popup2");

registerButton2.addEventListener("click", () => {
    popup2.classList.add("right-panel-active");
});

loginButton2.addEventListener("click", () => {
    popup2.classList.remove("right-panel-active");
});
