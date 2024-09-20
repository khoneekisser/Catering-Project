    var togglePasswordButton = document.getElementById("togglePassword");
    var togglePasswordConfirmButton = document.getElementById("c_togglePassword");
    var passwordInput = document.getElementById("password");
    var confirmPassword = document.getElementById('c_password');
    var form = document.querySelector('form');

    togglePasswordButton.addEventListener("click", function() {
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            togglePasswordButton.innerHTML = '<i class="fas fa-eye"></i>';
        } else {
            passwordInput.type = "password";
            togglePasswordButton.innerHTML = '<i class="fas fa-eye-slash"></i>';
        }
    });

    togglePasswordConfirmButton.addEventListener("click", function() {
        if (confirmPassword.type === "password") {
            confirmPassword.type = "text";
            togglePasswordConfirmButton.innerHTML = '<i class="fas fa-eye"></i>';
        } else {
            confirmPassword.type = "password";
            togglePasswordConfirmButton.innerHTML = '<i class="fas fa-eye-slash"></i>';
        }
    });

    // Validate that passwords match
    form.addEventListener('submit', (e) => {
        if (passwordInput.value !== confirmPassword.value) {
            e.preventDefault();
            alert('Passwords does not match!');
        }
    });

    