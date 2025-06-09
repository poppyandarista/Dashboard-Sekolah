<?php
session_start();
include "koneksi.php";

$db = new database();
$query = "SELECT u.*, j.namajurusan FROM user u LEFT JOIN jurusan j ON u.kodejurusan = j.kodejurusan";
$data = mysqli_query($db->koneksi, $query);

$result = [];
$no = 1;
while ($row = mysqli_fetch_assoc($data)) {
    $result[] = [
        'no' => $no++,
        'id' => $row['id'],
        'username' => $row['username'],
        'nama' => $row['nama'],
        'role' => ucfirst($row['role']),
        'jurusan' => !empty($row['namajurusan']) ? $row['namajurusan'] : '-',
        'opsi' => '' // akan di-render di client
    ];
}

echo json_encode(['data' => $result]);
?>