//  ĐIỀN ĐỦ VÀ ĐÚNG YÊU CẦU THÔNG TIN VẬN CHUYỂN => THÔNG TIN THANH TOÁN (CÓ ĐĂNG NHẬP)
// POP UP XUẤT HIỆN KHI CLICK NÚT THÔNG TIN THANH TOÁN / THANH TOÁN
document.addEventListener("DOMContentLoaded", function () {
  const checkoutLink1 = document.getElementById("link-nav");
  const checkoutLink2 = document.getElementById("link-duoi");

  const modal = document.getElementById("popupModal");
  const modalMessage = document.getElementById("popupMessage");
  const closeModal = document.getElementsByClassName("close")[0];

  // Hàm hiển thị modal với thông báo
  function showModal(message) {
    modalMessage.textContent = message;
    modal.style.display = "block";
  }

  // Đóng modal khi nhấp vào nút đóng
  closeModal.onclick = function () {
    modal.style.display = "none";
  };

  // Đóng modal khi nhấp ra ngoài modal
  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  };

  // Hàm kiểm tra và điều hướng
  function handleCheckoutLink(event) {
    // Kiểm tra xem thông tin vận chuyển đã được điền đúng chưa
    const shippingInfoValid = validateShippingInfo();

    if (!shippingInfoValid) {
      // Nếu thông tin vận chuyển không hợp lệ, hiển thị thông báo và ngăn không cho chuyển trang
      // alert(
      //   "Vui lòng điền đầy đủ và đúng yêu cầu thông tin vận chuyển trước khi tiếp tục mua hàng."
      // );
      // event.preventDefault(); // Ngăn không cho chuyển đến trang thanh toán
      showModal(
        "Vui lòng điền đầy đủ và đúng yêu cầu thông tin vận chuyển trước khi tiếp tục mua hàng."
      );
    } else {
      // Nếu thông tin vận chuyển hợp lệ, cho phép chuyển trang
      window.location.href = "index.php?quanly=thongtinthanhtoan";
    }
  }

  // Thêm sự kiện click cho link 1
  if (checkoutLink1) {
    checkoutLink1.addEventListener("click", handleCheckoutLink);
  }

  // Thêm sự kiện click cho link 2
  if (checkoutLink2) {
    checkoutLink2.addEventListener("click", handleCheckoutLink);
  }

  // Hàm kiểm tra thông tin vận chuyển
  function validateShippingInfo() {
    const name = document.getElementById("name")
      ? document.getElementById("name").value.trim()
      : "";
    const phone = document.getElementById("phone")
      ? document.getElementById("phone").value.trim()
      : "";
    const address = document.getElementById("address")
      ? document.getElementById("address").value.trim()
      : "";

    let isValid = true;

    // Kiểm tra tên
    if (name === "" || name.length < 5) {
      showError("name", "(*) Họ và tên phải có ít nhất 5 ký tự.");
      isValid = false;
    } else {
      clearError("name");
    }

    // Kiểm tra số điện thoại
    if (phone === "" || !isValidPhoneNumber(phone)) {
      showError(
        "phone",
        "(*) Số điện thoại phải đủ 10 số và bắt đầu bằng số 0."
      );
      isValid = false;
    } else {
      clearError("phone");
    }

    // Kiểm tra địa chỉ
    if (address === "") {
      showError("address", "(*)Vui lòng nhập địa chỉ.");
      isValid = false;
    } else if (address.length < 6) {
      showError("address", "(*)Địa chỉ phải có ít nhất 6 ký tự.");
      isValid = false;
    } else if (!isValidAddress(address)) {
      showError(
        "address",
        "(*)Địa chỉ không được chỉ toàn số."
      );
      isValid = false;
    } else {
      clearError("address");
    }

    return isValid;
  }
  // Hàm hiển thị lỗi
  function showError(inputId, message) {
    const errorElement = document.querySelector(`#${inputId} + .form-message`);
    if (errorElement) {
      errorElement.textContent = message;
    }
  }

  // Hàm xóa lỗi
  function clearError(inputId) {
    const errorElement = document.querySelector(`#${inputId} + .form-message`);
    if (errorElement) {
      errorElement.textContent = "";
    }
  }

  // Hàm kiểm tra số điện thoại hợp lệ
  function isValidPhoneNumber(phoneNumber) {
    const re = /^0\d{9}$/;
    return re.test(phoneNumber);
  }

  // Hàm kiểm tra địa chỉ có hợp lệ hay không
  function isValidAddress(address) {
    // Kiểm tra nếu địa chỉ chứa ít nhất một chữ cái
    const containsLetter = /[a-zA-Z]/.test(address);
    // Kiểm tra nếu địa chỉ chỉ toàn số
    const isOnlyDigits = /^\d+$/.test(address);
    // Địa chỉ hợp lệ nếu chứa ít nhất một chữ cái và không phải chỉ toàn số
    return containsLetter && !isOnlyDigits;
  }
});


// =============POP UP===============
// POP UP XUẤT HIỆN KHI CLICK NÚT THÊM THÔNG TIN / CẬP NHẬT THÔNG TIN THANH TOÁN
document.addEventListener("DOMContentLoaded", function () {
  var popupModal = document.getElementById("popupModal");
  var popupMessage = document.getElementById("popupMessage").innerText;
  var closeBtn = document.querySelector(".modal .close");

  // Kiểm tra nếu popupMessage có nội dung thì hiển thị modal
  if (popupMessage.trim() !== "") {
    popupModal.style.display = "block";
  }

  // Đóng modal khi nhấn nút 'close'
  closeBtn.onclick = function () {
    popupModal.style.display = "none";
  };

  // Đóng modal khi nhấn bất kỳ vị trí nào bên ngoài modal
  window.onclick = function (event) {
    if (event.target == popupModal) {
      popupModal.style.display = "none";
    }
  };
});
