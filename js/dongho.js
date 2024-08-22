function updateCountdown(timeRemaining) {
    var countdownElement = document.getElementById('countdown');
    
    if (timeRemaining <= 0) {
        countdownElement.innerHTML = "Thời gian mua hàng đã hết.";
        // Có thể tự động chuyển hướng hoặc thực hiện hành động khác
        window.location.href = 'index.php';
        return;
    }
    
    var minutes = Math.floor(timeRemaining / 60);
    var seconds = timeRemaining % 60;
    minutes = minutes < 10 ? '0' + minutes : minutes;
    seconds = seconds < 10 ? '0' + seconds : seconds;
    
    countdownElement.innerHTML = minutes + ":" + seconds;
    
    timeRemaining--;
    
    // Cập nhật mỗi giây
    setTimeout(function() { updateCountdown(timeRemaining); }, 1000);
}

// Khởi tạo thời gian đếm ngược từ giá trị PHP
document.addEventListener('DOMContentLoaded', function() {
    var timeRemaining = parseInt(document.getElementById('countdown').getAttribute('data-time-remaining'));
    updateCountdown(timeRemaining);
});
