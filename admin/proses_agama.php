<?php
include("koneksi.php");
$db = new database();

if (isset($_GET['aksi'])) {
    $aksi = $_GET['aksi'];
    if ($aksi == "hapus") {
        $idagama = $_GET['idagama'];

        // Ambil data agama sebelum dihapus untuk notifikasi
        $agama = mysqli_query($db->koneksi, "SELECT namaagama FROM agama WHERE idagama='$idagama'");
        $data_agama = mysqli_fetch_assoc($agama);
        $nama_agama = $data_agama['namaagama'];

        // Hapus data
        $delete = mysqli_query($db->koneksi, "DELETE FROM agama WHERE idagama='$idagama'");

        if ($delete) {
            // Set session for success message
            session_start();
            $_SESSION['delete_agama_success'] = [
                'namaagama' => $nama_agama,
                'idagama' => $idagama
            ];
            header("Location: dataagama.php");
            exit();
        } else {
            // Set session for error message
            session_start();
            $_SESSION['delete_agama_error'] = true;
            header("Location: dataagama.php");
            exit();
        }
    }
}
?>