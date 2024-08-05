<!-- <div class="inf-slogan">
    <h1>PETSTORE</h1>
    <img class="logo-gioi-thieu" src="images/logo1.png" alt="PetStore">
    <h2>Mang tình yêu đến với thú cưng</h2>
</div> -->
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

<style>
    /* Định dạng chung cho thanh điều hướng */
.dieu-huong {
  padding: 10px 0;
  background-color: #f9f9f9;
  border-bottom: 1px solid #e6e6e6;
}

/* Định dạng cho danh sách breadcrumb */
.breadcrumb {
  list-style: none;
  display: flex;
  align-items: center;
  padding: 0;
  margin: 0;
}

/* Định dạng cho từng mục breadcrumb */
.breadcrumb-item {
  margin: 0;
}

/* Định dạng cho liên kết trong breadcrumb */
.breadcrumb-item a {
  text-decoration: none;
  color: #007bff;
  font-weight: 500;
}

/* Thêm style cho biểu tượng phân cách */
.breadcrumb i {
  margin: 0 10px;
  color: #6c757d;
}

/* Đổi màu khi di chuột qua liên kết */
.breadcrumb-item a:hover {
  text-decoration: none;
  color: #0056b3;
}

/* Đổi màu cho mục hiện tại (nếu cần) */
.breadcrumb-item.active a {
  color: #6c757d;
  cursor: default;
  pointer-events: none;
}

</style>

<div class="products" id="Products">
    <h1 class="title">VỀ CHÚNG TÔI</h1>

    <div class="box">
        <div class="card">

            <div class="small_card">
                <a href="index.php" title="Trang chủ">
                    <i class="fa fa-home" aria-hidden="true"></i>
                </a>
                <a href="index.php?quanly=lienhe" title="Liên hệ chúng tôi">
                    <i class="fa fa-address-card-o" aria-hidden="true"></i>
                </a>
            </div>

            <div class="image">
                <img src="images/logo1.png">
            </div>

            <div class="products_text">
                <h2>PETSTORE</h2>
                <p>
                    PetStore là một cửa hàng trực tuyến chuyên cung cấp các sản phẩm và dịch vụ chất lượng cao dành cho thú cưng. Tại PetStore, chúng tôi hiểu rằng thú cưng không chỉ là vật nuôi mà còn là những người bạn thân thiết và thành viên quan trọng trong gia đình bạn.
                </p>
                <p>
                    Chính vì thế, chúng tôi cam kết mang đến những sản phẩm tốt nhất để chăm sóc cho thú cưng của bạn từ thức ăn, đồ chơi, đến các phụ kiện và sản phẩm chăm sóc sức khỏe.
                </p>

                <div class="products_star">
                    <i class="fa fa-diamond" aria-hidden="true"></i>
                </div>
                <a href="index.php" class="btn">Khám phá ngay</a>
            </div>

        </div>

        <div class="card">

            <div class="small_card">
                <a href="index.php" title="Trang chủ">
                    <i class="fa fa-home" aria-hidden="true"></i>
                </a>
                <a href="index.php?quanly=lienhe" title="Liên hệ chúng tôi">
                    <i class="fa fa-address-card-o" aria-hidden="true"></i>
                </a>
            </div>

            <div class="image">
                <img src="images/logo4.png" width="100px" height="80px">
            </div>

            <div class="products_text">
                <h2>PETSTORE</h2>
                <p>
                    Sứ mệnh của PetStore là mang đến sự hài lòng tối đa cho khách hàng thông qua dịch vụ chuyên nghiệp và thân thiện. Chúng tôi luôn lắng nghe và thấu hiểu những mong muốn của khách hàng để không ngừng cải thiện và nâng cao chất lượng dịch vụ.
                </p>
                <p>
                    Hãy để PetStore trở thành đối tác tin cậy của bạn trong việc chăm sóc thú cưng. Chúng tôi luôn sẵn sàng đồng hành cùng bạn trong hành trình mang lại hạnh phúc cho những người bạn bốn chân đáng yêu!
                </p>

                <div class="products_star">
                    <i class="fa fa-diamond" aria-hidden="true"></i>
                </div>
                <a href="index.php" class="btn">Khám phá ngay</a>
            </div>

        </div>