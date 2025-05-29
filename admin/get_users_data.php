<?php
session_start();
include("koneksi.php");
$db = new database();

header('Content-Type: application/json');

$query = "SELECT u.id, u.username, u.nama, u.role, 
          IFNULL(j.namajurusan, '-') as jurusan 
          FROM user u
          LEFT JOIN jurusan j ON u.kodejurusan = j.kodejurusan";
$data = mysqli_query($db->koneksi, $query);

$result = array();
$no = 1;
while ($row = mysqli_fetch_assoc($data)) {
    $result[] = array(
        'no' => $no++,
        'username' => $row['username'],
        'nama' => $row['nama'],
        'role' => ucfirst($row['role']),
        'jurusan' => $row['jurusan'],
        'opsi' => '<button onclick="showEditForm(\'' . $row['id'] . '\')" class="btn btn-success btn-sm">Edit</button> ' .
            '<a href="#" onclick="confirmDeleteUser(\'' . $row['id'] . '\', \'' . $row['username'] . '\')" ' .
            'class="btn btn-danger btn-sm">Hapus</a>'
    );
}

echo json_encode($result);
?>