<h1>TIN TỨC MỚI NHẤT</h1>

<?php

//  Lấy sản phẩm
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


