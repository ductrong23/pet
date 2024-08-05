const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () => {
    container.classList.add("active");
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
});

function togglePasswordVisibility(hideIcon, passwordField) {
    if (passwordField.type === "password") {
        passwordField.type = "text";
        hideIcon.classList.remove("fa-eye-slash");
        hideIcon.classList.add("fa-eye");
    } else {
        passwordField.type = "password";
        hideIcon.classList.remove("fa-eye");
        hideIcon.classList.add("fa-eye-slash");
    }
}

const hideIcon1 = document.querySelector('#form-1 .hide-icon');
const password1 = document.querySelector('#form-1 #password');

hideIcon1.onclick = function () {
    togglePasswordVisibility(hideIcon1, password1);
};

const hideIcon2 = document.querySelector('#form-2 .hide-icon');
const password2 = document.querySelector('#form-2 #password');

hideIcon2.onclick = function () {
    togglePasswordVisibility(hideIcon2, password2);
};

const hideIconConfirm = document.querySelector('#form-2 .hide-icon.confirm');
const passwordConfirm = document.querySelector('#form-2 #password_confirmation');

hideIconConfirm.onclick = function () {
    togglePasswordVisibility(hideIconConfirm, passwordConfirm);
};