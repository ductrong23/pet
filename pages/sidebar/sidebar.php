<div class="clear"></div>

<div class="sidebar">

    <ul class="list-sidebar">

        <div class="danh-muc-san-pham">
            <div class="nut-muc-luc">
                <i class="fa fa-bars" aria-hidden="true"></i>
                <span>PETSTORE</span>
            </div>
        </div>

        <!-- XUẤT DỮ LIỆU DANH MỤC SẢN PHẨM -->
        <ul>
            <?php
            $sql_danhmuc = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC";
            $query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
            while ($row = mysqli_fetch_array($query_danhmuc)) {
            ?>
                <li><a href="index.php?quanly=danhmucsanpham&id=<?php echo $row['id_danhmuc'] ?>"><?php echo $row['tendanhmuc'] ?></a></li>
            <?php
            }
            ?>
        </ul>

        <div class="banner">
            <img src="images/sidebar.webp" alt="Banner PetStore">
        </div>

        <div class="danh-muc-san-pham">
            <div class="nut-muc-luc">
                <i class="fa fa-bars" aria-hidden="true"></i>
                <span>TIN TỨC</span>

            </div>
        </div>

        <?php
        $sql_danhmuc_bv = "SELECT * FROM tbl_danhmuctintuc ORDER BY id_baiviet DESC";
        $query_danhmuc_bv = mysqli_query($mysqli, $sql_danhmuc_bv);
        while ($row = mysqli_fetch_array($query_danhmuc_bv)) {
        ?>
            <li><a href="index.php?quanly=danhmuctintuc&id=<?php echo $row['id_baiviet'] ?>"><?php echo $row['tendanhmuc_baiviet'] ?></a></li>
        <?php
        }
        ?>
    </ul>

</div>