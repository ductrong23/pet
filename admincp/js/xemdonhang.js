// =========================HIỆN POPUP THÔNG XOÁ SẢN PHẨM===========================================

document.addEventListener("DOMContentLoaded", function () {
  const modal = document.getElementById("popupModal");
  const popupMessage = document.getElementById("popupMessage");
  const closeBtn = document.querySelector(".close");
  const confirmBtn = document.getElementById("confirmButton");
  const cancelBtn = document.getElementById("cancelButton");
  let confirmCallback = null;
  let originalEvent = null;

  function showPopup(message, onConfirm) {
    popupMessage.textContent = message;
    modal.style.display = "block";
    confirmCallback = onConfirm;

    closeBtn.onclick = function () {
      modal.style.display = "none";
    };

    window.onclick = function (event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    };

    confirmBtn.onclick = function () {
      if (confirmCallback) {
        confirmCallback();
        modal.style.display = "none";
      }
    };

    cancelBtn.onclick = function () {
      modal.style.display = "none";
    };
  }

  window.handleDelete = function (event, element) {
    event.preventDefault();
    const url = element.getAttribute("data-url");
    showPopup(
      "Bạn có chắc chắn muốn xóa mục này?",
      function () {
        window.location.href = url;
      }
    );
  };
});


