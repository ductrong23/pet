
<?php

//  Lấy sản phẩm
$sql_bv = "SELECT * FROM tbl_tintuc WHERE tbl_tintuc.id_danhmuc='$_GET[id]' ORDER BY id DESC";
$query_bv = mysqli_query($mysqli, $sql_bv);

//  Lấy tên danh mục
$sql_cate = "SELECT * FROM tbl_danhmuctintuc WHERE tbl_danhmuctintuc.id_baiviet='$_GET[id]' LIMIT 1 ";
$query_cate = mysqli_query($mysqli, $sql_cate);
$row_title = mysqli_fetch_array($query_cate);

?>
<h3>DANH MỤC TIN TỨC: <?php echo $row_title['tendanhmuc_baiviet'] ?></h3>
<ul class="list-product">
    <?php
    while ($row_bv = mysqli_fetch_array($query_bv)) {
    ?>
        <li>
            <a href="index.php?quanly=tintuc&id=<?php echo $row_bv['id'] ?>">
                <img src="admincp/modules/quanlytintuc/uploads/<?php echo $row_bv['hinhanh']?>">
                <p class="title-product">Tên tin tức: <?php echo $row_bv['tenbaiviet']?></p>
            </a>
            <p class="title-product">Tóm tắt: <?php echo $row_bv['tomtat']?></p>
        </li>
    <?php
    }
    ?>
</ul>


