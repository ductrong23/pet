
<!-- ĐIỀU HƯỚNG -->
<nav class="dieu-huong">
    <ul class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.php" title="Về trang chủ">Trang chủ</a>
        </li>
        <i class="fa fa-chevron-right" aria-hidden="true"></i>
        <li class="breadcrumb-item">
            <a href="index.php?quanly=tintuc_menu" title="Tin tức">Tin tức</a>
        </li>
    </ul>
</nav>


<h1 style="text-align: center; font-weight: bold; margin-top: 20px; margin-bottom: 10px; font-size: 25px; color: #123f39; font-family: Montserrat, sans-serif;">TIN TỨC MỚI NHẤT</h1>

<?php

//  Lấy tất cả tin tức ở menu TIN TỨC
$sql_bv = "SELECT * FROM tbl_tintuc WHERE tinhtrang=1 ORDER BY id DESC";
$query_bv = mysqli_query($mysqli, $sql_bv);

?>

<ul class="list-tin-tuc-moi-nhat">
    <?php
    while ($row_bv = mysqli_fetch_array($query_bv)) {
    ?>
        <li>
            <a href="index.php?quanly=tintuc&id=<?php echo $row_bv['id'] ?>">
                <img src="admincp/modules/quanlytintuc/uploads/<?php echo $row_bv['hinhanh']?>">
                <p class="title-tin-tuc-moi-nhat"><?php echo $row_bv['tenbaiviet']?></p>
            </a>
            <p class="title-tin-tuc-moi-nhat"><?php echo $row_bv['tomtat']?></p>
        </li>
    <?php
    }
    ?>
</ul>


