//  KIỂM TRA NHẬP THÔNG TIN VẬN CHUYỂN
document.addEventListener("DOMContentLoaded", function () {
  const formShipping = document.getElementById("form-shipping");
  if (formShipping) {
    formShipping.addEventListener("submit", function (event) {
      const name = document.getElementById("name").value.trim();
      const phone = document.getElementById("phone").value.trim();
      const address = document.getElementById("address").value.trim();
      const note = document.getElementById("ghichu").value.trim();
      let isValid = true;

      clearErrors(formShipping);

      // Kiểm tra tên
      if (name === "") {
        showError("name", "(*)Vui lòng nhập họ và tên.");
        isValid = false;
      } else if (name.length < 5) {
        showError("name", "(*)Họ và tên phải có ít nhất 5 ký tự.");
        isValid = false;
      }

      // Kiểm tra số điện thoại
      if (phone === "") {
        showError("phone", "(*)Vui lòng nhập số điện thoại.");
        isValid = false;
      } else if (!isValidPhoneNumber(phone)) {
        showError(
          "phone",
          "(*)Số điện thoại phải đủ 10 số và bắt đầu bằng số 0."
        );
        isValid = false;
      }

      // Kiểm tra địa chỉ
      if (address === "") {
        showError("address", "(*)Vui lòng nhập địa chỉ.");
        isValid = false;
      } else if (address.length < 6) {
        showError("address", "(*)Địa chỉ phải có ít nhất 6 ký tự.");
        isValid = false;
      }

      // Nếu không hợp lệ, ngăn không cho gửi form
      if (!isValid) {
        event.preventDefault();
      }
    });
  }

  function showError(inputId, message) {
    const errorElement = document.querySelector(`#${inputId} + .form-message`);
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

  function isValidPhoneNumber(phoneNumber) {
    const re = /^0\d{9}$/;
    return re.test(phoneNumber);
  }
});

