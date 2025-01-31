<?php
header("Access-Control-Allow-Origin: *");
include "./config/koneksi.php";

// Tangkap data dari request POST
$username = $_POST["user"] ?? null;
$password = $_POST["pwd"] ?? null;

if (!empty($username) && !empty($password)) {
    // Mengambil data pengguna dari database berdasarkan username
    $statement = $db->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $statement->execute([$username]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    // Verifikasi kata sandi
    if ($user && password_verify($password, $user['password'])) {
        // Jika verifikasi berhasil, buat token sesi baru
        $session_token = bin2hex(random_bytes(16));

        // Perbarui token sesi di database
        $updateStatement = $db->prepare("UPDATE users SET session_token = ? WHERE id = ?");
        $updateStatement->execute([$session_token, $user['id']]);

        // Respons sukses dengan token sesi
        echo json_encode(['status' => 'success', 'session_token' => $session_token]);
    } else {
        // Kredensial tidak valid
        echo json_encode(['status' => 'error', 'message' => 'Kredensial tidak valid']);
    }
} else {
    // Permintaan tidak valid
    echo json_encode(['status' => 'error', 'message' => 'Username dan password wajib diisi']);
}
?>
