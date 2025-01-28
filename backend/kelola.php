<?php
include '../backend/config/koneksi.php';

try {
    // Ambil parameter pencarian
    $search = isset($_GET['key']) ? $_GET['key'] : '';
    
    // Query dasar
    $sql = "SELECT * FROM news_catalog";
    
    // Tambahkan kondisi pencarian jika ada
    if (!empty($search)) {
        $sql .= " WHERE title LIKE :search OR `desc` LIKE :search";
    }
    
    $stmt = $db->prepare($sql);
    
    // Bind parameter pencarian jika ada
    if (!empty($search)) {
        $searchTerm = "%$search%";
        $stmt->bindParam(':search', $searchTerm, PDO::PARAM_STR);
    }
    
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Tambahkan nomor dan format path gambar
    foreach ($data as $index => &$row) {
        $row['no'] = $index + 1;
        $row['img'] = !empty($row['img']) ? 'backend/' . $row['img'] : null;
    }
    
    header('Content-Type: application/json');
    echo json_encode($data);
    
} catch (PDOException $e) {
    header('Content-Type: application/json');
    echo json_encode(["error" => "Query gagal: " . $e->getMessage()]);
}
?>