
<?php
//  Lấy sản phẩm
$sql_pro = "SELECT * FROM tbl_sanpham, tbl_danhmuc 
WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc 
AND tbl_sanpham.tinhtrang = 1 
ORDER BY tbl_sanpham.id_sanpham DESC LIMIT 25";
$query_pro = mysqli_query($mysqli, $sql_pro);
?>

<br>
<br>
<br>
<!-- BANNER -->
<div class="thumbnail">
    <!-- <img class="banner_index active" src="images/slide.webp" alt="Banner PetStore"> -->
    <img class="banner_index active " src="images/slide1.webp" alt="Banner PetStore">
    <img class="banner_index" src="images/slide2.webp" alt="Banner PetStore">
    <img class="banner_index" src="images/slide3.webp" alt="Banner PetStore">
</div>

<!-- CHÍNH SÁCH -->

<div class="chinh-sach">
    <div class="dich-vu-1">
        <img src="images/image_service1.webp" alt="PetStore Service">
        <p>HÀNG HOÁ CHẤT LƯỢNG</p>
    </div>
    <div class="dich-vu-2">
        <img src="images/image_service2.webp" alt="PetStore Service">
        <p>MIỄN PHÍ VẬN CHUYỂN</p>
    </div>
    <div class="dich-vu-3">
        <img src="images/image_service3.webp" alt="PetStore Service">
        <p>TƯ VẤN NHIỆT TÌNH</p>
    </div>
    <div class="dich-vu-4">
        <img src="images/image_service4.webp" alt="PetStore Service">
        <p>GIÁ CẢ HỢP LÝ</p>
    </div>
</div>


<!-- SẢN PHẨM MỚI NHẤT -->

<h3 class="title-index">SẢN PHẨM MỚI NHẤT</h3>
<div class="san-pham-chinh"></div>
<ul class="list-product">
    <?php
    while ($row = mysqli_fetch_array($query_pro)) {
    ?>
        <li>
            <a href="index.php?quanly=sanpham&id=<?php echo $row['id_sanpham'] ?>">
                <img class="picture" src="admincp/modules/quanlysanpham/uploads/<?php echo $row['hinhanh'] ?>">
                <p class="title-product"><?php echo $row['tensanpham'] ?></p>
            </a>
            <div class="danh-gia-index">

                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>

            </div>


            <!-- Disappear: ẩn tên danh mục -->
            <div class="disappear">
                <p class="price-product"><?php echo number_format($row['giasp'], 0, ',', '.') . ' đ' ?></p>
                <!-- <p class="old-price-product"><?php echo number_format($row['giagiam'], 0, ',', '.') . ' đ' ?></p> <span>-10%</span> -->
                <p class="old-price-product">
                    <span>
                        <label><?php echo number_format($row['giagiam'], 0, ',', '.') . ' đ' ?></label>
                        <small><?php echo $row['phantram'] ?>%</small>
                    </span>
                </p>
                <!-- <p style="text-align:center; color:brown; font-weight:bolder"><?php echo $row['tendanhmuc'] ?></p> -->
            </div>


            <div class="icons">
                <!-- Biểu tượng tìm kiếm (Cho code giống click để xem sản phẩm chi tiết ở sanpham.php) -->
                <a href="index.php?quanly=sanpham&id=<?php echo $row['id_sanpham'] ?>"><i class="fa fa-search" aria-hidden="true"></i></a>

                <!-- Biểu tượng giỏ hàng -->
                <a href="pages/main/themgiohang.php?idsanpham=<?php echo $row['id_sanpham']; ?>"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
            </div>

            <div class="new">
                <img src="images/new2.png" alt="">
            </div>
        </li>

    <?php
    }
    ?>
</ul>
</div>

<!-- TRÍCH INDEX.JS -->
<script src="js/index.js"></script>

<div class="clear">

</div>



<!-- CONTAINER_US -->
<div class="container__us">
    <div class="container__us-group">
        <img src="images/pet1.png" alt="" class="container__us-group-item">
        <img src="images/pet6.jpeg" alt="" class="container__us-group-item">
        <img src="images/pet3.jpg" alt="" class="container__us-group-item">
        <img src="images/pet4.jfif" alt="" class="container__us-group-item">
        <img src="images/pet5.jpeg" alt="" class="container__us-group-item">
        <img src="images/pet2.jpg" alt="" class="container__us-group-item">
    </div>
</div>


<div id="overlay"></div>
<div class="popup" id="popup">
    <button class="close-btn" onclick="closePopup()"><i class="fa-solid fa-circle-xmark"></i></button>
    <img src="images/logo1.png" alt="PetStore" style="width: 150px; height: 150px;">
    <p>Bạn có tài khoản chưa?</p>
    <a href="account.php"><button class="register">Đăng ký</button></a>
    <a href="account.php"><button class="login">Đăng nhập</button></a>
</div>

<style>
    .popup {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 300px;
        padding: 20px;
        background: white;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        text-align: center;
        display: none;
        z-index: 1000;
    }

    .popup img {
        width: 50px;
        height: 50px;
    }

    .popup button {
        margin: 10px;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .popup .register {
        background-color: #ff4d4d;
        color: white;
    }

    .popup .login {
        background-color: #ff944d;
        color: white;
    }

    .popup .close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        background: none;
        border: none;
        font-size: 25px;
        cursor: pointer;
        opacity: 0.5;
    }

    .popup .close-btn:hover {
        opacity: 1;
    }

    /* Background overlay */
    #overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: none;
        z-index: 999;
    }
</style>

<script>
    function showPopup() {
        document.getElementById('popup').style.display = 'block';
        document.getElementById('overlay').style.display = 'block';
    }

    function closePopup() {
        document.getElementById('popup').style.display = 'none';
        document.getElementById('overlay').style.display = 'none';
    }

    document.querySelector('.log-in-icon').addEventListener('click', function(event) {
        event.preventDefault();
        showPopup();
    });
</script>