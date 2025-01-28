<?php 
include '../backend/config/koneksi.php';   

$title = $_POST['title']; 
$desc = $_POST['desc']; 
$tanggal = $_POST['tanggal']; 
$content = $_POST['content'];  

// img 
$namaFile = $_FILES["url_image"]['name']; 
$tmp_name = $_FILES['url_image']['tmp_name'];
$ukuranFile = $_FILES['url_image']['size'];
$maxSize = 5 * 1024 * 1024; 

if ($ukuranFile > $maxSize) {
   echo 'Ukuran file terlalu besar. Maks 5MB';
   exit;
}

try {
   move_uploaded_file($tmp_name, 'archive/' .$namaFile);
   $statement = $db->prepare("INSERT INTO `news_catalog` (`id`, `title`, `desc`, `img`, `date`, `content`) VALUES (NULL, ?, ?, ?, ?, ?)"); 
   $statement->execute([$title, $desc, 'archive/' . $namaFile, $tanggal, $content]);
   echo $pesan = 'data berhasil ditambah';       
} catch(PDOException $e) {
   echo 'database eror' . $e->getMessage(); 
} 
?>