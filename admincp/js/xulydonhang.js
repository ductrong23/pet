document.addEventListener("DOMContentLoaded", function () {
  const productModal = document.getElementById("confirmProductModal");
  const orderModal = document.getElementById("confirmOrderModal");
  const productMessage = document.getElementById("productConfirmationMessage");
  const orderMessage = document.getElementById("orderConfirmationMessage");
  const closeProductModal = document.getElementById("closeProductModal");
  const closeOrderModal = document.getElementById("closeOrderModal");
  const confirmProductButton = document.getElementById("confirmProductButton");
  const cancelProductButton = document.getElementById("cancelProductButton");
  const confirmOrderButton = document.getElementById("confirmOrderButton");
  const cancelOrderButton = document.getElementById("cancelOrderButton");

  let productDeleteCallback = null;
  let orderDeleteCallback = null;

  function showProductModal(message, onConfirm) {
    productMessage.textContent = message;
    productModal.style.display = "block";
    productDeleteCallback = onConfirm;
  }

  function showOrderModal(message, onConfirm) {
    orderMessage.textContent = message;
    orderModal.style.display = "block";
    orderDeleteCallback = onConfirm;
  }

  function closeModal(modal) {
    modal.style.display = "none";
  }

  closeProductModal.onclick = function () {
    closeModal(productModal);
  };

  closeOrderModal.onclick = function () {
    closeModal(orderModal);
  };

  window.onclick = function (event) {
    if (event.target == productModal) {
      closeModal(productModal);
    } else if (event.target == orderModal) {
      closeModal(orderModal);
    }
  };

  confirmProductButton.onclick = function () {
    if (productDeleteCallback) {
      productDeleteCallback();
      closeModal(productModal);
    }
  };

  cancelProductButton.onclick = function () {
    closeModal(productModal);
  };

  confirmOrderButton.onclick = function () {
    if (orderDeleteCallback) {
      orderDeleteCallback();
      closeModal(orderModal);
    }
  };

  cancelOrderButton.onclick = function () {
    closeModal(orderModal);
  };

  window.showProductModal = showProductModal;
  window.showOrderModal = showOrderModal;


});
