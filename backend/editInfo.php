<?php
header("Access-Control-Allow-Origin: *");
include '../backend/config/koneksi.php';

try {
    // Validasi input
    if (!isset($_POST['id']) || !isset($_POST['title']) || !isset($_POST['desc']) || !isset($_POST['content'])) {
        throw new Exception('Data yang diperlukan tidak lengkap');
    }

    // Ambil dan bersihkan data - menggunakan htmlspecialchars sebagai pengganti FILTER_SANITIZE_STRING
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $title = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
    $description = htmlspecialchars($_POST['desc'], ENT_QUOTES, 'UTF-8');
    $content = $_POST['content'];
    $date = $_POST['tanggal'];

    // Cek apakah ada file gambar yang diupload
    if (isset($_FILES['url_image']) && $_FILES['url_image']['error'] === UPLOAD_ERR_OK) {
        $namafile = time() . '_' . $_FILES['url_image']['name'];
        $tmpname = $_FILES['url_image']['tmp_name'];
        $direktori = 'archive/'; // Changed from 'gambar/' to 'archive/'
        $path_gambar = $direktori . $namafile;

        // Buat direktori jika belum ada
        if (!file_exists($direktori)) {
            if (!mkdir($direktori, 0777, true)) {
                throw new Exception('Gagal membuat direktori upload');
            }
        }

        // Upload file
        if (!move_uploaded_file($tmpname, $path_gambar)) {
            throw new Exception('Gagal mengunggah file');
        }

        // Update dengan gambar baru
        $statement = $db->prepare("UPDATE news_catalog SET title=?, `desc`=?, content=?, img=?, date=? WHERE id=?");
        if (!$statement->execute([$title, $description, $content, $path_gambar, $date, $id])) {
            throw new Exception('Gagal menyimpan data dengan gambar baru');
        }
    } else {
        // Update tanpa gambar baru
        $statement = $db->prepare("UPDATE news_catalog SET title=?, `desc`=?, content=?, date=? WHERE id=?");
        if (!$statement->execute([$title, $description, $content, $date, $id])) {
            throw new Exception('Gagal menyimpan data');
        }
    }

    echo json_encode([
        "success" => true, 
        "message" => "Data berhasil diubah"
    ]);

} catch (Exception $e) {
    error_log("Error in editInfo.php: " . $e->getMessage());
    http_response_code(400);
    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);
}
?>