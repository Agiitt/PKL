<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}
?>

<!DOCTYPE html>

<?php  
    include 'koneksi.php';

        $id                 = '';
        $pinjam_id          = '';
        $barang_id          = '';
        $jumlah             = '';
        $kondisi            = '';
        $guna_keperluan     = '';
        $keterangan         = '';
        
    if (isset($_GET['ubah'])) {

        $id         = $_GET['ubah'];

        $query      = "SELECT * FROM tbl_detail_pinjam WHERE id='$id';";
        $sql        = mysqli_query($conn, $query);

        $result     = mysqli_fetch_assoc($sql);


        $pinjam_id          = $result['pinjam_id'];
        $barang_id          = $result['barang_id'];
        $jumlah             = $result['jumlah'];
        $kondisi            = $result['kondisi'];
        $guna_keperluan     = $result['guna_keperluan'];
        $keterangan         = $result['keterangan'];
        
    }
?>

<?php

    $barang = "SELECT * FROM tbl_barang";
    $bar    = mysqli_query($conn, $barang);

?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="dashboard.php">PINLA</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="peminjaman.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-hand-holding-hand"></i></i></div>
                                Peminjaman
                            </a>
                            <a class="nav-link" href="kelola_barang.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-square-plus"></i></i></div>
                                Kelola Barang
                            </a>

                            <a class="nav-link" href="data_kelas.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                                Data Kelas
                            </a>
                            <a class="nav-link" href="data_siswa.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                                Data Siswa
                            </a>
                        </div>
                    </div>

                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php echo $_SESSION['username']; ?>
                    </div>
                </nav>
            </div>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Detail Peminjaman</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Mengelolah Detail Peminjaman</li>
                        </ol> <hr>
<!-- 	                        <div class="container"> -->
		                        <form method="POST" action="proses_detail_pinjam.php?id=<?php echo $_GET['id']?>" enctype="multipart/form-data"> <br>

                                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                                    <div class="row mb-3">
                                        <div class="col-sm-10">
                                            <input required name="pinjam_id" type="hidden" class="form-control" id="pinjam_id" value="<?php echo $_GET['id']; ?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="barang_id" class="col-sm-2 col-form-label">Nama Barang</label>
                                        <div class="col-sm-10">

                                            <?php 
                                                if(isset($_GET['ubah'])) {
                                            ?>

                                            <select class="form-control" name="barang_id" required id="barang_id" onchange="jumlah_stok()">

                                                <?php 
                                                    while($result = mysqli_fetch_assoc($bar)) {
                                                        if($result['id'] == $barang_id) {
                                                ?>

                                                    <option value="<?php echo $result['id']; ?>" selected><?php echo $result['nama']; ?></option>
                                                            <?php  
                                                            } else {
                                                            ?>
                                                    <option value="<?php echo $result['id']; ?>"><?php echo $result['nama']; ?></option>

                                                <?php  
                                                            } 
                                                        }
                                                ?>
                                            </select>

                                            <?php 
                                                } else {
                                            ?>

                                            <select class="form-control" name="barang_id" required id="barang_id" onchange="jumlah_stok()">
                                                <?php 
                                                    while($result = mysqli_fetch_assoc($bar)) {
                                                ?>
                                                    <option value="<?php echo $result['id']; ?>"><?php echo $result['nama']; ?></option>

                                                <?php  
                                                    }
                                                ?>
                                            </select>

                                            <?php
                                                } 
                                            ?>

                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                                        <div class="col-sm-10">
                                            <input type="number" name="jumlah" required class="form-control" id="jumlah" value="<?php echo $jumlah; ?>" placeholder="Jumlah Barang " min="1" max="10">
                                            <div id="stok" style="color: red;"> stok tersisa </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="" class="col-sm-2 col-form-label">Kondisi</label>
                                        <div class="col-sm-10">

                                                <label for="baik" class="col-sm-2 col-form-label"><input type="radio" name="kondisi" id="baik" value="baik" <?php echo ($kondisi == 'baik') ? 'checked': '';  ?>> Baik</label>

                                                <label for="rusak" class="col-sm-2 col-form-label"><input type="radio" name="kondisi" id="rusak" value="rusak" <?php echo ($kondisi == 'rusak') ? 'checked': '';  ?>> Rusak</label>

                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="guna_keperluan" class="col-sm-2 col-form-label">Guna Keperluan</label>
                                        <div class="col-sm-10">
                                            <textarea id="guna_keperluan" class="form-control" type="text" name="guna_keperluan" required placeholder="Guna Keperluan"><?php echo $guna_keperluan; ?></textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" type="text" required id="keterangan" name="keterangan" placeholder="Keterangan"><?php echo $keterangan; ?></textarea>
                                        </div>
                                    </div>
                                    
                                

                                    <div align="mb-3 row mt-4">
                                        <div class="col" align="right">

                                            <?php 
                                                if(isset($_GET['ubah'])) {
                                            ?>

                                            <button class="btn btn-primary" type="submit" name="aksi" value="edit">
                                                <i class="fa fa-check"></i>
                                                    Simpan Perubahan
                                            </button>

                                            <?php 
                                                } else {
                                            ?>

                                            <button class="btn btn-primary" type="submit" name="aksi" value="add">
                                                <i class="fa fa-check"></i>
                                                    Tambah detail
                                            </button>

                                            <?php
                                                } 
                                            ?>

                                            <a href="detail_peminjaman.php?id=<?php echo $_GET['id']; ?>" class="btn btn-danger" type="button">
                                                <i class="fa fa-reply"></i>
                                                    Batal
                                            </a>
                                        </div>
                                    </div>
                                </form>

                        
                     </div> 
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Agit 2022</div>
                        </div>
                    </div>
                </footer>
            </div>
        <script type="text/javascript" src="js/jquery-3.6.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>

        <script type="text/javascript">

            function jumlah_stok() {
                var barang = document.getElementById('barang_id').value;
                console.log(barang);
                $.ajax({
                    url: "cekStok.php",
                    method: "POST",
                    data: {juan:barang}, //data pertama (barang:) variabel, data yang kedua (:barang) nilai
                    success: function (data) {
                        var hasil = JSON.parse(data);
                        console.log(hasil);
                        document.getElementById("jumlah").value=1;
                        document.getElementById("stok").innerHTML="stok tersisa " + hasil.jumlah;
                        $("#jumlah").attr("max", hasil.jumlah);

                    }
                });
            }

        </script>
    </body>



</html>
