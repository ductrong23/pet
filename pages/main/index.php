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
            <div class="disappear">
                <p class="price-product"><?php echo number_format($row['giasp'], 0, ',', '.') . ' đ' ?></p>
                <!-- <p style="text-align:center; color:brown; font-weight:bolder"><?php echo $row['tendanhmuc'] ?></p> -->
            </div>
            <div class="icons">
                <i class="fa fa-heart" aria-hidden="true"></i>
                <i class="fa fa-shopping-basket" aria-hidden="true"></i>
            </div>
        </li>

    <?php
    }
    ?>
</ul>

<script src="js/index.js"></script>