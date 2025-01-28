<?php
header("Access-Control-Allow-Origin: *");
include '../backend/config/koneksi.php';

$id = isset($_POST['id']) ? $_POST['id'] : null;

try {
    if (!$id) {
        throw new Exception('ID tidak ditemukan');
    }

    $statement = $db->prepare("SELECT * FROM `news_catalog` WHERE id = ?");
    $statement->execute([$id]);
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        echo json_encode($result);
    } else {
        echo json_encode(["error" => "Data tidak ditemukan"]);
    }
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(["error" => $e->getMessage()]);
}
?>