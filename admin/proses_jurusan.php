<?php
include("koneksi.php");
$db = new database();

if (isset($_GET['aksi'])) {
    $aksi = $_GET['aksi'];
    if ($aksi == "hapus") {
        $kodejurusan = $_GET['kodejurusan'];

        // Ambil data jurusan sebelum dihapus untuk notifikasi
        $jurusan = mysqli_query($db->koneksi, "SELECT namajurusan FROM jurusan WHERE kodejurusan='$kodejurusan'");
        $data_jurusan = mysqli_fetch_assoc($jurusan);
        $nama_jurusan = $data_jurusan['namajurusan'];

        // Hapus data
        $delete = mysqli_query($db->koneksi, "DELETE FROM jurusan WHERE kodejurusan='$kodejurusan'");

        if ($delete) {
            // Set session for success message
            session_start();
            $_SESSION['delete_jurusan_success'] = [
                'namajurusan' => $nama_jurusan,
                'kodejurusan' => $kodejurusan
            ];
            header("Location: datajurusan.php");
            exit();
        } else {
            // Set session for error message
            session_start();
            $_SESSION['delete_jurusan_error'] = true;
            header("Location: datajurusan.php");
            exit();
        }
    }
}
?>