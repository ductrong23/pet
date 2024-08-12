<title>Cảm ơn | PetStore</title>
<div class="cam-on">

    <div class="anh-cam-on">
        <img src="images/cam_on.gif" alt="PetStore">
    </div>

    <div class="loi-cam-on">
        <h1>Cảm ơn bạn đã mua hàng tại PetStore!</h1>
        <p>Đơn hàng của bạn đã được xác nhận và sẽ sớm được xử lý.</p>
        <p>Bạn có thể xem lại đơn hàng đã đặt <span><i><a href="index.php?quanly=lichsudonhang">Tại đây</a></i></span></p> 
        <p>Nếu bạn có bất kỳ câu hỏi nào, xin vui lòng liên hệ với chúng tôi <span><i><a href="index.php?quanly=lienhe">Tại đây</a></i></span></p>
    </div>

</div>


<!-- SẢN PHẨM GỢI Ý -->
<?php
//  Lấy sản phẩm
$sql_goiy = "SELECT * FROM tbl_sanpham, tbl_danhmuc 
WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc 
ORDER BY tbl_sanpham.id_sanpham DESC LIMIT 5";
$query_goiy = mysqli_query($mysqli, $sql_goiy);

?>
<h3 class="title-lienquan">GỢI Ý CHO BẠN</h3>
<ul class="list-product">
    <?php
    while ($row_goiy = mysqli_fetch_array($query_goiy)) {
    ?>
        <li>
            <a href="index.php?quanly=sanpham&id=<?php echo $row_goi['id_sanpham'] ?>">
                <img class="picture" src="admincp/modules/quanlysanpham/uploads/<?php echo $row_goiy['hinhanh'] ?>">
                <p class="title-product"><?php echo $row_goiy['tensanpham'] ?></p>
            </a>
            <div class="danh-gia-index">

                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>

            </div>
            <div class="disappear">
                <p class="price-product"><?php echo number_format($row_goiy['giasp'], 0, ',', '.') . ' đ' ?></p>
                <!-- <p style="text-align:center; color:brown; font-weight:bolder"><?php echo $row_goiy['tendanhmuc'] ?></p> -->
            </div>
            <div class="icons">
                <a href="index.php?quanly=sanpham&id=<?php echo $row_goiy['id_sanpham'] ?>"><i class="fa fa-search" aria-hidden="true"></i></a>
                <a href="pages/main/themgiohang.php?idsanpham=<?php echo $row_goiy['id_sanpham']; ?>"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
            </div>
        </li>

    <?php
    }
    ?>
</ul>

<br>
<div class="cua-hang">
    <a class="quay-lai" href="index.php">
        <i class="fa fa-hand-o-left" aria-hidden="true"></i>
        <span>
            <h4>TIẾP TỤC MUA HÀNG</h4>
        </span>
    </a>
</div>

<style>
    .cam-on {
        display: flex;
        justify-content: center;
    }

    .loi-cam-on {
        margin-top: 40px;
    }

</style>