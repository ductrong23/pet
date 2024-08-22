document.addEventListener("DOMContentLoaded", function () {
  // Xử lý form đăng nhập
  const formLogin = document.getElementById("form-login");
  if (formLogin) {
    formLogin.addEventListener("submit", function (event) {
      const email = document.getElementById("email-login").value.trim();
      const password = document.getElementById("password-login").value.trim();
      let isValid = true;

      clearErrors(formLogin);

      if (email === "") {
        showError("email-login", "(*)Vui lòng nhập email.");
        isValid = false;
      } else if (!isValidEmail(email)) {
        showError("email-login", "(*)Email không hợp lệ.");
        isValid = false;
      }

      if (password === "") {
        showError("password-login", "(*)Vui lòng nhập mật khẩu.");
        isValid = false;
      }

      if (!isValid) {
        event.preventDefault();
      }
    });
  }

  // Xử lý form đăng ký
  const formRegister = document.getElementById("form-register");
  if (formRegister) {
    formRegister.addEventListener("submit", function (event) {
      const fullname = document.getElementById("fullname").value.trim();
      const email = document.getElementById("email-register").value.trim();
      const phoneNumber = document.getElementById("phone-number").value.trim();
      const address = document.getElementById("address").value.trim();
      const password = document
        .getElementById("password-register")
        .value.trim();
      const passwordConfirm = document
        .getElementById("password_confirmation")
        .value.trim();
      let isValid = true;

      clearErrors(formRegister);

      if (fullname === "") {
        showError("fullname", "(*)Vui lòng nhập họ và tên.");
        isValid = false;
      } else if (fullname.length < 8) {
        showError("fullname", "(*)Họ và tên phải có ít nhất 8 ký tự.");
        isValid = false;
      }

      if (email === "") {
        showError("email-register", "(*)Vui lòng nhập email.");
        isValid = false;
      } else if (!isValidEmail(email)) {
        showError("email-register", "(*)Email không hợp lệ.");
        isValid = false;
      }

      if (phoneNumber === "") {
        showError("phone-number", "(*)Vui lòng nhập số điện thoại.");
        isValid = false;
      } else if (!isValidPhoneNumber(phoneNumber)) {
        showError(
          "phone-number",
          "(*)Số điện thoại không hợp lệ. Phải bắt đầu bằng số 0 và có đủ 10 số."
        );
        isValid = false;
      }

      if (address === "") {
        showError("address", "(*)Vui lòng nhập địa chỉ.");
        isValid = false;
      } else if (address.length < 6) {
        showError("address", "(*)Địa chỉ phải có ít nhất 6 ký tự.");
        isValid = false;
      }

      if (password === "") {
        showError("password-register", "(*)Vui lòng nhập mật khẩu.");
        isValid = false;
      } else if (!isValidPassword(password)) {
        showError(
          "password-register",
          "(*)Mật khẩu phải có ít nhất 8 ký tự, bao gồm chữ số, ký tự đặc biệt và chữ in hoa."
        );
        isValid = false;
      }

      if (passwordConfirm === "") {
        showError("password_confirmation", "(*)Vui lòng nhập lại mật khẩu.");
        isValid = false;
      } else if (password !== passwordConfirm) {
        showError("password_confirmation", "(*)Mật khẩu không khớp.");
        isValid = false;
      }

      if (!isValid) {
        event.preventDefault();
      }
    });

    // Thêm sự kiện input để xóa lỗi khi người dùng nhập thông tin
    const inputs = formRegister.querySelectorAll("input");
    inputs.forEach((input) => {
      input.addEventListener("input", function () {
        clearError(this.id);
      });
    });
  }

  function showError(inputId, message) {
    const errorElement = document.querySelector(`#${inputId} + .form-message`);
    console.log(inputId, errorElement, message);
    if (errorElement) {
      errorElement.textContent = message;
    }
  }

  function clearErrors(form) {
    const errorMessages = form.querySelectorAll(".form-message");
    errorMessages.forEach((element) => {
      element.textContent = "";
    });
  }

  function isValidEmail(email) {
    const re =
      /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
  }

  function isValidPhoneNumber(phoneNumber) {
    const re = /^0\d{9}$/;
    return re.test(phoneNumber);
  }

  function isValidPassword(password) {
    // Ít nhất 8 ký tự, có chữ số, ký tự đặc biệt, và chữ in hoa
    const re = /^(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*.])(?=.{8,})/;
    return re.test(password);
  }
});
