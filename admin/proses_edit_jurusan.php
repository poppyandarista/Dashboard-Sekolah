<?php
include("koneksi.php");
session_start();
$db = new database();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kodejurusan = $_POST['kodejurusan'];
    $namajurusan = $_POST['namajurusan'];

    $query = "UPDATE jurusan SET 
              namajurusan = '$namajurusan'
              WHERE kodejurusan = '$kodejurusan'";

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