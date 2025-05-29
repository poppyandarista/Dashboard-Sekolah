<?php
include("koneksi.php");
session_start();
$db = new database();

if (isset($_GET['kodejurusan'])) {
    $kodejurusan = $_GET['kodejurusan'];
    $jurusan = $db->tampil_data_jurusan_by_kode($kodejurusan);

    if ($jurusan) {
        ?>
        <form id="editJurusanForm">
            <input type="hidden" name="kodejurusan" value="<?php echo $jurusan['kodejurusan']; ?>">

            <div class="mb-3">
                <label for="namajurusan" class="form-label">Nama Jurusan</label>
                <input type="text" class="form-control" id="namajurusan" name="namajurusan"
                    value="<?php echo htmlspecialchars($jurusan['namajurusan']); ?>" required>
            </div>
        </form>
        <?php
    } else {
        echo '<div class="alert alert-danger">Data jurusan tidak ditemukan.</div>';
    }
} else {
    echo '<div class="alert alert-danger">Kode jurusan tidak valid.</div>';
}
?>