<?php
include("koneksi.php");
session_start();
$db = new database();

if (isset($_GET['nisn'])) {
    $nisn = $_GET['nisn'];
    $siswa = $db->tampil_data_siswa_by_nisn($nisn);
    $jurusan = $db->tampil_data_jurusan();
    $agama = $db->tampil_data_agama();

    if ($siswa) {
        ?>
        <form id="editForm">
            <input type="hidden" name="nisn" value="<?php echo $siswa['nisn']; ?>">

            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama"
                    value="<?php echo htmlspecialchars($siswa['nama']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jeniskelamin" id="laki" value="L" <?php echo $siswa['jeniskelamin'] == 'L' ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="laki">Laki-laki</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jeniskelamin" id="perempuan" value="P" <?php echo $siswa['jeniskelamin'] == 'P' ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="perempuan">Perempuan</label>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="kodejurusan" class="form-label">Jurusan</label>
                <select class="form-select" id="kodejurusan" name="kodejurusan" required>
                    <option value="">Pilih Jurusan</option>
                    <?php foreach ($jurusan as $j): ?>
                        <option value="<?php echo $j['kodejurusan']; ?>" <?php echo $j['kodejurusan'] == $siswa['kodejurusan'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($j['namajurusan']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="kelas" class="form-label">Kelas</label>
                <input type="text" class="form-control" id="kelas" name="kelas"
                    value="<?php echo htmlspecialchars($siswa['kelas']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?php
                echo htmlspecialchars($siswa['alamat']);
                ?></textarea>
            </div>

            <div class="mb-3">
                <label for="agama" class="form-label">Agama</label>
                <select class="form-select" id="agama" name="agama" required>
                    <option value="">Pilih Agama</option>
                    <?php foreach ($agama as $a): ?>
                        <option value="<?php echo $a['idagama']; ?>" <?php echo $a['idagama'] == $siswa['agama'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($a['namaagama']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="nohp" class="form-label">No HP</label>
                <input type="text" class="form-control" id="nohp" name="nohp"
                    value="<?php echo htmlspecialchars($siswa['nohp']); ?>" required>
            </div>
        </form>
        <?php
    } else {
        echo '<div class="alert alert-danger">Data siswa tidak ditemukan.</div>';
    }
} else {
    echo '<div class="alert alert-danger">NISN tidak valid.</div>';
}
?>