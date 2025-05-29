<?php
include("koneksi.php");
session_start();
$db = new database();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

function jsonResponse($success, $message, $data = [])
{
    header('Content-Type: application/json');
    echo json_encode(['success' => $success, 'message' => $message] + $data);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    jsonResponse(false, 'Metode request tidak valid');
}

// Validate required fields
$required = ['id', 'username', 'nama', 'role'];
foreach ($required as $field) {
    if (empty($_POST[$field])) {
        jsonResponse(false, "Field $field wajib diisi!");
    }
}

$id = $_POST['id'];
$username = trim($_POST['username']);
$nama = trim($_POST['nama']);
$role = strtolower(trim($_POST['role']));
$kodejurusan = !empty($_POST['kodejurusan']) ? $_POST['kodejurusan'] : null;
$password_changed = !empty($_POST['password']);
$password = $password_changed ? trim($_POST['password']) : null;

// Additional validation for siswa role
if ($role === 'siswa' && empty($kodejurusan)) {
    jsonResponse(false, 'Kode jurusan wajib diisi untuk siswa!');
}

try {
    // Build the update query
    $query = "UPDATE user SET username=?, nama=?, role=?, kodejurusan=?";
    $types = "ssss";
    $params = [$username, $nama, $role, $kodejurusan];

    // Add password if changed
    if ($password_changed) {
        $query .= ", password=?";
        $types .= "s";
        $params[] = $password;
    }

    $query .= " WHERE id=?";
    $types .= "i";
    $params[] = $id;

    // Prepare and execute
    $stmt = $db->koneksi->prepare($query);
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $db->koneksi->error);
    }

    $stmt->bind_param($types, ...$params);

    if (!$stmt->execute()) {
        throw new Exception("Execute failed: " . $stmt->error);
    }

    // Update session if editing current user
    // Update session if editing current user
    $responseData = [];
    // Di dalam blok try-catch di proses_edit_user.php
    // Di dalam blok try-catch di proses_edit_user.php
    if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $id) {
        $_SESSION['user'] = [
            'id' => $id,
            'username' => $username,
            'nama' => $nama, // Pastikan ini diperbarui
            'role' => $role,
            'profile_picture' => $_SESSION['user']['profile_picture'] ?? 'dist/assets/img/blank-pfp.jpeg'
        ];

        // Jika password changed, force logout
        if ($password_changed) {
            $responseData['password_changed'] = true;
            $message = 'Data berhasil diperbarui! Anda perlu login ulang karena password berubah.';
        } else {
            // Jika hanya nama yang berubah (password_changed false),
            // maka tidak perlu logout. Session sudah diperbarui di atas.
            $message = 'Data berhasil diperbarui!';
        }
    } else {
        $message = 'Data berhasil diperbarui!';
    }

    $stmt->close();
    // Di proses_edit_user.php
    // Di dalam blok try-catch di proses_edit_user.php
    jsonResponse(true, $message, [
        'password_changed' => $password_changed,
        'new_name' => $nama,
        'id' => $id // Tambahkan ID user ke response
    ]);

} catch (Exception $e) {
    error_log("Error in proses_edit_user.php: " . $e->getMessage());
    jsonResponse(false, 'Terjadi kesalahan sistem. Silakan coba lagi.');
}
?>