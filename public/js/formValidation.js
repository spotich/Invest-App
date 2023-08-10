(function () {
    'use strict'

    let forms = document.querySelectorAll('.needs-validation');
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity() || (!comparePassword() && document.getElementById("repeatPassword") !== null)) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
})()

function comparePassword() {
    if (document.getElementById('password').value !== '' && document.getElementById('repeatPassword').value !== '') {
        if (document.getElementById('password').value === document.getElementById('repeatPassword').value) {
            document.getElementById('repeatPassword').setCustomValidity("");
            return true;
        } else {
            document.getElementById('repeatPassword').setCustomValidity("Passwords do not match");
            return false;
        }
    }
}