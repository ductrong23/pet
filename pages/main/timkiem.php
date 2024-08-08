<?php
//  Lấy sản phẩm
if (isset($_POST['timkiem'])) {
    $tukhoa = $_POST['tukhoa'];
}
$sql_pro = "SELECT * FROM tbl_sanpham, tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc AND tbl_sanpham.tensanpham  LIKE '%" . $tukhoa . "%'";
$query_pro = mysqli_query($mysqli, $sql_pro);
?>

<h3>TỪ KHOÁ TÌM KIẾM: <?php echo $_POST['tukhoa'] ?></h3>
<ul class="list-product-tim-kiem">
    <?php
    while ($row = mysqli_fetch_array($query_pro)) {
    ?>
        <li>
            <a href="index.php?quanly=sanpham&id=<?php echo $row['id_sanpham'] ?>">
                <img src="admincp/modules/quanlysanpham/uploads/<?php echo $row['hinhanh'] ?>">
                <p class="title-product-tim-kiem"><?php echo $row['tensanpham'] ?></p>
            </a>
            <p class="price-product-tim-kiem"><?php echo number_format($row['giasp'], 0, ',', '.') . ' đ' ?></p>
            <p style="text-align:center; color:brown; font-weight:bolder"><?php echo $row['tendanhmuc'] ?></p>
            <div class="icons">
                    <a href="index.php?quanly=sanpham&id=<?php echo $row['id_sanpham'] ?>"><i class="fa fa-search" aria-hidden="true"></i></a>
                    <a href="pages/main/themgiohang.php?idsanpham=<?php echo $row['id_sanpham']; ?>"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
                </div>
        </li>

    <?php
    }
    ?>
</ul>

