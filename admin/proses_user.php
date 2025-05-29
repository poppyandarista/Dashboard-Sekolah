<?php
include("koneksi.php");
$db = new database();

if (isset($_GET['aksi'])) {
    $aksi = $_GET['aksi'];
    if ($aksi == "hapus") {
        $id = $_GET['id'];

        // Ambil data user sebelum dihapus untuk notifikasi
        $user = mysqli_query($db->koneksi, "SELECT nama FROM user WHERE id='$id'");
        $data_user = mysqli_fetch_assoc($user);
        $nama_user = $data_user['nama'];

        // Hapus data
        $delete = mysqli_query($db->koneksi, "DELETE FROM user WHERE id='$id'");

        if ($delete) {
            // Set session for success message
            session_start();
            $_SESSION['delete_user_success'] = [
                'namauser' => $nama_user,
                'iduser' => $id
            ];
            header("Location: datauser.php");
            exit();
        } else {
            // Set session for error message
            session_start();
            $_SESSION['delete_user_error'] = true;
            header("Location: datauser.php");
            exit();
        }
    }
}
?>