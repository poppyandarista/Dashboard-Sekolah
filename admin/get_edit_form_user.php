<?php
include("koneksi.php");
session_start();
$db = new database();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = $db->tampil_data_user_by_id($id);
    $jurusan = $db->tampil_data_jurusan();

    if ($user) {
        ?>
        <form id="editForm">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username"
                    value="<?php echo htmlspecialchars($user['username']); ?>" readonly>
                <small class="text-muted">Username tidak dapat diubah</small>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Masukkan password baru (kosongkan jika tidak ingin mengubah)" value="">
                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>

            <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" name="nama"
                    value="<?php echo htmlspecialchars($user['nama']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <input type="text" class="form-control" id="role_display" value="<?php echo ucfirst($user['role']); ?>"
                    readonly>
                <input type="hidden" id="role" name="role" value="<?php echo $user['role']; ?>">
                <small class="text-muted">Role tidak dapat diubah</small>
            </div>

            <div class="mb-3" id="jurusan-container" style="<?php echo $user['role'] != 'siswa' ? 'display: none;' : ''; ?>">
                <label for="kodejurusan" class="form-label">Jurusan</label>
                <select class="form-select" id="kodejurusan" name="kodejurusan" <?php echo $user['role'] == 'siswa' ? 'required' : ''; ?>>
                    <option value="">Pilih Jurusan</option>
                    <?php foreach ($jurusan as $j): ?>
                        <option value="<?php echo $j['kodejurusan']; ?>" <?php echo $j['kodejurusan'] == $user['kodejurusan'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($j['namajurusan']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </form>

        <script>
            // Toggle password visibility
            document.getElementById('togglePassword').addEventListener('click', function () {
                const passwordInput = document.getElementById('password');
                const icon = this.querySelector('i');

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                }
            });

            // This will ensure the jurusan field is only shown for siswa role
            document.addEventListener('DOMContentLoaded', function () {
                const role = '<?php echo $user['role']; ?>';
                const jurusanContainer = document.getElementById('jurusan-container');

                if (role !== 'siswa') {
                    document.getElementById('kodejurusan').removeAttribute('required');
                }
            });
        </script>
        <?php
    } else {
        echo '<div class="alert alert-danger">Data user tidak ditemukan.</div>';
    }
} else {
    echo '<div class="alert alert-danger">ID user tidak valid.</div>';
}
?>