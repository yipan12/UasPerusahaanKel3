<?php
include("header.php");
include '../backend/config/koneksi.php';

$newsId = $_GET['id'];

try {
    $stmt = $db->prepare("SELECT * FROM news_catalog WHERE id = :id");
    $stmt->bindParam(':id', $newsId, PDO::PARAM_INT);
    $stmt->execute();
    $news = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$news) {
        die("Berita tidak ditemukan");
    }
} catch(PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlspecialchars($news['title']); ?></title>
    <link href="../bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h1 class="mb-4"><?php echo htmlspecialchars($news['title']); ?></h1>
                
                <?php if (!empty($news['img'])): ?>
                    <img src="http://localhost/kelompok3/backend/<?php echo htmlspecialchars($news['img']); ?>" 
                         class="img-fluid rounded mb-4" 
                         alt="Gambar Berita">
                <?php endif; ?>
                
                <div class="mb-3">
                    <strong>Tanggal:</strong> <?php echo htmlspecialchars($news['date']); ?>
                </div>
                
                <div class="mb-4">
                    <h3>Deskripsi Singkat</h3>
                    <p><?php echo htmlspecialchars($news['desc']); ?></p>
                </div>
                
                <?php if (!empty($news['content'])): ?>
                    <div class="mb-4">
                        <h3>Konten Lengkap</h3>
                        <div class="content">
                            <?php echo nl2br(htmlspecialchars($news['content'])); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>