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
    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-start">
        <li class="user-header text-bg-primary d-flex flex-column align-items-center p-3 text-center">
            <img src="<?php echo file_exists($_SESSION['user']['profile_picture'])
                ? htmlspecialchars($_SESSION['user']['profile_picture'])
                : 'dist/assets/img/blank-pfp.jpeg'; ?>" class="rounded-circle shadow mb-2" alt="User Image"
                style="width: 80px; height: 80px; object-fit: cover;" />
            <p class="mb-0 fw-bold">
                <?php echo htmlspecialchars($_SESSION['user']['nama']); ?>
            </p>
            <small class="text-light">
                <?php echo ucfirst(htmlspecialchars($_SESSION['user']['role'])); ?>
            </small>
        </li>

        <li class="user-footer d-flex justify-content-between px-3 py-2">
            <a href="profile.php" class="btn btn-outline-secondary btn-sm w-100 me-1">Profile</a>
            <a href="#" onclick="return confirmLogout('<?php echo htmlspecialchars($_SESSION['user']['nama']); ?>')"
                class="btn btn-outline-danger btn-sm w-100 ms-1">Sign out</a>
        </li>

    </ul>
    <script>
        // Fungsi untuk konfirmasi logout
        function confirmLogout(username) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: `Anda akan sign out dari akun ${username}.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Sign Out!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'logout.php';
                }
            });
        }
    </script>
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

<style>
    .user-menu .dropdown-menu {
        right: 0;
        left: auto;
        transform: translateX(-10%);
        /* bisa juga -100% kalau mau total ke kiri */
        min-width: 250px;
        max-width: 90vw;
        overflow: hidden;
    }

    @media (max-width: 576px) {

        /* Untuk perbaiki posisi dropdown agar tidak overflow ke kanan */
        .user-menu .dropdown-menu {
            right: 0;
            left: auto;
            transform: translateX(-80%);
            /* bisa juga -100% kalau mau total ke kiri */
            min-width: 250px;
            max-width: 90vw;
            overflow: hidden;
        }

        .dropdown-menu-lg {
            min-width: 100% !important;
            left: 0 !important;
            right: 0 !important;
        }

        .user-footer {
            flex-direction: column;
        }

        .user-footer .btn {
            width: 100% !important;
            margin: 0.25rem 0;
        }
    }
</style>