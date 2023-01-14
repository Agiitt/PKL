<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}
?>


<!DOCTYPE html>

<?php
    include 'koneksi.php';

    $no     = 0;

    $query  = "SELECT tbl_siswa.*, tbl_kelas.nama AS namakelas FROM tbl_siswa 
                LEFT JOIN tbl_kelas ON tbl_siswa.kelas_id = tbl_kelas.id";
                // Membuat nama kelas akan tampil sesuai yang di buat di data kelas
                

    $sql    = mysqli_query($conn, $query);

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
            <a class="navbar-brand ps-3" href="dashboard.php">PINLAN</a>
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
                        <h1 class="mt-4">Data Guru</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Mengelolah Data Guru</li>
                        </ol> <hr>
<!-- 	                        <div class="container"> -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center justify-content-between mb-0">
                                         <div class=" panel-title"><i class="fas fa-table me-1"></i>Tabel Siswa</div>
                                         <a href="tambah_siswa.php" type="button" class="btn btn-primary"> Tambah Siswa</a>
                                        </div>
                                    </div>
                                    <div class="card-body">

                                        <table id="datatablesSimple">
                                            <thead>
                                                <tr>
                                                    <th width="80px">No</th>
                                                    <th>Nama Siswa</th>
                                                    <th>NIS</th>
                                                    <th>NO telephone</th>
                                                    <th>Kelas</th>
                                                    <th>Alamat</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php 
                                                    while($result = mysqli_fetch_assoc($sql)) {
                                                ?>

                                                <tr>
                                                    <td><center><?php echo ++$no; ?></center></td>
                                                    <td><?php echo $result['nama']; ?></td>
                                                    <td><?php echo $result['nis']; ?></td>
                                                    <td><?php echo $result['no_telpon']; ?></td>
                                                    <td><?php echo $result['namakelas']; ?></td>
                                                    <td><?php echo $result['alamat']; ?></td>
                                                    
                                                    <td>
                                                        <a href="tambah_siswa.php?ubah=<?php echo $result['id']; ?>" type="button" class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class=" fa fa-solid fa-pencil" ></i></a>
                                                        <a href="proses_siswa.php?hapus=<?php echo $result['id']; ?>" type="button" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"><i class="fa fa-solid fa-trash"></i></a>
                                                    </td>
                                                </tr>

                                                <?php  
                                                    }
                                                ?>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                
<!--                         </div> -->
                        
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
