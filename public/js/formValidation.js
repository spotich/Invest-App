(function () {
    'use strict'

    let forms = document.querySelectorAll('.needs-validation');
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                let repeatPassword = document.getElementById("repeatPassword");
                if (document.getElementById("password").value && repeatPassword.value !== document.getElementById("password").value) {
                    repeatPassword.setCustomValidity("Passwords do not match");
                } else {
                    repeatPassword.setCustomValidity("");
                }

                form.classList.add('was-validated')
            }, false)
        })
})()



