let changePasswordButton = document.getElementById("change-password-btn");
let oldPasswordInput = document.getElementById("oldPassword");
let passwordInput = document.getElementById("password");
let repeatPasswordInput = document.getElementById("repeatPassword");

changePasswordButton.onclick = function () {
    oldPasswordInput.setAttribute('type','password');
    passwordInput.setAttribute('type','password');
    repeatPasswordInput.setAttribute('type','password');
    changePasswordButton.style.display = 'none';
}