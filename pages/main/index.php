<?php
//  Lấy sản phẩm
$sql_pro = "SELECT * FROM tbl_sanpham, tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc ORDER BY tbl_sanpham.id_sanpham DESC LIMIT 15";
$query_pro = mysqli_query($mysqli, $sql_pro);

?>


<!-- BANNER -->

<div class="thumbnail">
    <img class="banner_index active" src="images/slide.webp" alt="Banner PetStore">
    <img class="banner_index " src="images/slide1.webp" alt="Banner PetStore">
    <img class="banner_index" src="images/slide2.webp" alt="Banner PetStore">
    <img class="banner_index" src="images/slide3.webp" alt="Banner PetStore">
</div>

<!-- SẢN PHẨM MỚI NHẤT -->
<h3 class="title-index">SẢN PHẨM MỚI NHẤT</h3>
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
                        <small>-15%</small>
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

<!-- TRÍCH INDEX.JS -->
<script src="js/index.js"></script>



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