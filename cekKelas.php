<?php  
	include 'koneksi.php';

	$kelas = $_POST['kelas']; //variabel dari tambah detail pinjams
	$query  = "SELECT * FROM tbl_siswa WHERE tbl_siswa.kelas_id='$kelas'";
	$sql 	= mysqli_query($conn, $query);

	// echo json_encode($sql);

	$siswa 		= "<option value=''>Pilih siswa</option>";

	while($result = mysqli_fetch_assoc($sql)) {
		$siswa 		.= "<option value='".$result['id']."'>".$result['nama']."</option>";

	}
 		echo $siswa;

?>