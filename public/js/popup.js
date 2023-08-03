var signInModal = document.getElementById("sign-in-modal");
var signUpModal = document.getElementById("sign-up-modal");
var signInButton = document.getElementById("sign-in-button");
var signUpButton = document.getElementById("sign-up-button");

signInButton.onclick = function() {
   signInModal.style.display = "block";
}

signUpButton.onclick = function() {
    signUpModal.style.display = "block";
}

window.onclick = function(event) {
    if (event.target == signUpModal || event.target == signInModal) {
        signUpModal.style.display = "none";
        signInModal.style.display = "none";
    }
}