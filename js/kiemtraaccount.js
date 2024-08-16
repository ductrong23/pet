document.addEventListener("DOMContentLoaded", function () {
  const container = document.getElementById("container");
  const registerBtn = document.getElementById("register");
  const loginBtn = document.getElementById("login");

  // Toggle between login and register forms
  registerBtn.addEventListener("click", () => {
    container.classList.add("active");
  });

  loginBtn.addEventListener("click", () => {
    container.classList.remove("active");
  });

  // Toggle password visibility function
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

  // ẨN HIỆN PASSWORD LOGIN
  const hideIconLogin = document.querySelector("#form-login .hide-icon");
  const passwordLogin = document.querySelector("#form-login #password-login");

  if (hideIconLogin && passwordLogin) {
    hideIconLogin.onclick = function () {
      togglePasswordVisibility(hideIconLogin, passwordLogin);
    };
  }

  // ẨN HIỆN PASSWORD REGISTER
  const hideIconRegister = document.querySelector("#form-register .hide-icon");
  const passwordRegister = document.querySelector(
    "#form-register #password-register"
  );

  if (hideIconRegister && passwordRegister) {
    hideIconRegister.onclick = function () {
      togglePasswordVisibility(hideIconRegister, passwordRegister);
    };
  }

  // ẨN HIỆN PASSWORD CONFIRM REGISTER
  const hideIconConfirm = document.querySelector(
    "#form-register .hide-icon.confirm"
  );
  const passwordConfirm = document.querySelector(
    "#form-register #password_confirmation"
  );

  if (hideIconConfirm && passwordConfirm) {
    hideIconConfirm.onclick = function () {
      togglePasswordVisibility(hideIconConfirm, passwordConfirm);
    };
  }
});
