//  ĐIỀN ĐỦ VÀ ĐÚNG YÊU CẦU THÔNG TIN VẬN CHUYỂN => THÔNG TIN THANH TOÁN (CÓ ĐĂNG NHẬP)

document.addEventListener("DOMContentLoaded", function () {
  const checkoutLink1 = document.getElementById("link-nav");
  const checkoutLink2 = document.getElementById("link-duoi");

  // Hàm kiểm tra và điều hướng
  function handleCheckoutLink(event) {
    // Kiểm tra xem thông tin vận chuyển đã được điền đúng chưa
    const shippingInfoValid = validateShippingInfo();

    if (!shippingInfoValid) {
      // Nếu thông tin vận chuyển không hợp lệ, hiển thị thông báo và ngăn không cho chuyển trang
      alert(
        "Vui lòng điền đầy đủ và đúng yêu cầu thông tin vận chuyển trước khi tiếp tục mua hàng."
      );
      event.preventDefault(); // Ngăn không cho chuyển đến trang thanh toán
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
    if (address === "" || address.length < 6) {
      showError("address", "(*) Địa chỉ phải có ít nhất 6 ký tự.");
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
});
