<!-- <h1>LIÊN HỆ</h1>

<?php
$sql_lh = "SELECT * FROM tbl_lienhe WHERE id=1";
$query_lh = mysqli_query($mysqli, $sql_lh);
?>

<?php
while ($dong = mysqli_fetch_array($query_lh)) {
?>
    <p><?php echo $dong['thongtinlienhe'] ?></p>
<?php
}
?>

</table> -->

<!-- ĐIỀU HƯỚNG -->
<nav class="dieu-huong">
    <ul class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.php" title="Về trang chủ">Trang chủ</a>
        </li>
        <i class="fa fa-chevron-right" aria-hidden="true"></i>
        <li class="breadcrumb-item">
            <a href="#" title="Liên hệ">Liên hệ</a>
        </li>

    </ul>
</nav>


<div>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.2872163456905!2d106.61554297416001!3d10.86574548928853!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752b2a11844fb9%3A0xbed3d5f0a6d6e0fe!2zVHLGsOG7nW5nIMSQ4bqhaSBI4buNYyBHaWFvIFRow7RuZyBW4bqtbiBU4bqjaSBUaMOgbmggUGjhu5EgSOG7kyBDaMOtIE1pbmggKFVUSCkgLSBDxqEgc-G7nyAz!5e0!3m2!1svi!2s!4v1722768580222!5m2!1svi!2s" width="100%" height="500px" style="border:0; " allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d21785.60522898571!2d108.86420365367958!3d15.148055199794358!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1svi!2s!4v1723953064692!5m2!1svi!2s" width="100%" height="500px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> -->
</div>
<div style="text-align: center; margin-top: 10px; font-family: Montserrat, sans-serif;"><strong>70 Tô Ký - Tân Chánh Hiệp - Quận 12</strong></div>


<div class="thumbnail">
    <img src="images/logo2.jpg">
</div>

<div class="contact-container">
    <div class="left-section">
        <h2>Để lại lời nhắn cho chúng tôi</h2>
        <form action="#" method="post">
            <div class="input-group">
                <label for="name"><i class="fa fa-user"></i></label>
                <input type="text" id="name" name="name" placeholder="Họ và tên">
            </div>
            <div class="input-group">
                <label for="email"><i class="fa fa-envelope"></i></label>
                <input type="email" id="email" name="email" placeholder="Email đầy đủ">
            </div>
            <div class="input-group">
                <label for="phone"><i class="fa fa-phone"></i></label>
                <input type="text" id="phone" name="phone" placeholder="Số điện thoại">
            </div>
            <div class="input-group">
                <textarea id="message" name="message" placeholder="Viết lời nhắn cho chúng tôi"></textarea>
            </div>
            <button type="submit" class="nut-gui-lien-he">Gửi lời nhắn</button>
        </form>
    </div>
    <div class="right-section">
        <h2 style="text-decoration: underline; float: left">PetStore</h2>
        <div class="clear"></div>
        <div class="contact-info">
            <br>
            <p><i class="fa fa-phone" aria-hidden="true"></i> <strong>Điện thoại:</strong> 0345 584 032 / 0352 331 659</p>
            <br>
            <p><i class="fa fa-envelope" aria-hidden="true"></i><strong>Email:</strong> kinhdoanh@petstore.vn</p>
            <br>
            <p><i class="fa fa-map-marker" aria-hidden="true"></i> <strong>Địa chỉ:</strong></p>
            <ul>
                <li>Thành phố Quảng Ngãi, tỉnh Quảng Ngãi</li>
                <li>Quận 1, Thành phố Hồ Chí Minh</li>
                <li>Quận Bình Thạnh, Thành phố Hồ Chí Minh</li>
                <li>Quận 12, Thành phố Hồ Chí Minh</li>
                <li>Huyện Châu Thành, tỉnh Long An</li>
            </ul>
        </div>
    </div>
</div>