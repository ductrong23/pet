<?php
//  Lấy sản phẩm
$sql_bv = "SELECT * FROM tbl_tintuc WHERE tbl_tintuc.id='$_GET[id]' LIMIT 1";
$query_bv_all = mysqli_query($mysqli, $sql_bv);
$query_bv = mysqli_query($mysqli, $sql_bv);

//  Lấy tên danh mục

$row_bv_title = mysqli_fetch_array($query_bv);

?>
<!-- <h3 class="tin-tuc">TIN TỨC: <i><?php echo $row_bv_title['tenbaiviet'] ?></i></h3> -->
<ul class="list-tin-tuc">
    <?php
    while ($row_bv = mysqli_fetch_array($query_bv_all)) {
    ?>

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
                <i class="fa fa-chevron-right" aria-hidden="true"></i>
                <li class="breadcrumb-item">
                    <a href="#" title="<?php echo $row_bv_title['tenbaiviet'] ?>"><?php echo $row_bv_title['tenbaiviet'] ?></a>
                </li>
            </ul>
        </nav>


        <li>
            <h2><?php echo $row_bv['tenbaiviet'] ?></h2>
            <div class="khoi-tom-tat">
                <p class="title-tin-tuc-tom-tat"> <?php echo $row_bv['tomtat'] ?></p>
            </div>
            <img class="hinh-anh-tin-tuc" src="admincp/modules/quanlytintuc/uploads/<?php echo $row_bv['hinhanh'] ?>">
            <div class="khoi-noi-dung">
                <p class="title-tin-tuc"> <?php echo $row_bv['noidung'] ?></p>
            </div>
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