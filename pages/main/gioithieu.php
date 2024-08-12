<!-- ĐIỀU HƯỚNG -->
<nav class="dieu-huong">
    <ul class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.php" title="Về trang chủ">Trang chủ</a>
        </li>
        <i class="fa fa-chevron-right" aria-hidden="true"></i>
        <li class="breadcrumb-item">
            <a href="#" title="Giới thiệu">Giới thiệu</a>
        </li>

    </ul>
</nav>

<?php
if (isset($_SESSION['dangky'])) {
    echo '<h4 style="text-align: center;  font-family: Montserrat, sans-serif; color: #123f39"> <i class="fa fa-hand-peace-o" aria-hidden="true" "></i> Xin chào ' . $_SESSION['dangky'].'</h4>';
}
?>

<div class="gioi-thieu">
    <div class="doan-dau">
        <div class="loi-van-1">
            <h3 class="section-title">WELCOME TO PETSTORE</h3>
            <p class="section-subtitle">
               | KÍNH CHÀO QUÝ KHÁCH |
            </p>
            <p class="section-paragraph">Một trong những điều truyền cảm hứng nhất về PetStore là mọi thứ chúng tôi làm để hướng tới sứ mệnh của mình.
                <br><br>
                Chúng tôi yêu thú cưng và cam kết cung cấp các sản phẩm, dịch vụ, kết nối và chăm sóc mà khách hàng và thú cưng cần trong mọi giai đoạn của cuộc đời. Niềm đam mê dành cho thú cưng này là một phần lý tưởng đích thực và là động lực trong hoạt động kinh doanh của chúng tôi.
                <br><br>
                Lịch sử của PetStore là một câu chuyện thành công khi chúng tôi là tập hợp những người yêu động vật biết nắm lấy cơ hội đúng lúc cùng với tầm nhìn xa phát triển nâng tầm thành một doanh nghiệp.
            </p>
            <p class="section-subtitle">
               | TẦM NHÌN CỦA CHÚNG TÔI |
            </p>
            <ul class="liet-ke-gioi-thieu">
                <li><i class="fa fa-hand-o-right" aria-hidden="true"></i><span>Chúng tôi tin rằng đó là nhiệm vụ của chúng tôi để đảm bảo sức khỏe và hạnh phúc cho thú cưng. Giúp chúng thật sự hiểu rằng chúng đang được yêu thương và an toàn.</span></li>
                <li><i class="fa fa-hand-o-right" aria-hidden="true"></i><span>Chúng tôi tin rằng thú cưng sẽ làm cho con người tốt đẹp hơn. Chúng sẽ làm phong phú thêm cho cuộc sống của chúng ta và xây dựng xã hội văn minh, phát triển.</span></li>
                <li><i class="fa fa-hand-o-right" aria-hidden="true"></i><span>Chúng tôi tin tưởng vào những gì chúng tôi đang làm dựa trên những giá trị tiêu chuẩn trong việc chăm sóc động vật. Chất lượng sản phẩm và chăm sóc khách hàng.</span></li>
            </ul>
            <a href="index.php" class="btn-about-us">
                <span>Khám phá ngay</span>
            </a>
        </div>
        <div class="anh-gioi-thieu-1">
            <img src="images/anh-gioi-thieu-6.jpg" style="width:80%; padding:16px; border: 2px double #123f39; rotate: -10deg" alt="PetStore"  title="PetStore">
        </div>
    </div>

   

    <div class="clear">
    </div>
    <div class="doan-sau">
        <div class="anh-gioi-thieu-2">
            <img src="images/anh-gioi-thieu-2.jpg" style="width:80%; padding:16px; border: 2px double #123f39; rotate: 10deg; " alt="PetStore" title="PetStore" >
        </div>
        <div class="loi-van-2">
            <h3 class="section-title"> TIÊU CHUẨN CHẤT LƯỢNG </h3>
            <p class="section-subtitle">
              | TỪ ĐỘI NGŨ CHUYÊN GIA |
            </p>
            <p class="section-paragraph">Chất lượng không chỉ là một cam kết, mà là tôn chỉ. Chúng tôi tuân thủ những tiêu chuẩn nghiêm ngặt để đảm bảo mọi sản phẩm đều đáp ứng và vượt qua mong đợi của khách hàng.</p>
            <p class="section-subtitle">
               | CÂU CHUYỆN CỦA CHÚNG TÔI |
            </p>
            <p class="section-paragraph">Từ những ngày đầu khởi nghiệp đến bây giờ, chúng tôi đã vượt qua nhiều thách thức và chiến thắng. Câu chuyện của chúng tôi không chỉ là về sản phẩm, mà còn là về những con người và niềm đam mê.</p>
            <p class="section-subtitle">
              | TƯƠNG LAI ĐỔI MỚI - PHÁT TRIỂN |
             </p>
            <p class="section-paragraph">Chúng tôi không chỉ dừng lại ở đây. Tương lai của chúng tôi là về sự đổi mới và phát triển không ngừng, với những kế hoạch lớn và cam kết làm mới ngành công nghiệp.</p>
        </div>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
    // Select the introduction section
    const introSection = document.querySelector(".gioi-thieu");

    // Add the 'start' class to trigger the animation when the page loads
    introSection.classList.add("start");
});
</script>