<?php 
    include 'koneksi.php';

    error_reporting(1);
    if(isset($_POST['aksi'])) {
        if($_POST['aksi'] == "add") {

            $pinjam_id      = $_POST['pinjam_id'];
            $barang_id      = $_POST['barang_id'];
            $jumlah         = $_POST['jumlah'];
            $kondisi        = $_POST['kondisi'];
            $guna_keperluan = $_POST['guna_keperluan'];
            $keterangan     = $_POST['keterangan'];


            
            $sql        = "SELECT * FROM tbl_detail_pinjam WHERE barang_id='$barang_id'";
            $result     = mysqli_query($conn, $sql);

            if (!$result->num_rows > 0) {
                $sql    = "INSERT INTO tbl_detail_pinjam (pinjam_id, barang, jumlah, kondisi, guna_keperluan, keterangan) VALUES (null, '$pinjam_id', '$barang_id', '$jumlah', '$kondisi', '$guna_keperluan', '$keterangan')";
                $result = mysqli_query($conn, $sql);

                if($result) {
                    header("Location: detail_peminjaman.php?id=".$_GET['id']);
                } else {
                    echo $query;
                }
            } else {
                echo "<script>alert('Woops! Barang sudah ada.')</script>";
            }
            








            // $query          = "INSERT INTO tbl_detail_pinjam VALUE(null, '$pinjam_id', '$barang_id', '$jumlah', '$kondisi', '$guna_keperluan', '$keterangan')";
            // $sql            = mysqli_query($conn, $query);

            // if($sql) {
            //     header("Location: detail_peminjaman.php?id=".$_GET['id']);
            // } else {
            //     echo $query;
            // }

        } elseif($_POST['aksi'] == "edit"){

            $id             = $_POST['id'];
            $pinjam_id      = $_POST['pinjam_id'];
            $barang_id      = $_POST['barang_id'];
            $jumlah         = $_POST['jumlah'];
            $kondisi        = $_POST['kondisi'];
            $guna_keperluan = $_POST['guna_keperluan'];
            $keterangan     = $_POST['keterangan'];


            $query          = "UPDATE tbl_detail_pinjam SET pinjam_id='$pinjam_id', barang_id='$barang_id', jumlah='$jumlah', kondisi='$kondisi', guna_keperluan='$guna_keperluan', keterangan='$keterangan' WHERE id='$id';";
            $sql            = mysqli_query($conn, $query);

                header("Location: detail_peminjaman.php?id=".$_GET['id']);
        }
    }

    if(isset($_GET['hapus'])) {
        $id             = $_GET['hapus'];
        $query          = "DELETE FROM tbl_detail_pinjam WHERE id='$id';";
        $sql            = mysqli_query($conn, $query);

        if($sql){
        header("Location: detail_peminjaman.php?id=".$_GET['id']);
        } else {
            echo $query;
        }
    }

?>


