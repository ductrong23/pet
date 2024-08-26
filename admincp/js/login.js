document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("login-form");
  const usernameInput = document.getElementById("username");
  const passwordInput = document.getElementById("password");

  form.addEventListener("submit", function (event) {
    const username = usernameInput.value.trim();
    const password = passwordInput.value.trim();
    let isValid = true;
    let errorMessage = "";

    // Kiểm tra tài khoản
    if (username === "") {
      errorMessage += "Vui lòng nhập tài khoản.\n";
      isValid = false;
    } else if (username.length < 8) {
      errorMessage += "Username phải có ít nhất 8 ký tự.\n";
      isValid = false;
    }

    // Kiểm tra mật khẩu
    if (password === "") {
      errorMessage += "Vui lòng nhập mật khẩu.\n";
      isValid = false;
    } else if (password.length < 8) {
      errorMessage += "Mật khẩu phải có ít nhất 8 ký tự.\n";
      isValid = false;
    } else if (!/[A-Z]/.test(password)) {
      errorMessage += "Mật khẩu phải có ít nhất 1 chữ in hoa.\n";
      isValid = false;
    } else if (!/[!@#$%^&*]/.test(password)) {
      errorMessage += "Mật khẩu phải có ít nhất 1 ký tự đặc biệt.\n";
      isValid = false;
    }

    // Nếu không hợp lệ, hiển thị thông báo lỗi và ngăn không cho gửi form
    if (!isValid) {
      showPopup(errorMessage.trim());
      event.preventDefault();
    }
  });

  // Hàm để hiển thị modal
  function showPopup(message) {
    const modal = document.getElementById("popupModal");
    const popupMessage = document.getElementById("popupMessage");
    const closeBtn = document.querySelector(".close");

    popupMessage.textContent = message;
    modal.style.display = "block";

    // Khi người dùng nhấp vào dấu x, ẩn modal
    closeBtn.onclick = function() {
      modal.style.display = "none";
    }

    // Khi người dùng nhấp ra ngoài modal, ẩn modal
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  }

});
