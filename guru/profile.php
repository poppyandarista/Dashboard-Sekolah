<?php
session_start();
include("koneksi.php");


// Mencegah caching halaman yang terlindungi
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.

if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'guru') {
    header("Location: ../login.php");
    exit;
}
$db = new database();

// Inisialisasi variabel error dan success
$error = '';
$success = '';

// [Kode PHP handling form submission tetap sama]
// Pastikan Anda memiliki kode yang mengatur nilai $error dan $success
// Contoh:
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user']['id'];
    $nama = $_POST['nama'];

    // Data untuk update
    $update_data = ['nama' => $nama];

    // Handle upload gambar
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['profile_picture'];

        // Validasi file
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $max_size = 2 * 1024 * 1024; // 2MB

        if (!in_array($file['type'], $allowed_types)) {
            $error = "Hanya file JPEG, PNG, GIF yang diizinkan";
        } elseif ($file['size'] > $max_size) {
            $error = "Ukuran file terlalu besar (maksimal 2MB)";
        } else {
            // Buat direktori upload jika belum ada
            $upload_dir = 'uploads/profile_pictures/';
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            // Generate nama file unik
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            $new_filename = 'profile_' . $user_id . '_' . time() . '.' . $ext;
            $destination = $upload_dir . $new_filename;

            // Pindahkan file
            if (move_uploaded_file($file['tmp_name'], $destination)) {
                // Hapus foto lama jika ada
                if (
                    !empty($_SESSION['user']['profile_picture']) &&
                    file_exists($_SESSION['user']['profile_picture']) &&
                    $_SESSION['user']['profile_picture'] != 'dist/assets/img/blank-pfp.jpeg'
                ) {
                    unlink($_SESSION['user']['profile_picture']);
                }

                $update_data['profile_picture'] = $destination;
            } else {
                $error = "Gagal mengupload gambar";
            }
        }
    }

    // Jika tidak ada error, update database
    if (empty($error)) {
        if ($db->update_profile($user_id, $update_data)) {
            // Update session
            $_SESSION['user']['nama'] = $nama;
            if (isset($update_data['profile_picture'])) {
                $_SESSION['user']['profile_picture'] = $update_data['profile_picture'];
            }
            $success = "Profil berhasil diperbarui";
        } else {
            $error = "Gagal memperbarui profil. Error: " . mysqli_error($db->koneksi);
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Edit Profil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />
    <link rel="stylesheet" href="dist/css/adminlte.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Profile Picture Styles */
        .profile-picture-container {
            position: relative;
            width: 150px;
            height: 150px;
            margin: 0 auto 20px;
        }

        .profile-picture {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            border: 5px solid #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .profile-picture-edit {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: #0d6efd;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            cursor: pointer;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        .profile-picture-edit:hover {
            background: #0b5ed7;
        }

        #profile-picture-input {
            display: none;
        }

        .card-profile {
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 0 auto;
        }
    </style>
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        <!--begin::Header-->
        <nav class="app-header navbar navbar-expand bg-body">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Start Navbar Links-->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="bi bi-list"></i>
                        </a>
                    </li>
                    <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Home</a></li>
                    <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Contact</a></li>
                </ul>
                <!--end::Start Navbar Links-->
                <!--begin::End Navbar Links-->
                <ul class="navbar-nav ms-auto">
                    <!--begin::User Menu Dropdown-->
                    <?php include 'user_menu.php'; ?>
                    <!--end::User Menu Dropdown-->
                </ul>
            </div>
            <!--end::Container-->
        </nav>
        <!--end::Header-->

        <?php include "sidebar.php"; ?>

        <!--begin::App Main-->
        <main class="app-main">
            <!--begin::App Content Header-->
            <div class="app-content-header">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Edit Profil</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Profil</li>
                            </ol>
                        </div>
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::App Content Header-->

            <!-- Main content -->
            <section class="app-content">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card card-profile">
                                <div class="card-body">
                                    <?php if (!empty($error)): ?>
                                        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                                    <?php endif; ?>
                                    <?php if (!empty($success)): ?>
                                        <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
                                    <?php endif; ?>

                                    <form action="profile.php" method="post" enctype="multipart/form-data">
                                        <div class="profile-picture-container">
                                            <img src="<?php
                                            echo isset($_SESSION['user']['profile_picture']) && file_exists($_SESSION['user']['profile_picture'])
                                                ? htmlspecialchars($_SESSION['user']['profile_picture'])
                                                : 'dist/assets/img/blank-pfp.jpeg';
                                            ?>" class="profile-picture" id="profile-picture-preview" alt="Foto Profil">
                                            <div class="profile-picture-edit"
                                                onclick="document.getElementById('profile-picture-input').click()">
                                                <i class="bi bi-camera-fill"></i>
                                            </div>
                                            <input type="file" id="profile-picture-input" name="profile_picture"
                                                accept="image/*" onchange="previewImage(this)">
                                        </div>

                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control" id="username"
                                                value="<?php echo isset($_SESSION['user']['username']) ? htmlspecialchars($_SESSION['user']['username']) : ''; ?>"
                                                disabled>
                                        </div>

                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="nama" name="nama"
                                                value="<?php echo isset($_SESSION['user']['nama']) ? htmlspecialchars($_SESSION['user']['nama']) : ''; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="role" class="form-label">Role</label>
                                            <input type="text" class="form-control" id="role"
                                                value="<?php echo isset($_SESSION['user']['role']) ? ucfirst(htmlspecialchars($_SESSION['user']['role'])) : ''; ?>"
                                                disabled>
                                        </div>

                                        <div class="d-grid gap-2">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="bi bi-save"></i> Simpan Perubahan
                                            </button>
                                            <a href="index.php" class="btn btn-secondary">
                                                <i class="bi bi-arrow-left"></i> Kembali
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <!--end::App Main-->

        <!--begin::Footer-->
        <footer class="app-footer">
            <div class="float-end d-none d-sm-inline">Anything you want</div>
            <strong>Copyright &copy; 2014-2024 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>
        <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->

    <!-- Load the same scripts as in index.php -->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
        integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
    <script src="dist/js/adminlte.js"></script>
    <script>
        // Pastikan sidebar terinisialisasi dengan benar
        document.addEventListener('DOMContentLoaded', function () {
            // Inisialisasi OverlayScrollbars untuk sidebar
            const sidebarWrapper = document.querySelector('.sidebar-wrapper');
            if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: 'os-theme-light',
                        autoHide: 'leave',
                        clickScroll: true,
                    },
                });
            }

            // Fungsi untuk preview gambar
            function previewImage(input) {
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        document.getElementById('profile-picture-preview').src = e.target.result;
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            // Attach event listener
            document.getElementById('profile-picture-input')?.addEventListener('change', function () {
                previewImage(this);
            });
        });
    </script>
</body>

</html>