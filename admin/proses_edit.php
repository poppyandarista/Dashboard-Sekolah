<?php
include("koneksi.php");
session_start();
$db = new database();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nisn = $_POST['nisn'];
    $nama = $_POST['nama'];
    $jeniskelamin = $_POST['jeniskelamin'];
    $kodejurusan = $_POST['kodejurusan'];
    $kelas = $_POST['kelas'];
    $alamat = $_POST['alamat'];
    $agama = $_POST['agama'];
    $nohp = $_POST['nohp'];

    $query = "UPDATE siswa SET 
              nama = '$nama',
              jeniskelamin = '$jeniskelamin',
              kodejurusan = '$kodejurusan',
              kelas = '$kelas',
              alamat = '$alamat',
              agama = '$agama',
              nohp = '$nohp'
              WHERE nisn = '$nisn'";

    $result = mysqli_query($db->koneksi, $query);

    if ($result) {
        echo json_encode([
            'success' => true,
            'message' => 'Data berhasil diperbarui!'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Gagal memperbarui data: ' . mysqli_error($db->koneksi)
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Metode request tidak valid'
    ]);
}
?>