<!-- <h1>CHI TIẾT SẢN PHẨM</h1> -->

<?php
$sql_chitiet = "SELECT * FROM tbl_sanpham, tbl_danhmuc 
WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc 
AND tbl_sanpham.id_sanpham='$_GET[id]'
AND tbl_sanpham.tinhtrang = 1 
 LIMIT 1";
$query_chitiet = mysqli_query($mysqli, $sql_chitiet);

while ($row_chitiet = mysqli_fetch_array($query_chitiet)) {
?>

    <!-- ĐIỀU HƯỚNG -->
    <nav class="dieu-huong">
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.php" title="Về trang chủ">Trang chủ</a>
            </li>
            <i class="fa fa-chevron-right" aria-hidden="true"></i>
            <li class="breadcrumb-item">
                <a href="index.php?quanly=danhmuc&id=<?php echo $row_chitiet['id_danhmuc'] ?>" title="<?php echo $row_chitiet['tendanhmuc'] ?>"><?php echo $row_chitiet['tendanhmuc'] ?></a>
            </li>
            <i class="fa fa-chevron-right" aria-hidden="true"></i>
            <li class="breadcrumb-item">
                <a href="index.php?quanly=sanpham&id=<?php echo $row_chitiet['id_sanpham'] ?>" title="<?php echo $row_chitiet['tensanpham'] ?>"><?php echo $row_chitiet['tensanpham'] ?></a>
            </li>
        </ul>
    </nav>

    <!-- HIỆN CHI TIẾT SẢN PHẨM -->
    <div class="wrapper-chi-tiet">
        <div class="hinh-anh-san-pham">
            <img src="admincp/modules/quanlysanpham/uploads/<?php echo $row_chitiet['hinhanh'] ?>" alt="" width="100%">
        </div>
        <!-- <form method="POST" action="pages/main/themgiohang.php?idsanpham=<?php echo $row_chitiet['id_sanpham'] ?>&action=muangay"> -->

        <form method="POST" action="pages/main/themgiohang.php">
            <input type="hidden" name="idsanpham" value="<?php echo $row_chitiet['id_sanpham'] ?>">
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
                <p>Mã sản phẩm: <span style="color: green"><?php echo $row_chitiet['masp'] ?></p></span>
                <p>Giá: <span style="color:green"><?php echo number_format($row_chitiet['giasp'], 0, ',', '.') . ' đ' ?></span></p>
                <!-- <p>Số lượng sản phẩm: <?php echo $row_chitiet['soluong'] ?></p> -->
                <p>Danh mục sản phẩm: <span style="color:green"><?php echo $row_chitiet['tendanhmuc'] ?></span></p>
                <!-- <p>Số lượng sản phẩm: <span style="color:green"><?php echo $row_chitiet['soluong'] ?></span></p>
                <div class="nut">
                    <p><input type="submit" class="them-gio-hang" name="themgiohang" value="Thêm vào giỏ"></p>
                    <p><input type="submit" class="mua-hang" name="muangay" value="Mua ngay"></p>
                </div> -->
                <?php if ($row_chitiet['soluong'] > 0) { ?>
                    <p>Số lượng sản phẩm: <span style="color:green"><?php echo $row_chitiet['soluong'] ?></span></p>
                    <p>Tình trạng: <span style="color: green">Còn hàng</span></p>
                    <div class="nut">
                        <p><input type="submit" class="them-gio-hang" name="themgiohang" value="Thêm vào giỏ"></p>
                        <p><input type="submit" class="mua-hang" name="muangay" value="Mua ngay"></p>
                    </div>
                <?php } else { ?>
                    <p>Tình trạng: <span style="color: red">Hết hàng</span></p>
                <?php } ?>


            </div>


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
        <div class="thong-tin-san-pham" style="width: 90%; margin: 0 auto; text-align: justify">
            <h2 style="text-align: center; font-size: 25px; color: #123f39; font-family: Montserrat, sans-serif;">
                Thông tin sản phẩm
            </h2>
            <?php echo $row_chitiet['tomtat'] ?>
            <br>
            <?php echo $row_chitiet['noidung'] ?>
            <br><br>
        </div>
    </div>
<?php
}
?>


<!-- ĐÁNH GIÁ SẢN PHẨM -->

<div class="review-section">
    <h2>Đánh giá sản phẩm</h2>
    <div class="rating-summary">
        <div class="overall-rating">
            <span class="rating-number">4.9 <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i></span>
            <div class="stars">
                <div class="filled-stars" style="width: 84%;"></div>
            </div>
        </div>
        <div class="rating-breakdown">
            <div class="rating-bar">
                <span>5<i class="fa fa-star" aria-hidden="true"></i></span>
                <div class="bar">
                    <div class="filled-bar" style="width: 80%;"></div>
                </div>
                <span>80%</span>
            </div>
            <div class="rating-bar">
                <span>4<i class="fa fa-star" aria-hidden="true"></i></span>
                <div class="bar">
                    <div class="filled-bar" style="width: 15%;"></div>
                </div>
                <span>15%</span>
            </div>
            <div class="rating-bar">
                <span>3<i class="fa fa-star" aria-hidden="true"></i></span>
                <div class="bar">
                    <div class="filled-bar" style="width: 3%;"></div>
                </div>
                <span>3%</span>
            </div>
            <div class="rating-bar">
                <span>2<i class="fa fa-star" aria-hidden="true"></i></span>
                <div class="bar">
                    <div class="filled-bar" style="width: 1%;"></div>
                </div>
                <span>1%</span>
            </div>
            <div class="rating-bar">
                <span>1<i class="fa fa-star" aria-hidden="true"></i></span>
                <div class="bar">
                    <div class="filled-bar" style="width: 1%;"></div>
                </div>
                <span>1%</span>
            </div>
        </div>
    </div>

    <button class="see-more-reviews">Xem 100 đánh giá</button>
    <button class="write-review">Viết đánh giá</button>
</div>


<!-- SẢN PHẨM LIÊN QUAN -->
<?php
$sql_chitiet = "SELECT * FROM tbl_sanpham, tbl_danhmuc 
                WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc 
                AND tbl_sanpham.id_sanpham='$_GET[id]'
                AND tbl_sanpham.tinhtrang = 1 
                 LIMIT 1";
$query_chitiet = mysqli_query($mysqli, $sql_chitiet);

$row_chitiet = mysqli_fetch_array($query_chitiet);

if ($row_chitiet) {
    // Đảm bảo $row_chitiet có dữ liệu trước khi sử dụng
    $id_danhmuc_hientai = $row_chitiet['id_danhmuc'];

    // SẢN PHẨM LIÊN QUAN
    $sql_lienquan = "SELECT * FROM tbl_sanpham 
                     WHERE id_danhmuc='$id_danhmuc_hientai' 
                     AND id_sanpham != '$_GET[id]' 
                     AND tbl_sanpham.tinhtrang = 1 
                     ORDER BY id_sanpham DESC LIMIT 5";
    $query_lienquan = mysqli_query($mysqli, $sql_lienquan);
?>
    <!-- Hiển thị sản phẩm liên quan -->
    <h3 class="title-lienquan">SẢN PHẨM LIÊN QUAN</h3>
    <ul class="list-product-lien-quan">
        <?php
        while ($row_lienquan = mysqli_fetch_array($query_lienquan)) {
        ?>
            <li>
                <a href="index.php?quanly=sanpham&id=<?php echo $row_lienquan['id_sanpham'] ?>">
                    <img class="picture" src="admincp/modules/quanlysanpham/uploads/<?php echo $row_lienquan['hinhanh'] ?>">
                    <p class="title-product-lien-quan"><?php echo $row_lienquan['tensanpham'] ?></p>
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
                </div>
                <div class="icons">
                    <a href="index.php?quanly=sanpham&id=<?php echo $row_lienquan['id_sanpham'] ?>"><i class="fa fa-search" aria-hidden="true"></i></a>
                    <a href="pages/main/themgiohang.php?idsanpham=<?php echo $row_lienquan['id_sanpham']; ?>"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
                </div>
            </li>
        <?php
        }
        ?>
    </ul>
<?php
} else {
    echo "<p >Không tìm thấy chi tiết sản phẩm.</p>";
}
?>