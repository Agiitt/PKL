<?php  
	include 'koneksi.php';

	$barang = $_POST['juan']; //variabel dari tambah detail pinjams
	$query  = "SELECT * FROM tbl_barang WHERE tbl_barang.id='$barang'";
	$sql 	= mysqli_fetch_assoc(mysqli_query($conn, $query));

	echo json_encode($sql);
 

?>