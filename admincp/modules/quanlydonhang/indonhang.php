<?php
require '../../config/config.php';
require('../../../tfpdf/tfpdf.php');


$code = $_GET['code'];
// $sql_lietke_dh = "SELECT * FROM tbl_cart, tbl_cart_details, tbl_sanpham WHERE tbl_cart_details.id_sanpham=tbl_sanpham.id_sanpham 
// AND tbl_cart_details.code_cart='" . $code . "'  ORDER BY tbl_cart_details.id_cart_details DESC";
$sql_lietke_dh = "SELECT * FROM tbl_cart
JOIN tbl_cart_details ON tbl_cart_details.code_cart = tbl_cart.code_cart
JOIN tbl_sanpham ON tbl_cart_details.id_sanpham = tbl_sanpham.id_sanpham
WHERE tbl_cart_details.code_cart = '" . $code . "'
ORDER BY tbl_cart_details.id_cart_details DESC";
$query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);

$pdf = new tFPDF();
$pdf->AddPage("0");
// FPDF
// $pdf->SetFont('Arial','B',16); 


// tFPDF
// Add a Unicode font (uses UTF-8)
$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
$pdf->SetFont('DejaVu','',14);

$pdf->Write(10,'Đơn hàng của bạn gồm có:');
	$pdf->Ln(10);

	$width_cell=array(10,25,156,22,30,40);

    $pdf->SetFillColor(173, 216, 230); 

	$pdf->Cell($width_cell[0],10,'ID',1,0,'C',true);
	$pdf->Cell($width_cell[1],10,'Mã hàng',1,0,'C',true);
	$pdf->Cell($width_cell[2],10,'Tên sản phẩm',1,0,'C',true);
	$pdf->Cell($width_cell[3],10,'Số lượng',1,0,'C',true); 
	$pdf->Cell($width_cell[4],10,'Giá',1,0,'C',true);
	$pdf->Cell($width_cell[5],10,'Tổng tiền',1,1,'C',true); 
	
	
	$i = 0;
	while($row = mysqli_fetch_array($query_lietke_dh)){
        $fill=false;
		$i++;
	$pdf->Cell($width_cell[0],10,$i,1,0,'C',$fill);
	$pdf->Cell($width_cell[1],10,$row['code_cart'],1,0,'C',$fill);
	$pdf->Cell($width_cell[2],10,$row['tensanpham'],1,0,'C',$fill);
	$pdf->Cell($width_cell[3],10,$row['soluongmua'],1,0,'C',$fill);
	$pdf->Cell($width_cell[4],10,number_format($row['giasp']),1,0,'C',$fill);
	$pdf->Cell($width_cell[5],10,number_format($row['soluongmua']*$row['giasp']),1,1,'C',$fill);
	$fill = !$fill;

	}
	$pdf->Write(10,'Cảm ơn bạn đã đặt hàng tại PetStore.');
	$pdf->Ln(10);

$pdf->Output();
?>