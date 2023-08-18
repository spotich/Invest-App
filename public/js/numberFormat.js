document.querySelectorAll(".num").forEach(function (number) {
    number.innerHTML = parseFloat(number.innerHTML).toLocaleString('en');
});