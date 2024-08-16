<?php

// Lấy tất cả các danh mục sản phẩm
$sql_danhmuc = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC";
$query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);

// Hiển thị danh mục và sản phẩm
while ($row_danhmuc = mysqli_fetch_array($query_danhmuc)) {
    // Lấy thông tin danh mục
    $id_danhmuc = $row_danhmuc['id_danhmuc'];
    $tendanhmuc = $row_danhmuc['tendanhmuc'];

    // Hiển thị tên danh mục
    echo "<h3 class='title-danh-muc-tat-ca'>DANH MỤC SẢN PHẨM: " . $tendanhmuc . "</h3>";

    // Lấy các sản phẩm thuộc danh mục
    $sql_pro = "SELECT * FROM tbl_sanpham WHERE id_danhmuc='$id_danhmuc' AND tbl_sanpham.tinhtrang = 1  ORDER BY id_sanpham DESC";
    $query_pro = mysqli_query($mysqli, $sql_pro);

    // Hiển thị sản phẩm trong danh mục
    echo "<ul class='list-product'>";
    while ($row_pro = mysqli_fetch_array($query_pro)) {
        echo "<li>";
        echo "<a href='index.php?quanly=sanpham&id=" . $row_pro['id_sanpham'] . "'>";
        echo "<img src='admincp/modules/quanlysanpham/uploads/" . $row_pro['hinhanh'] . "' alt='" . $row_pro['tensanpham'] . "'>";
        echo "<p class='title-product'>" . $row_pro['tensanpham'] . "</p>";
        echo "</a>";
        echo "<p class='price-product'>" . number_format($row_pro['giasp'], 0, ',', '.') . " đ</p>";
        echo "</li>";
    }
    echo "</ul>";
}
?>
