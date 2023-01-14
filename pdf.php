<?php 
require_once __DIR__ . '/vendor/autoload.php';


require 'koneksi.php';
$query  = "SELECT tbl_detail_pinjam.*, tbl_barang.nama AS namabarang FROM tbl_detail_pinjam 
			LEFT JOIN tbl_barang ON tbl_detail_pinjam.barang_id = tbl_barang.id 
			WHERE pinjam_id = '$_GET[id]'";
$sql = mysqli_query($conn, $query);

$pinjam = "SELECT tbl_pinjam.*, tbl_kelas.nama AS namakelas, tbl_siswa.nama AS namasiswa FROM tbl_pinjam 
                LEFT JOIN tbl_kelas ON tbl_pinjam.kelas_id = tbl_kelas.id
                LEFT JOIN tbl_siswa ON tbl_pinjam.siswa_id = tbl_siswa.id 
                WHERE tbl_pinjam.id = '$_GET[id]'";
$pin = mysqli_fetch_array(mysqli_query($conn, $pinjam));



// , tbl_pinjam.tgl_kembali AS kembali


$mpdf = new \Mpdf\Mpdf();






$html = '

	<!DOCTYPE html>
		<html>
		<head>
			<title>Dafta Peminjaman</title>
		</head>

		<body>
			
			<h1>Daftar peminjaman</h1>

			<p>Nama 	: '. $pin['namasiswa'].'</p>

			<p>NIP 		: 123</p>
			<p>Jabatan 	: Siswa</p>
			<p>Instansi	: Sekolah</p>

			<table border="1" cellpadding="10" cellspacing="0">
				<thead>
					<tr>
						<th style="text-align: center;">NO</th>
						<th style="text-align: center;">Nama Barang/Alat</th>
						<th style="text-align: center;">Jumlah</th>
						<th style="text-align: center;">Tanggal Pengembalian</th>
						<th style="text-align: center;">Guna Keperluan</th>
						<th style="text-align: center;">Keterangan</th>
					</tr>
				</thead>';
					$i = 1;
					foreach( $sql as $result ) {
						$html .= '	<tbody>
										<tr>
											<td>'. $i++ .'</td>
											<td>'. $result["namabarang"] .'</td>
											<td>'. $result["jumlah"] .'</td>
											<td>'. $pin["tgl_kembali"] .'</td>
											<td>'. $result["guna_keperluan"] .'</td>
											<td>'. $result["keterangan"] .'</td>
										</tr>
									</tbody>';
					}
$html .=	'</table>
		</body>
	</html>';


$mpdf->WriteHTML($html);

$mpdf->Output();

?>