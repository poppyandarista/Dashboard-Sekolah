<?php
session_start();
if (isset($_POST['new_name'])) {
    $_SESSION['user']['nama'] = $_POST['new_name'];
    echo json_encode(['success' => true]);
    exit;
}
echo json_encode(['success' => false]);
?>