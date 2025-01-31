<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

include '../backend/config/koneksi.php';


$session_token = $_POST['session_token'] ?? '';

// Log token untuk debugging
error_log("Session token yang diterima: " . $session_token);

if ($session_token) {
    $statement = $db->prepare("SELECT id, username FROM users WHERE session_token = ?");
    $statement->execute([$session_token]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo json_encode(['status' => 'success', 'hasil' => ['name' => $user['username']]]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Token sesi tidak valid']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Token sesi tidak disediakan']);
}
?>
