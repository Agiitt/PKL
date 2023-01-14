<?php 
    include 'koneksi.php';

    error_reporting(1);
    echo $_POST['aksi'];
    if(isset($_POST['aksi'])) {
        if($_POST['aksi'] == "add") {

            $nama           = $_POST['nama'];
            $nis            = $_POST['nis'];
            $no_telpon      = $_POST['no_telpon'];
            $kelas_id       = $_POST['kelas_id'];
            $alamat         = $_POST['alamat'];
            

            $query          = "INSERT INTO tbl_siswa VALUE(null, '$nama', '$nis', '$no_telpon', '$kelas_id', '$alamat')";
            $sql            = mysqli_query($conn, $query);

            if($sql) {
                header("Location: data_siswa.php");

            } else {

                echo $query;

            }

        } else if($_POST['aksi'] == "edit"){

            $id             = $_POST['id'];
            $nama           = $_POST['nama'];
            $nis            = $_POST['nis'];
            $no_telpon      = $_POST['no_telpon'];
            $kelas_id       = $_POST['kelas_id'];
            $alamat         = $_POST['alamat'];
            
            
            

            $query          = "UPDATE tbl_siswa SET nama='$nama', nis='$nis', no_telpon='$no_telpon', kelas_id='$kelas_id', alamat='$alamat' WHERE id='$id';";
            $sql            = mysqli_query($conn, $query);

                header("Location: data_siswa.php");
        }
    }

    if(isset($_GET['hapus'])) {
        $id             = $_GET['hapus'];
        $query          = "DELETE FROM tbl_siswa WHERE id='$id';";
        $sql            = mysqli_query($conn, $query);

        if($sql){
        header("Location: data_siswa.php");

        } else {
            echo $query;
        }
    }

?>