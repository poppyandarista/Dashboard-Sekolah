<?php
// File ini bisa di-include di semua halaman
if (!isset($_SESSION)) {
    session_start();
}

// Inisialisasi default jika session user tidak ada
if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = [
        'nama' => 'Guest',
        'role' => 'guest',
        'profile_picture' => 'dist/assets/img/blank-pfp.jpeg'
    ];

    // Jika tidak ada session user tapi ada session lama (dari kode sebelumnya)
    if (isset($_SESSION['username'])) {
        $_SESSION['user']['nama'] = $_SESSION['nama'] ?? 'Guest';
        $_SESSION['user']['role'] = $_SESSION['role'] ?? 'guest';
    }
}
?>
<li class="nav-item dropdown user-menu">
    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
        <img src="<?php echo htmlspecialchars($_SESSION['user']['profile_picture']); ?>"
            class="user-image rounded-circle shadow" alt="User Image" />
        <span class="d-none d-md-inline" id="user-name-display">
            <?php echo htmlspecialchars($_SESSION['user']['nama']); ?>
        </span>
    </a>
    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
        <li class="user-header text-bg-primary">
            <img src="<?php echo htmlspecialchars($_SESSION['user']['profile_picture']); ?>"
                class="rounded-circle shadow" alt="User Image" />
            <p>
                <?php echo htmlspecialchars($_SESSION['user']['nama']); ?> -
                <?php echo ucfirst(htmlspecialchars($_SESSION['user']['role'])); ?>
            </p>
        </li>
        <li class="user-footer">
            <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
            <a href="logout.php" onclick="confirmLogout('<?php echo htmlspecialchars($_SESSION['user']['nama']); ?>')"
                class="btn btn-default btn-flat float-end">Sign out</a>
        </li>
    </ul>
</li>


<script>
    // Jika ada nama baru di sessionStorage, gunakan itu
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof (Storage) !== 'undefined' && sessionStorage.getItem('userName')) {
            document.getElementById('user-name-display').textContent = sessionStorage.getItem('userName');
            document.querySelector('.user-header p').innerHTML =
                `${sessionStorage.getItem('userName')} - <?php echo ucfirst($_SESSION['user']['role']); ?>`;
        }
    });
</script>