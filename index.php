<?php

session_start();

// if (isset($_SESSION['username'])) {
//     if ($_SESSION['role'] === 'admin' && (!isset($_GET['page']) || !in_array($_GET['page'], ['index','dokter','pasien', 'periksa','detail_periksa','obat','riwayat','jadwal_periksa']))) {
//         header('Location: index.php?page=dokter');
//         exit;
//     } elseif ($_SESSION['role'] === 'admin' && (!isset($_GET['page']) || !in_array($_GET['page'], ['dokter','pasien','poli','obat','jadwal_periksa']))) {
//         header('Location: index.php?page=pasien');
//         exit;
//     } elseif ($_SESSION['role'] === 'pasien' && (!isset($_GET['page']) || !in_array($_GET['page'], ['lihat_jadwal_dokter','daftar_pasien','daftar_poli_pasien','riwayat']))) {
//         header('Location: index.php?page=daftar_pasien');
//         exit;
//     }
//     if(isset($_GET['page'])&& $_GET['page']==='periksa'&& empty($_SESSION['role'])){
//         header('location: index.php?page=periksa');
//     }
    
// }
include_once("koneksi.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Informasi Poliklinik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Sistem Informasi Poliklinik</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Data Master</a>
                        <ul class="dropdown-menu">
                            <?php if ($_SESSION['role'] === 'pasien') { ?>
                                <li><a class="dropdown-item" href="index.php?page=daftar_pasien">Daftar Pasien</a></li>
                                <li><a class="dropdown-item" href="index.php?page=pasien">Pasien</a></li>
                                <li><a class="dropdown-item" href="index.php?page=daftar_poli_pasien">Daftar Poli Pasien</a></li>
                            <?php } elseif ($_SESSION['role'] === 'admin') { ?>
                                <li><a class="dropdown-item" href="index.php?page=dokter">Dokter</a></li>
                                <li><a class="dropdown-item" href="index.php?page=pasien">Pasien</a></li>
                                <li><a class="dropdown-item" href="index.php?page=periksa">Periksa</a></li>
                                <li><a class="dropdown-item" href="index.php?page=detail_periksa">Detail Periksa</a></li>
                                <li><a class="dropdown-item" href="index.php?page=obat">Obat</a></li>
                                <li><a class="dropdown-item" href="index.php?page=riwayat_periksa">Riwayat</a></li>
                                <li><a class="dropdown-item" href="index.php?page=jadwal_periksa">Jadwal Periksa</a></li>
                            <?php } elseif ($_SESSION['role'] === 'dokter') { ?>
                                <li><a class="dropdown-item" href="index.php?page=periksa">Periksa</a></li>
                                <li><a class="dropdown-item" href="index.php?page=riwayat_periksa">Riwayat</a></li>
                                <li><a class="dropdown-item" href="index.php?page=jadwal_periksa">Jadwal Periksa</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                </ul>
            </div>
                <?php
                if (isset($_SESSION['username'])) {
                    // Jika pengguna sudah login, tampilkan tombol "Logout"
                ?>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout (<?php echo $_SESSION['username'] ?>)</a>
                        </li>
                    </ul>
                <?php
                } else {
                    // Jika pengguna belum login, tampilkan tombol "Login" dan "Register"
                ?>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=register">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=login">Login</a>
                        </li>
                    </ul>
                <?php
                }
                ?>
            </div>
        </div>
    </nav>
    <main role="main" class="container">
    <?php
            if (isset($_GET['page'])) {
                include($_GET['page'] . ".php");
            } else {
                echo "<br><h2>Selamat Datang di Sistem Informasi Poliklinik";

                if (isset($_SESSION['username'])) {
                    //jika sudah login tampilkan username
                    echo ", " . $_SESSION['username'] . "</h2><hr>";
                } else {
                    echo "</h2><hr>Silakan Login untuk menggunakan sistem. Jika belum memiliki akun silakan Register terlebih dahulu.";
                }
            }
     ?>
    
</main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>