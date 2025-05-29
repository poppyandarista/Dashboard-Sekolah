<?php
session_start();

// Jika belum login, redirect ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Anda bisa menambahkan pengecekan role di sini jika diperlukan
// Contoh: if ($_SESSION['role'] != 'admin') { ... }
?>