<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
include '../backend/config/koneksi.php'; 

$username = $_POST["Username"];
$password = $_POST["password"];
$nama = $_POST["nama"];

// Validasi input
if (!isset($username, $password, $nama) || empty($username) || empty($password) || empty($nama)) {
    echo json_encode(["status" => "error", "message" => "Username, password, dan nama tidak boleh kosong"]);
    exit;
}

// Cek apakah username atau nama sudah digunakan
$checkStatement = $db->prepare("SELECT id FROM users WHERE username = ? AND name = ?");
$checkStatement->execute([$username, $nama]);

if ($checkStatement->rowCount() > 0) {
    echo json_encode(['status' => 'error', 'message' => 'Username atau nama sudah digunakan']);
    exit;
}

// Hash password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert user baru ke database
$insertStatement = $db->prepare("INSERT INTO users (username, password, name) VALUES (?, ?, ?)");
if ($insertStatement->execute([$username, $hashedPassword, $nama])) {
    echo json_encode(['status' => 'success', 'message' => 'Registrasi berhasil']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Terjadi kesalahan saat registrasi']);
}
?>
