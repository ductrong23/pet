<?php
//  Lấy sản phẩm
$sql_bv = "SELECT * FROM tbl_tintuc WHERE tbl_tintuc.id='$_GET[id]' LIMIT 1";
$query_bv_all = mysqli_query($mysqli, $sql_bv);
$query_bv = mysqli_query($mysqli, $sql_bv);

//  Lấy tên danh mục

$row_bv_title = mysqli_fetch_array($query_bv);

?>
<h3 class="tin-tuc">TIN TỨC: <i><?php echo $row_bv_title['tenbaiviet'] ?></i></h3>
<ul class="list-tin-tuc">
    <?php
    while ($row_bv = mysqli_fetch_array($query_bv_all)) {
    ?>
        <li>
            <h2><?php echo $row_bv['tenbaiviet'] ?></h2>
            <p class="title-tin-tuc-tom-tat"> <?php echo $row_bv['tomtat'] ?></p>
            <img class="hinh-anh-tin-tuc" src="admincp/modules/quanlytintuc/uploads/<?php echo $row_bv['hinhanh'] ?>">
            <p class="title-tin-tuc"> <?php echo $row_bv['noidung'] ?></p>
        </li>
    <?php
    }
    ?>
</ul>
<div class="sharing" style="margin-left: 30px">
                <strong>Chia sẻ:</strong>
                <button class="btn facebook"><i class="fa fa-facebook-square" aria-hidden="true"></i>Thích</button>
                <button class="btn google"><i class="fa fa-google" aria-hidden="true"></i> Google</button>
                <button class="btn twitter"><i class="fa fa-twitter" aria-hidden="true"></i> Tweet</button>
            </div>