<?php 
    include 'koneksi.php';

    error_reporting(1);
    // echo $_POST['aksi'];
    if(isset($_POST['aksi'])) {
        if($_POST['aksi'] == "add") {

            $nama           = $_POST['nama'];

            $split          = explode('.', $_FILES['foto']['name']);
            $ekstensi       = $split[count($split)-1];

            $foto           = $nama.'.'.$ekstensi;
            $jumlah         = $_POST['jumlah'];

            $dir            = "img/";
            $tmpfile        = $_FILES['foto']['tmp_name'];

            move_uploaded_file($tmpfile, $dir.$foto);

            $query          = "INSERT INTO tbl_barang VALUES(null, '$foto', '$nama', '$jumlah')";
            $sql            = mysqli_query($conn, $query);

            if($sql) {
                header("Location: kelola_barang.php");

            } else {

                echo $query;

            }

        } else if($_POST['aksi'] == "edit"){

            $id             = $_POST['id'];
            $nama           = $_POST['nama'];
            $jumlah         = $_POST['jumlah'];

            $queryshow      = "SELECT * FROM tbl_barang WHERE id = '$id';";
            $sqlshow        = mysqli_query($conn, $queryshow);
            $result         = mysqli_fetch_assoc($sqlshow);

            if ($_FILES['foto']['name'] == "") {
                $foto       = $result['foto'];

            } else {

                $split      = explode('.', $_FILES['foto']['name']);
                $ekstensi   = $split[count($split)-1];

                // echo $ekstensi;

                $foto       = $_POST['nama'].'.'.$ekstensi;
                unlink("img/".$result['foto']);
                move_uploaded_file($_FILES['foto']['tmp_name'], 'img/'.$foto);

            }
                echo $foto;
            $query          = "UPDATE tbl_barang SET foto='$foto', nama='$nama', jumlah='$jumlah' WHERE id='$id'";
            $sql            = mysqli_query($conn, $query);

                header("Location: kelola_barang.php");
        }
    }

    if(isset($_GET['hapus'])) {
        $id                 = $_GET['hapus'];

        $queryshow          = "SELECT * FROM tbl_barang WHERE id='$id';";
        $sqlshow            = mysqli_query($conn, $queryshow);
        $result             = mysqli_fetch_assoc($sqlshow);

        //hapus file
        unlink("img/".$result['foto']);

        $query              = "DELETE FROM tbl_barang WHERE id='$id';";
        $sql                = mysqli_query($conn, $query);

        if($sql){
        header("Location: kelola_barang.php");
        } else {
            echo $query;
        }
    }

?>