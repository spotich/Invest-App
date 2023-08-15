let paymentModal = document.getElementById("payment");
let paymentButton = document.getElementById("payment-button");

paymentButton.onclick = function () {
    paymentModal.style.display = "block";
}

window.onclick = function(event) {
    if (event.target === paymentModal) {
        paymentModal.style.display = "none";
    }
}