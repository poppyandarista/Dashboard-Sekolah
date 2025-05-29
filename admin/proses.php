<?php
include("koneksi.php");
$db = new database();

if (isset($_GET['aksi'])) {
    $aksi = $_GET['aksi'];
    if ($aksi == "hapus") {
        $nisn = $_GET['nisn'];

        // Ambil data siswa sebelum dihapus untuk notifikasi
        $siswa = mysqli_query($db->koneksi, "SELECT nama FROM siswa WHERE nisn='$nisn'");
        $data_siswa = mysqli_fetch_assoc($siswa);
        $nama_siswa = $data_siswa['nama'];

        // Hapus data
        $delete = mysqli_query($db->koneksi, "DELETE FROM siswa WHERE nisn='$nisn'");

        if ($delete) {
            // Set session for success message
            session_start();
            $_SESSION['delete_success'] = [
                'nama' => $nama_siswa,
                'nisn' => $nisn
            ];
            header("Location: datasiswa.php");
            exit();
        } else {
            // Set session for error message
            session_start();
            $_SESSION['delete_error'] = true;
            header("Location: datasiswa.php");
            exit();
        }
    }
}
?>