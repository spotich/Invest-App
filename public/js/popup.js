let paymentModal = document.getElementById("payment");
// let paymentButton = document.getElementById("payment-button");
let paymentButtons = document.getElementsByClassName("payment-button");

for (let i = 0; i < paymentButtons.length; i++) {
    paymentButtons[i].onclick = function () {
        paymentModal.style.display = "block";
    }

}

window.onclick = function(event) {
    if (event.target === paymentModal) {
        paymentModal.style.display = "none";
    }
}