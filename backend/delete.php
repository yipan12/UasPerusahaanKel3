<?php
include "../backend/config/koneksi.php";

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['id']) && !empty($data['id'])) {
    $id = intval($data['id']);
    
    try {
        $query = "DELETE FROM news_catalog WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            echo json_encode([
                "status" => "success",
                "message" => "Berita berhasil dihapus"
            ]);
        } else {
            throw new Exception("Gagal menjalankan query");
        }
    } catch (Exception $e) {
        echo json_encode([
            "status" => "error",
            "message" => "Gagal menghapus berita"
        ]);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "ID tidak ditemukan atau kosong"
    ]);
}
?>