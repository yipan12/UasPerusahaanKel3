<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

include 'config/koneksi.php';

$data = json_decode(file_get_contents('php://input'), true);
$username = $data['username'] ?? '';

try {
    
    $stmt = $db->prepare("SELECT name, profile_photo FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user) {
        echo json_encode([
            'status' => 'success', 
            'user' => $user
        ]);
    } else {
        echo json_encode([
            'status' => 'error', 
            'message' => 'User not found'
        ]);
    }
} catch (PDOException $e) {
    echo json_encode([
        'status' => 'error', 
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}
?>