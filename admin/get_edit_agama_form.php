<?php
include("koneksi.php");
session_start();
$db = new database();

if (isset($_GET['idagama'])) {
    $idagama = $_GET['idagama'];
    $agama = $db->tampil_data_agama_by_id($idagama);

    if ($agama) {
        ?>
        <form id="editAgamaForm">
            <input type="hidden" name="idagama" value="<?php echo $agama['idagama']; ?>">

            <div class="mb-3">
                <label for="namaagama" class="form-label">Nama Agama</label>
                <input type="text" class="form-control" id="namaagama" name="namaagama"
                    value="<?php echo htmlspecialchars($agama['namaagama']); ?>" required>
            </div>
        </form>
        <?php
    } else {
        echo '<div class="alert alert-danger">Data agama tidak ditemukan.</div>';
    }
} else {
    echo '<div class="alert alert-danger">ID Agama tidak valid.</div>';
}
?>