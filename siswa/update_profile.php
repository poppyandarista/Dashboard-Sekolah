<?php
session_start();
include("koneksi.php");
$db = new database();

header('Content-Type: application/json');

$response = [
    'success' => false,
    'message' => 'Terjadi kesalahan'
];

try {
    if (!isset($_SESSION['user']['id'])) {
        throw new Exception('User not logged in');
    }

    $user_id = $_SESSION['user']['id'];
    $nama = $_POST['nama'] ?? $_SESSION['user']['nama'];
    $profile_picture = $_SESSION['user']['profile_picture'] ?? 'dist/assets/img/blank-pfp.jpeg';

    // Handle file upload
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['profile_picture'];

        // Validate file
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $max_size = 2 * 1024 * 1024; // 2MB

        if (!in_array($file['type'], $allowed_types)) {
            throw new Exception('Hanya file JPEG, PNG, GIF yang diizinkan');
        }

        if ($file['size'] > $max_size) {
            throw new Exception('Ukuran file terlalu besar (maksimal 2MB)');
        }

        // Create upload directory if not exists
        $upload_dir = 'uploads/profile_pictures/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Generate unique filename
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $new_filename = 'profile_' . $user_id . '_' . time() . '.' . $ext;
        $destination = $upload_dir . $new_filename;

        // Move file
        if (move_uploaded_file($file['tmp_name'], $destination)) {
            // Delete old picture if exists
            if (
                !empty($_SESSION['user']['profile_picture']) &&
                file_exists($_SESSION['user']['profile_picture']) &&
                $_SESSION['user']['profile_picture'] != 'dist/assets/img/blank-pfp.jpeg'
            ) {
                unlink($_SESSION['user']['profile_picture']);
            }

            $profile_picture = $destination;
        } else {
            throw new Exception('Gagal mengupload gambar');
        }
    }

    // Update database
    $query = "UPDATE user SET nama = ?, profile_picture = ? WHERE id = ?";
    $stmt = $db->koneksi->prepare($query);
    $stmt->bind_param('ssi', $nama, $profile_picture, $user_id);

    if ($stmt->execute()) {
        // Update session
        $_SESSION['user']['nama'] = $nama;
        $_SESSION['user']['profile_picture'] = $profile_picture;

        $response = [
            'success' => true,
            'message' => 'Profil berhasil diperbarui',
            'new_name' => $nama,
            'profile_picture' => $profile_picture,
            'role' => ucfirst($_SESSION['user']['role'])
        ];
    } else {
        throw new Exception('Gagal memperbarui database');
    }
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>