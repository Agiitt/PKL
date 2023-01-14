<?php 
    include 'koneksi.php';

    error_reporting(1);
    echo $_POST['aksi'];
    if(isset($_POST['aksi'])) {
        if($_POST['aksi'] == "add") {

            $nama           = $_POST['nama'];
            $wali_kelas     = $_POST['wali_kelas'];
            $nip            = $_POST['nip'];

            $query          = "INSERT INTO tbl_kelas VALUE(null, '$nama', '$wali_kelas', '$nip')";
            $sql            = mysqli_query($conn, $query);

            if($sql) {
                header("Location: data_kelas.php");

            } else {

                echo $query;

            }

        } else if($_POST['aksi'] == "edit"){

            $id             = $_POST['id'];
            $nama           = $_POST['nama'];
            $wali_kelas     = $_POST['wali_kelas'];
            $nip            = $_POST['nip'];

            $query          = "UPDATE tbl_kelas SET nama='$nama', wali_kelas='$wali_kelas', nip='$nip' WHERE id='$id';";
            $sql            = mysqli_query($conn, $query);

                header("Location: data_kelas.php");
        }
    }

    if(isset($_GET['hapus'])) {
        $id             = $_GET['hapus'];
        $query          = "DELETE FROM tbl_kelas WHERE id='$id';";
        $sql            = mysqli_query($conn, $query);

        if($sql){
        header("Location: data_kelas.php");
        } else {
            echo $query;
        }
    }

?>