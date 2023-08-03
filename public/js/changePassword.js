var changePasswordButton = document.getElementById("change-password-btn");
var passwordInput = document.getElementById("password");

changePasswordButton.onclick = function () {
    passwordInput.setAttribute('type','password');
}