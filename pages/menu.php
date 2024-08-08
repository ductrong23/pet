<?php
// session_start();
$sql_danhmuc = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC";
$query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);

?>
<?php
if (isset($_GET['dangxuat']) && $_GET['dangxuat'] == 1) {
    unset($_SESSION['dangky']);
}
?>
<div class="menu">
    <ul class="list-menu">
        <li><a href="index.php">TRANG CHỦ</a></li>
        <li><a href="index.php?quanly=gioithieu">GIỚI THIỆU</a></li>
        <!--  -->
        <li class="list-menu-con">
            <!-- <a href="index.php">SẢN PHẨM <i class="fa fa-chevron-down" aria-hidden="true" width="5px" height="5px"></i></a> -->
            <a href="index.php?quanly=danhmuc_sanpham">SẢN PHẨM <i class="fa fa-chevron-down" aria-hidden="true" width="5px" height="5px"></i></a>
            <ul>
                <?php
                while ($row_danhmuc = mysqli_fetch_array($query_danhmuc)) {
                ?>
                    <li><a href="index.php?quanly=danhmucsanpham&id=<?php echo $row_danhmuc['id_danhmuc'] ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></a></li>
                <?php
                }
                ?>
            </ul>
        </li>


        <li><a href="index.php?quanly=lienhe">LIÊN HỆ</a></li>
        <li><a href="index.php?quanly=tintuc_menu">TIN TỨC</a></li>
       

    </ul>
    <!-- <form action="index.php?quanly=timkiem" method="POST">
        <p><input type="text" placeholder="Tìm kiếm sản phẩm" name="tukhoa"><input type="submit" name="timkiem" value="Tìm kiếm"></p>
    </form> -->
</div>