// =========================HIỆN POPUP THÔNG BÁO SỐ LƯỢNG TRONG KHO===========================================

var modal = document.getElementById("popupModal");
var span = document.getElementsByClassName("close")[0];
var redirectUrl = null;

function showPopup(message, codeCart = null) {
    document.getElementById("popupMessage").innerHTML = message;
    modal.style.display = "block";
    redirectUrl = codeCart ? `../../index.php?action=donhang&query=xemdonhangoff&code=${codeCart}` : null;

    // Đặt thời gian hiển thị popup
    setTimeout(function () {
        if (modal.style.display === "block" && redirectUrl) {
            window.location.href = redirectUrl;
        }
    }, 15000); // 15000ms = 15 giây
}

span.onclick = function () {
    modal.style.display = "none";
    if (redirectUrl) {
        window.location.href = redirectUrl;
    }
};

window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
        if (redirectUrl) {
            window.location.href = redirectUrl;
        }
    }
};
