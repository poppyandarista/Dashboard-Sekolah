<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="./index.php" class="brand-link">
            <!--begin::Brand Image-->
            <img src="dist/assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image opacity-75 shadow" />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">Sekolah</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item menu-open">
                    <a href="index.php" class="nav-link active">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-table"></i>
                        <p>
                            Data
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="datasiswa.php" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Data Siswa</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-header">USER</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-gear"></i>

                        <p>
                            Setting
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="profile.php" class="nav-link">
                                <i class="nav-icon bi bi-person-circle"></i>
                                <p>Profil</p>
                            </a>
                        </li>
                        <a href="#" class="nav-link" id="signOutBtn">
                            <i class="nav-icon bi bi-box-arrow-in-right"></i>
                            <p>Sign Out</p>
                        </a>

                    </ul>
                </li>

                <script>
                    document.getElementById('signOutBtn').addEventListener('click', function (e) {
                        e.preventDefault(); // mencegah link langsung jalan

                        Swal.fire({
                            title: 'Yakin ingin keluar?',
                            text: "Kamu akan keluar dari sistem.",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Ya, keluar',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // redirect ke logout.php jika user yakin
                                window.location.href = './logout.php';
                            }
                        });
                    });
                </script>

            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->