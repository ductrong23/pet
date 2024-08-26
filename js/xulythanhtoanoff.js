var modal = document.getElementById("popupModal");
var span = document.getElementsByClassName("close")[0];
var redirectUrl = null; // Biến toàn cục để lưu URL điều hướng

function showPopup(message, url = null) {
  document.getElementById("popupMessage").innerHTML = message;
  modal.style.display = "block";
  redirectUrl = url; // Lưu URL để điều hướng sau khi popup bị đóng

  // Đặt thời gian hiển thị popup sau đó điều hướng
  setTimeout(function () {
    if (modal.style.display === "block" && redirectUrl) {
      window.location.href = redirectUrl;
    }
  }, 5000); // 5 giây
}

span.onclick = function () {
  modal.style.display = "none";
  // Thực hiện điều hướng ngay lập tức nếu có URL
  if (redirectUrl) {
    window.location.href = redirectUrl;
  }
};

window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
    // Thực hiện điều hướng ngay lập tức nếu có URL
    if (redirectUrl) {
      window.location.href = redirectUrl;
    }
  }
};
