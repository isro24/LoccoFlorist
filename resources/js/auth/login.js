document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".auto-dismiss-alert").forEach((alert) => {
        setTimeout(() => {
            alert.classList.add(
                "opacity-0",
                "transition-opacity",
                "duration-500"
            );
            setTimeout(() => alert.remove(), 500);
        }, 3000);
    });

    const toggleIcon = document.getElementById("togglePasswordIcon");
    const passwordInput = document.getElementById("passwordInput");

    if (toggleIcon && passwordInput) {
        toggleIcon.addEventListener("click", () => {
            const isPassword = passwordInput.type === "password";
            passwordInput.type = isPassword ? "text" : "password";
            toggleIcon.classList.toggle("bi-eye");
            toggleIcon.classList.toggle("bi-eye-slash");
        });
    }

    const form = document.getElementById("loginForm");
    const emailInput = document.getElementById("emailInput");
    const passwordInputField = document.getElementById("passwordInput");
    const emailError = document.getElementById("emailError");
    const passwordError = document.getElementById("passwordError");

    const showError = (el, message) => {
        el.textContent = message;
        el.classList.remove("opacity-0");
        el.classList.add("transition-opacity", "duration-300", "opacity-100");
    };

    const hideError = (el) => {
        if (el.textContent !== "") {
            el.classList.remove("opacity-100");
            el.classList.add("opacity-0");
            setTimeout(() => {
                el.textContent = "";
            }, 300);
        }
    };

    // Validasi
    form.addEventListener("submit", (e) => {
        let valid = true;
        emailError.textContent = "";
        passwordError.textContent = "";

        const emailValue = emailInput.value.trim();
        const passwordValue = passwordInputField.value.trim();

        if (!emailValue) {
            showError(emailError, "Mohon masukkan email");
            valid = false;
        }

        if (!passwordValue) {
            showError(passwordError, "Mohon masukkan password");
            valid = false;
        }

        if (!valid) e.preventDefault();
    });

    [emailInput, passwordInputField].forEach((input) => {
        input.addEventListener("input", () => {
            const errorEl = input === emailInput ? emailError : passwordError;
            hideError(errorEl);
        });
    });
});