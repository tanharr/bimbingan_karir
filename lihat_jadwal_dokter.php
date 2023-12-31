<?php
if (!isset($_SESSION)) {
    session_start();
}

?>
</main>
<div class="container">
    <!--Form Input Data-->
    <h2>Jadwal Praktek</h2>
<br>
    <?php
include'koneksi.php';
?>
<body>
<div class="container">
    <form class="form row"  method="POST" action="" name="myForm" onsubmit="return(validate());">
    <!-- Kode php untuk menghubungkan form dengan database -->
    <?php
    $id_dokter= '';
    $hari= '';
    $jam_mulai = '';
    $jam_selesai ='';
    if (isset($_GET['id'])) {
        $ambil = mysqli_query($mysqli, 
        "SELECT * FROM jadwal_periksa 
        WHERE id='" . $_GET['id'] . "'");
        while ($row = mysqli_fetch_array($ambil)) {
            $id_dokter = $row['id_dokter'];
            $hari = $row['hari'];
            $jam_mulai = $row['jam_mulai'];
            $jam_selesai= $row['jam_selesai'];
        }
    ?>
        <input type="hidden" name="id" value="<?php echo
        $_GET['id'] ?>">
    <?php
    }
    ?>
   
    <br>
    <br>
    <!-- Table-->
    <table class="table table-hover">
    <table class="table table-hover">
    <!--thead atau baris judul-->
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama Dokter</th>
            <th scope="col">Hari</th>
            <th scope="col">Jam Mulai</th>
            <th scope="col">Jam Selesai</th>
        </tr>
    </thead>
        <!--thead atau baris judul-->
        <tbody>
    <?php
    $result = mysqli_query($mysqli, "SELECT dp.*, p.nama as 'nama_dokter' FROM jadwal_periksa dp LEFT JOIN dokter p ON (dp.id_dokter=p.id) ORDER BY id ASC");

    if (!$result) {
        die("Error: " . mysqli_error($mysqli));
    }
    
    if (mysqli_num_rows($result) > 0) {
        $no = 1;
        while ($data = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . $data['nama_dokter'] . "</td>";
            echo "<td>" . $data['hari'] . "</td>";
            echo "<td>" . $data['jam_mulai'] . "</td>"; // 'keluhan' instead of 'Keluhan'
            echo "<td>" . $data['jam_selesai'] . "</td>";
            echo "<td>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "No rows returned.";
    }
    
    ?>
    </tbody>
    </table>