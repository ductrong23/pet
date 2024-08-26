<!--    TÌM KIẾM SẢN PHẨM -->
<h1 class="title-liet-ke-san-pham">TÌM KIẾM</h1>
<form action="" method="POST">
    <input type="hidden" name="action" value="quanlysanpham">
    <input type="hidden" name="query" value="timkiem">
    <div class="tim-kiem">
        <input class="o-tim-kiem-liet-ke" type="text" name="search_query" placeholder="Tìm kiếm sản phẩm...">
        <input class="nut-tim-kiem-liet-ke" type="submit" value="Tìm kiếm">
    </div>
</form>

<?php
if (isset($_POST['search_query'])) {
    $search_query = $_POST['search_query'];
    $sql_timkiem_sp = "SELECT * FROM tbl_sanpham, tbl_danhmuc 
                      WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc 
                      AND (tensanpham LIKE '%" . $search_query . "%' 
                      OR masp LIKE '%" . $search_query . "%')
                      ORDER BY id_sanpham DESC";
} else {
    $sql_timkiem_sp = "SELECT * FROM tbl_sanpham, tbl_danhmuc 
                      WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc 
                      ORDER BY id_sanpham DESC";
}
$query_timkiem_sp = mysqli_query($mysqli, $sql_timkiem_sp);
?>

<!-- <h1 class="title-liet-ke-san-pham">TÌM KIẾM</h1> -->
<table class="bang-liet-ke" style="width:100%" border="1" style="border-collapse:collapse">
    <tr>
        <th>ID</th>
        <th>Tên sản phẩm</th>
        <th>Mã sản phẩm</th>
        <th>Giá sản phẩm</th>
        <th>Giá gốc</th>
        <th>Sale</th>
        <th>Số lượng</th>
        <th>Hình ảnh</th>
        <th>Tóm tắt</th>
        <th>Nội dung</th>
        <th>Trạng thái</th>
        <th>Danh mục</th>
        <th>Quản lý</th>
    </tr>
    <?php
    $i = 0;
    while ($row = mysqli_fetch_array($query_timkiem_sp)) {
        $i++;
    ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $row['tensanpham'] ?></td>
            <td><?php echo $row['masp'] ?></td>
            <td><?php echo $row['giasp'] ?></td>
            <td><?php echo $row['giagiam'] ?></td>
            <td><?php echo $row['phantram'] ?></td>
            <td><?php echo $row['soluong'] ?></td>
            <td><img src="modules/quanlysanpham/uploads/<?php echo $row['hinhanh'] ?>" width="150px"></td>
            <td><?php echo $row['tomtat'] ?></td>
            <td><?php echo $row['noidung'] ?></td>
            <td><?php echo ($row['tinhtrang'] == 1) ? 'Kích hoạt' : 'Ẩn'; ?></td>
            <td><?php echo $row['tendanhmuc'] ?></td>
            <td>
                <a href="?action=quanlysanpham&query=sua&idsanpham=<?php echo $row['id_sanpham'] ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> |
                <!-- <a href="modules/quanlysanpham/xuly.php?idsanpham=<?php echo $row['id_sanpham'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');"><i class="fa fa-trash-o" aria-hidden="true"></i></a> -->
                <a href="#"
                    data-url="modules/quanlysanpham/xuly.php?idsanpham=<?php echo $row['id_sanpham'] ?>"
                    onclick="handleDelete(event, this);">
                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                </a>
            </td>
        </tr>
    <?php
    }
    ?>
</table>

<!-- Modal HTML -->
<div id="popupModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p id="popupMessage"></p>
        <button id="confirmButton" class="confirm-btn">Xác nhận</button>
        <button id="cancelButton" class="cancel-btn">Hủy</button>
    </div>
</div>

<!-- Include JavaScript for popup -->
<script src="js/xemdonhang.js"></script>

<!--    LIỆT KÊ SẢN PHẨM -->

<!-- <?php
        $sql_lietke_sp = "SELECT * FROM tbl_sanpham, tbl_danhmuc 
WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc 
ORDER BY id_sanpham DESC";
        $query_lietke_sp = mysqli_query($mysqli, $sql_lietke_sp);
        ?> -->
<!-- <h1 class="title-liet-ke-san-pham">LIỆT KÊ SẢN PHẨM</h1>
<table class="bang-liet-ke" style="width:100%" border="1" style="border-collapse:collapse">
    <tr>
        <th>ID</th>
        <th>Tên sản phẩm</th>
        <th>Mã sản phẩm</th>
        <th>Giá sản phẩm</th>
        <th>Giá gốc</th>
        <th>Số lượng</th>
        <th>Hình ảnh</th>
        <th>Tóm tắt</th>
        <th>Nội dung</th>
        <th>Trạng thái</th>
        <th>Danh mục</th>
        <th>Quản lý</th>
    </tr>
    <?php
    $i = 0;
    while ($row = mysqli_fetch_array($query_lietke_sp)) {
        $i++;
    ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $row['tensanpham'] ?></td>
            <td><?php echo $row['masp'] ?></td>
            <td><?php echo $row['giasp'] ?></td>
            <td><?php echo $row['giagiam'] ?></td>
            <td><?php echo $row['soluong'] ?></td>
            <td><img src="modules/quanlysanpham/uploads/<?php echo $row['hinhanh'] ?>" width="150px"></td>
            <td><?php echo $row['tomtat'] ?></td>
            <td><?php echo $row['noidung'] ?></td>
            <td><?php if ($row['tinhtrang'] == 1) {
                    echo 'Kích hoạt';
                } else {
                    echo 'Ẩn';
                }
                ?></td>
            <td><?php echo $row['tendanhmuc'] ?></td>
            <td>
                <a href="modules/quanlysanpham/xuly.php?idsanpham=<?php echo $row['id_sanpham'] ?>">Xoá</a> |
                <a href="?action=quanlysanpham&query=sua&idsanpham=<?php echo $row['id_sanpham'] ?>">Sửa</a>
            </td>
        </tr>
    <?php
    }
    ?>
</table> -->

<style>
    .tim-kiem {
        text-align: -webkit-center;
        margin-top: 50px;
        margin-bottom: 50px;
    }

    input.o-tim-kiem-liet-ke {
        padding: 15px;
        border-radius: 20px;
        width: 300px;
        border: 2px solid black;
        font-size: medium;
    }

    input.o-tim-kiem-liet-ke:hover {
        border: 2px solid green;
    }

    input.o-tim-kiem-liet-ke:focus {
        background-color: bisque;
    }


    input.nut-tim-kiem-liet-ke {
        padding: 15px;
        border-radius: 20px;
        width: 85px;
        border: 2px solid black;
        height: calc(6 - 2px);
        transition: 0.5s;
        position: relative;
    }

    input.nut-tim-kiem-liet-ke:hover {
        scale: 1.06;
        background-color: #123f39;
        color: white
    }
</style>