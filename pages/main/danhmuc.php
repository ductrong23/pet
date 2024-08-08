<?php

//  Lấy sản phẩm
$sql_pro = "SELECT * FROM tbl_sanpham WHERE tbl_sanpham.id_danhmuc='$_GET[id]' ORDER BY id_sanpham DESC";
$query_pro = mysqli_query($mysqli, $sql_pro);

//  Lấy tên danh mục
$sql_cate = "SELECT * FROM tbl_danhmuc WHERE tbl_danhmuc.id_danhmuc='$_GET[id]' LIMIT 1 ";
$query_cate = mysqli_query($mysqli, $sql_cate);
$row_title = mysqli_fetch_array($query_cate);

?>


<!-- ĐIỀU HƯỚNG -->
<nav class="dieu-huong">
    <ul class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.php" title="Về trang chủ">Trang chủ</a>
        </li>
        <i class="fa fa-chevron-right" aria-hidden="true"></i>
        <li class="breadcrumb-item">
            <a href="index.php?quanly=danhmuc&id=<?php echo $_GET['id'] ?>" title="<?php echo $row_title['tendanhmuc'] ?>"><?php echo $row_title['tendanhmuc'] ?></a>
        </li>
    </ul>
</nav>

<h3 style="font-weight: bold; font-size: 25px; color: #123f39; font-family: Montserrat, sans-serif;">DANH MỤC SẢN PHẨM: <?php echo $row_title['tendanhmuc'] ?></h3>
<ul class="list-product">
    <?php
    while ($row_pro = mysqli_fetch_array($query_pro)) {
    ?>
        <li>
            <a href="index.php?quanly=sanpham&id=<?php echo $row_pro['id_sanpham'] ?>">
                <img src="admincp/modules/quanlysanpham/uploads/<?php echo $row_pro['hinhanh'] ?>">
                <p class="title-product"><?php echo $row_pro['tensanpham'] ?></p>
            </a>

            <p class="price-product"><?php echo number_format($row_pro['giasp'], 0, ',', '.') . ' đ' ?></p>
            <div class="icons">
            <!-- Biểu tượng tìm kiếm (Cho code giống click để xem sản phẩm chi tiết ở sanpham.php) -->
            <a href="index.php?quanly=sanpham&id=<?php echo $row_pro['id_sanpham'] ?>"><i class="fa fa-search" aria-hidden="true"></i></a>

            <!-- Biểu tượng giỏ hàng -->
            <a href="pages/main/themgiohang.php?idsanpham=<?php echo $row_pro['id_sanpham']; ?>"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
        </div>
        </li>
       
    <?php
    }
    ?>
</ul>