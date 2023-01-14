<?php 
    include 'koneksi.php';

    error_reporting(1);
    echo $_POST['aksi'];
    if(isset($_POST['aksi'])) {
        if($_POST['aksi'] == "add") {

            $tgl_pinjam     = $_POST['tgl_pinjam'];
            $tgl_kembali    = $_POST['tgl_kembali'];
            $kelas_id       = $_POST['kelas_id'];
            $siswa_id       = $_POST['siswa_id'];
            $status         = $_POST['status'];
            

            $query          = "INSERT INTO tbl_pinjam VALUE (null, '$tgl_pinjam', '$tgl_kembali', '$kelas_id', '$siswa_id', '$status')";
            $sql            = mysqli_query($conn, $query);

            if($sql) {
                header("Location: peminjaman.php");

            } else {

                echo $query;

            }

        } else if($_POST['aksi'] == "edit"){

            $id             = $_POST['id'];
            $tgl_pinjam     = $_POST['tgl_pinjam'];
            $tgl_kembali    = $_POST['tgl_kembali'];
            $kelas_id       = $_POST['kelas_id'];
            $siswa_id       = $_POST['siswa_id'];
            $status         = $_POST['status'];
            

            $query          = "UPDATE tbl_pinjam SET tgl_pinjam='$tgl_pinjam', tgl_kembali='$tgl_kembali', kelas_id='$kelas_id', siswa_id='$siswa_id', status='$status' WHERE id='$id';";
            $sql            = mysqli_query($conn, $query);

                header("Location: peminjaman.php");

        }
    }

    if(isset($_GET['hapus'])) {
        $id             = $_GET['hapus'];
        $query          = "DELETE FROM tbl_pinjam WHERE id='$id';";
        $sql            = mysqli_query($conn, $query);

        if($sql){
        header("Location: peminjaman.php");

        } else {
            echo $query;
        }
    }

?>