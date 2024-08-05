<?php

//  Lấy sản phẩm
$sql_pro = "SELECT * FROM tbl_sanpham WHERE tbl_sanpham.id_danhmuc='$_GET[id]' ORDER BY id_sanpham DESC";
$query_pro = mysqli_query($mysqli, $sql_pro);

//  Lấy tên danh mục
$sql_cate = "SELECT * FROM tbl_danhmuc WHERE tbl_danhmuc.id_danhmuc='$_GET[id]' LIMIT 1 ";
$query_cate = mysqli_query($mysqli, $sql_cate);
$row_title = mysqli_fetch_array($query_cate);

?>

<h3>DANH MỤC SẢN PHẨM: <?php echo $row_title['tendanhmuc'] ?></h3>
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
        </li>
    <?php
    }
    ?>
</ul>