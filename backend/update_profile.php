<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

include 'config/koneksi.php';

try {
    $name = $_POST['name'] ?? '';
    $username = $_POST['username'] ?? '';
    $newPassword = $_POST['newPassword'] ?? '';

    // Prepare the update query
    if (!empty($newPassword)) {
        // Hash the new password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        
        $stmt = $db->prepare("UPDATE users SET name = :name, password = :password WHERE username = :username");
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
    } else {
        $stmt = $db->prepare("UPDATE users SET name = :name WHERE username = :username");
    }

    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    
    $result = $stmt->execute();

    if ($result) {
        echo json_encode([
            'status' => 'success', 
            'message' => 'Profile updated successfully'
        ]);
    } else {
        echo json_encode([
            'status' => 'error', 
            'message' => 'Failed to update profile'
        ]);
    }
} catch (PDOException $e) {
    echo json_encode([
        'status' => 'error', 
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}
?>