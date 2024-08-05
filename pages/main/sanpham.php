<!-- <h1>CHI TIẾT SẢN PHẨM</h1> -->


<?php
$sql_chitiet = "SELECT * FROM tbl_sanpham, tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc AND tbl_sanpham.id_sanpham='$_GET[id]' LIMIT 1";
$query_chitiet = mysqli_query($mysqli, $sql_chitiet);

while ($row_chitiet = mysqli_fetch_array($query_chitiet)) {
?>
    <div class="wrapper-chi-tiet">
        <div class="hinh-anh-san-pham">
            <img src="admincp/modules/quanlysanpham/uploads/<?php echo $row_chitiet['hinhanh'] ?>" alt="" width="100%">
        </div>
        <form method="POST" action="pages/main/themgiohang.php?idsanpham=<?php echo $row_chitiet['id_sanpham'] ?>">
            <div class="chi-tiet-san-pham">
                <h2><?php echo $row_chitiet['tensanpham'] ?></h2>
                <div class="danh-gia">
                    <p>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <span>(100 đánh giá)</span>
                    </p>
                </div>
                <p>Mã sản phẩm: <?php echo $row_chitiet['masp'] ?></p>
                <p>Giá: <?php echo number_format($row_chitiet['giasp'], 0, ',', '.') . ' đ' ?></p>
                <!-- <p>Số lượng sản phẩm: <?php echo $row_chitiet['soluong'] ?></p> -->
                <p>Danh mục sản phẩm: <?php echo $row_chitiet['tendanhmuc'] ?></p>
                <div class="nut">
                    <p><input type="submit" class="them-gio-hang" name="themgiohang" value="Thêm vào giỏ"></p>
                    <p><input type="submit" class="mua-hang" name="themgiohang" value="Mua ngay"></p>
                </div>
            </div>
            
            <!-- <hr style="width:45%; font-weight:bolder"> -->
            
            <!-- ADD -->
            <!-- <div class="tags-and-sharing"> -->
            
            <div class="sharing">
                <strong>Chia sẻ:</strong>
                <button class="btn facebook"><i class="fa fa-facebook-square" aria-hidden="true"></i>Thích</button>
                <button class="btn google"><i class="fa fa-google" aria-hidden="true"></i> Google</button>
                <button class="btn twitter"><i class="fa fa-twitter" aria-hidden="true"></i> Tweet</button>
            </div>
            <div class="payment-methods">
                <strong>Các phương thức thanh toán (an toàn):</strong><br>
                <img src="images/amazon.png" alt="Amazon Pay">
                <img src="images/apple_pay.png" alt="Apple Pay">
                <img src="images/bitcoin.png" alt="Bitcoin">
                <img src="images/google_pay.png" alt="Google Pay">
                <img src="images/paypal.png" alt="Paypal">
                <img src="images/visa.png" alt="Visa">
            </div>
            <!-- </div> -->
        </form>

        <!-- ADD -->
        <div class="clear"></div>
        <div class="thong-tin-san-pham">
            <h2 style="text-align: center;">Thông tin sản phẩm</h2>
            <?php echo $row_chitiet['tomtat'] ?>
            <br><br>
            <?php echo $row_chitiet['noidung'] ?>
            <br><br>
        </div>
    </div>
<?php
}
?>


<!-- SẢN PHẨM LIÊN QUAN -->
<?php
//  Lấy sản phẩm
$sql_lienquan = "SELECT * FROM tbl_sanpham, tbl_danhmuc 
WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc 
ORDER BY tbl_sanpham.id_sanpham DESC LIMIT 5";
$query_lienquan = mysqli_query($mysqli, $sql_lienquan);

?>
<h3>SẢN PHẨM LIÊN QUAN</h3>
<ul class="list-product">
    <?php
    while ($row_lienquan = mysqli_fetch_array($query_lienquan)) {
    ?>
        <li>
            <a href="index.php?quanly=sanpham&id=<?php echo $row_lienquan['id_sanpham'] ?>">
                <img class="picture" src="admincp/modules/quanlysanpham/uploads/<?php echo $row_lienquan['hinhanh'] ?>">
                <p class="title-product"><?php echo $row_lienquan['tensanpham'] ?></p>
            </a>
            <div class="danh-gia-index">

                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>

            </div>
            <div class="disappear">
                <p class="price-product"><?php echo number_format($row_lienquan['giasp'], 0, ',', '.') . ' đ' ?></p>
                <!-- <p style="text-align:center; color:brown; font-weight:bolder"><?php echo $row_lienquan['tendanhmuc'] ?></p> -->
            </div>
            <div class="icons">
                <i class="fa fa-heart" aria-hidden="true"></i>
                <i class="fa fa-shopping-basket" aria-hidden="true"></i>
            </div>
        </li>

    <?php
    }
    ?>
</ul>


