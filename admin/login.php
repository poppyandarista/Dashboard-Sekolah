<?php
session_start();
include "koneksi.php";
$db = new database();

// Inisialisasi variabel error
$error = '';

// Cek jika user sudah login, redirect ke index
if (isset($_SESSION['username'])) {
    // Ambil data user dari database berdasarkan session username
    $username = $_SESSION['username'];
    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($db->koneksi, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        // Redirect berdasarkan role
        switch ($user['role']) {
            case 'admin':
                header("Location: index.php");
                break;
            case 'guru':
                header("Location: ../guru/index.php");
                break;
            case 'siswa':
                header("Location: ../siswa/index.php");
                break;
            default:
                session_destroy();
                header("Location: login.php?error=role_invalid");
        }
        exit;
    }
}

// Proses login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk memeriksa user
    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($db->koneksi, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        // Verifikasi password (gunakan password_verify jika password di-hash)
        // Di file login.php, bagian yang menangani login sukses:
        if ($password == $user['password']) {
            // Di file login.php, pastikan profile_picture di-set dengan benar
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'nama' => $user['nama'],
                'role' => $user['role'],
                'profile_picture' => !empty($user['profile_picture']) && file_exists($user['profile_picture'])
                    ? $user['profile_picture']
                    : 'dist/assets/img/blank-pfp.jpeg'
            ];
            $_SESSION['logged_in'] = true;
            $_SESSION['role'] = $user['role']; // Tambahkan ini untuk konsistensi
            // ... redirect berdasarkan role


            // Redirect berdasarkan role
            if ($user['role'] == 'admin') {
                header("Location: index.php");
            } elseif ($user['role'] == 'guru') {
                header("Location: ../guru/index.php");
            } elseif ($user['role'] == 'siswa') {
                header("Location: ../siswa/index.php");
            } else {
                // Role tidak valid
                session_destroy();
                header("Location: login.php?error=role_invalid");
            }
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />
    <link rel="stylesheet" href="dist/css/adminlte.css" />
</head>

<body class="login-page bg-body-secondary">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <a href="index.php" class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover">
                    <h1 class="mb-0"><b>Data </b>Sekolah</h1>
                </a>
            </div>
            <div class="card-body login-card-body">
                <?php if (isset($error) && $error != ''): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                <p class="login-box-msg">Login to start your session</p>
                <form action="login.php" method="post">
                    <div class="input-group mb-1">
                        <div class="form-floating">
                            <input id="loginUsername" name="username" type="text" class="form-control" placeholder=""
                                required />
                            <label for="loginUsername">Username</label>
                        </div>
                        <div class="input-group-text"><span class="bi bi-person-fill"></span></div>
                    </div>
                    <div class="input-group mb-1">
                        <div class="form-floating">
                            <input id="loginPassword" name="password" type="password" class="form-control"
                                placeholder="" required />
                            <label for="loginPassword">Password</label>
                        </div>
                        <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                    </div>
                    <div class="row">
                        <div class="col-4 offset-8">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
        integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
    <script src="dist/js/adminlte.js"></script>
</body>

</html>