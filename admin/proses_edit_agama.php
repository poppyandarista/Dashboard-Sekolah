<?php
include("koneksi.php");
session_start();
$db = new database();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idagama = $_POST['idagama'];
    $namaagama = $_POST['namaagama'];

    $query = "UPDATE agama SET 
              namaagama = '$namaagama'
              WHERE idagama = '$idagama'";

    $result = mysqli_query($db->koneksi, $query);

    if ($result) {
        echo json_encode([
            'success' => true,
            'message' => 'Data agama berhasil diperbarui!'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Gagal memperbarui data agama: ' . mysqli_error($db->koneksi)
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Metode request tidak valid'
    ]);
}
?>