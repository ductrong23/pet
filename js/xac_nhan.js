// document.addEventListener('DOMContentLoaded', function () {
//     const steps = document.querySelectorAll('.xac-nhan-don-hang .step, .xac-nhan-don-hang .step-current');
//     const cartPage = 0;
//     const shippingPage = 1;
//     const paymentPage = 2;
//     const orderPlacedPage = 3;

//     steps.forEach((step, index) => {
//         step.addEventListener('click', function (e) {
//             e.preventDefault();

//             const currentStepIndex = getCurrentStepIndex();

//             if (index === currentStepIndex) return;

//             if (currentStepIndex === cartPage && index === shippingPage) {
//                 // Từ Giỏ hàng đến Vận chuyển
//                 if (isCartValid()) {
//                     window.location.href = 'index.php?quanly=vanchuyen';
//                 } else {
//                     alert('Giỏ hàng của bạn đang trống. Vui lòng thêm sản phẩm.');
//                 }
//             } else if (currentStepIndex === shippingPage && index === paymentPage) {
//                 // Từ Vận chuyển đến Thanh toán
//                 if (isShippingValid()) {
//                     window.location.href = 'index.php?quanly=thongtinthanhtoan';
//                 } else {
//                     alert('Vui lòng điền đầy đủ thông tin người nhận và địa chỉ.');
//                 }
//             } else if (currentStepIndex === paymentPage && index === orderPlacedPage) {
//                 // Từ Thanh toán đến Đơn hàng đã đặt
//                 if (isPaymentValid()) {
//                     window.location.href = 'index.php?quanly=donhangdadat';
//                 } else {
//                     alert('Vui lòng chọn phương thức thanh toán.');
//                 }
//             } else if (index < currentStepIndex) {
//                 // Lùi lại các bước trước đó
//                 if (index === cartPage) {
//                     window.location.href = 'index.php?quanly=giohang';
//                 } else if (index === shippingPage) {
//                     window.location.href = 'index.php?quanly=vanchuyen';
//                 } else if (index === paymentPage) {
//                     window.location.href = 'index.php?quanly=thongtinthanhtoan';
//                 }
//             } else {
//                 alert('Vui lòng hoàn thành bước hiện tại trước khi tiến tiếp.');
//             }
//         });
//     });

//     function getCurrentStepIndex() {
//         if (window.location.href.includes('quanly=giohang')) {
//             return cartPage;
//         } else if (window.location.href.includes('quanly=vanchuyen')) {
//             return shippingPage;
//         } else if (window.location.href.includes('quanly=thongtinthanhtoan')) {
//             return paymentPage;
//         } else if (window.location.href.includes('quanly=donhangdadat')) {
//             return orderPlacedPage;
//         }
//         return -1; // Không tìm thấy bước hiện tại
//     }

//     function isCartValid() {
//         const cartItems = document.querySelectorAll('.content-sanpham .sanpham');
//         return cartItems.length > 0;
//     }

//     function isShippingValid() {
//         const customerName = document.querySelector('input[name="tenkhachhang"]').value.trim();
//         const customerPhone = document.querySelector('input[name="sodienthoai"]').value.trim();
//         const customerAddress = document.querySelector('textarea[name="diachi"]').value.trim();
//         return customerName !== '' && customerPhone !== '' && customerAddress !== '';
//     }

//     function isPaymentValid() {
//         const paymentMethod = document.querySelector('input[name="payment"]:checked');
//         return paymentMethod !== null;
//     }
// });
