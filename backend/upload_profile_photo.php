<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

include 'config/koneksi.php';

try {
    $username = $_POST['username'] ?? '';
    
    // Validasi upload file
    if (!isset($_FILES['profile_photo']) || $_FILES['profile_photo']['error'] !== UPLOAD_ERR_OK) {
        throw new Exception('No file uploaded or upload error');
    }

    $file = $_FILES['profile_photo'];
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    
    if (!in_array($file['type'], $allowedTypes)) {
        throw new Exception('Invalid file type');
    }

    // Buat direktori upload jika belum ada
    $uploadDir = 'uploads/profile_photos/';
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    
    $fileName = uniqid() . '_' . $file['name'];
    $uploadPath = $uploadDir . $fileName;

    
    if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
        throw new Exception('Failed to move uploaded file');
    }

    
    $stmt = $db->prepare("UPDATE users SET profile_photo = :photo WHERE username = :username");
    $stmt->bindParam(':photo', $uploadPath, PDO::PARAM_STR);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();

    echo json_encode([
        'status' => 'success', 
        'photo_path' => $uploadPath
    ]);

} catch (Exception $e) {
    echo json_encode([
        'status' => 'error', 
        'message' => $e->getMessage()
    ]);
}
?>