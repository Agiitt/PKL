<?php  
	// Include the main TCPDF library (search for installation path).
	// require_once("tcpdf/tcpd.php");
	include 'tcpdf/tcpdf.php';
	include 'koneksi.php';

	$query 	= "SELECT * FROM tbl_detail_pinjam";

	// create new PDF document
	$pdf 		= new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	// set document information
	$pdf->setCreator(PDF_CREATOR);
	$pdf->setAuthor('Juan Agit Kurniawan');
	$pdf->setTitle('Print PDF');
	$pdf->setSubject('Siswa');
	$pdf->setKeywords('hello');

	// Set font
	// dejavusans is a UTF-8 Unicode font, if you only need to
	// print standard ASCII chars, you can use core fonts like
	// helvetica or times to reduce file size.
	$pdf->SetFont('times', '', 12, '', true);

	$pdf->setPrintHeader(false);

	// Add a page
	// This method has several options, check the source code documentation for more information.
	$pdf->AddPage();

	// Set some content to print
	$html = <<<EOD

	<!DOCTYPE html>
	<html>
		<head>
			<title>Data Peminjaman</title>
		</head>

		<body>
			<h1>Daftar peminjaman</h1>

			<p>Nama 		:</p>
			<p>NIP 		:</p>
			<p>Jabatan 	:</p>
			<p>Instansi	:</p>

			<table border="1">
				<thead>
					<tr>
						<th style="text-align: center;">NO</th>
						<th style="text-align: center;">Nama Barang/Alat</th>
						<th style="text-align: center;">Jumlah</th>
						<th style="text-align: center;">Tanggal Pengembalian</th>
						<th style="text-align: center;">Guna Keperluan</th>
						<th style="text-align: center;">Keterangan</th>
					</tr>
				</thead>
				<tbody>

				</tbody>
			</table>
		</body>
	</html>


	EOD;


	// Print text using writeHTMLCell()
	$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

	// Close and output PDF document
	// This method has several options, check the source code documentation for more information.
	$pdf->Output('data customer.pdf', 'I'); // Huruf 'I' digunakan untuk menampilkan interview yang ingin di download
											// huruf 'D' digunakan untuk mendownload data

?>

<table >
			 	<tr>
			 		<td style="width:10%; text-align: center;"><img src="img/qw.jpg" alt="" style="width: 90px; height: 90px"></td>
			 		<td style=" text-align: center;"><b>PEMERINTAH PROVINSI SULAWESI TENGGARA DINAS PENDIDIKAN DAN KEBUDAYAAN SEKOLAH MENENGAH KEJURUAN NEGERI 3 KENDARI JL. Budi Utomo No.1 Telp./Fax. (0401) 3191136 Kendari 93117 </b> </td>
			 		<td style="width:10%; text-align: center;"><img src="img/logo.png" alt="" style="width: 90px; height: 90px"></td>
			 	</tr>
			</table> <br> <hr>


