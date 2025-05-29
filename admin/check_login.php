<?php
if (!isset($_SESSION)) {
    session_start();
}

// Redirect jika tidak login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Pastikan data user di session lengkap
if (!isset($_SESSION['user'])) {
    $db = new database();
    $user = $db->tampil_data_user_by_id($_SESSION['user_id']);

    if ($user) {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'username' => $user['username'],
            'nama' => $user['nama'],
            'role' => $user['role'],
            'profile_picture' => $user['profile_picture'] ?? 'dist/assets/img/blank-pfp.jpeg'
        ];
    } else {
        // Handle jika user tidak ditemukan
        session_destroy();
        header("Location: login.php");
        exit();
    }
}

// Pastikan data session konsisten dengan database
if ($_SESSION['user_id'] != $_SESSION['user']['id']) {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>