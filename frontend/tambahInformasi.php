<?php include("../frontend/header.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        
        body {
            background: #f0f2f5;
            font-family: 'Inter', sans-serif;
        }
        .news-form-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            overflow: hidden;
            margin-top: 50px;
        }
        .form-header {
            background: var(--primary-gradient);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .form-body {
            padding: 40px;
        }
        .form-control, .form-label {
            border-radius: 10px;
        }
        .form-control:focus {
            border-color: #2575fc;
            box-shadow: 0 0 0 0.2rem rgba(37,117,252,0.25);
        }
        .btn-submit {
            background: var(--primary-gradient);
            border: none;
            
        }
        
        .material-icons {
            vertical-align: middle;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="news-form-container">
                    <div class="form-header bg-dark">
                        <h2 class="mb-0">
                            Tambah Informasi
                        </h2>
                    </div>
                    <div class="form-body">
                        <form id="addNewsForm">
                            <div class="mb-4">
                                <label for="title" class="form-label">Judul Informasi</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="mb-4">
                                <label for="desc" class="form-label">Deskripsi Singkat</label>
                                <textarea class="form-control" id="desc" name="desc" rows="4" required></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="content" class="form-label">Konten Lengkap</label>
                                <textarea class="form-control" id="content" name="content" rows="10" required></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="image" class="form-label">Unggah Gambar</label>
                                <input type="file" class="form-control" id="image" name="image" required>
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn btn-submit bg-dark text-white w-100 py-3" onclick="addNews()">
                                    Kirim Berita
                                </button>
                            </div>
                        </form>
                        <hr class="my-4">
                
                <div class="text-center">
                    <small class="text-muted">
                        <p class="mb-2">© 2024 Kelompok 3</p>
                        <div>
                            <div class="mt-2">
                                <small>
                                    Irpan Maulana - 22552011284<br>
                                    M Daffa Haikal Iskandar - 22552011202<br>
                                    Arya Wardana - 2255201330
                                    <br>
                                    Nuramar - 22552011291<br>
                                    Hermawan Sopian
                                    <br>
                                    Kelas_222w_UASWEB1
                                </small>
                            </div>
                        </div>
                    </small>
                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
       function addNews() {
    const title = document.getElementById('title').value;
    const desc = document.getElementById('desc').value;
    const content = document.getElementById('content').value;
    const urlImageinput = document.getElementById('image');
    const url_image = urlImageinput.files[0];
    const tanggal = new Date().toISOString().split('T')[0];

    console.log('Title:', title);
    console.log('Description:', desc);
    console.log('Content:', content);
    console.log('Image:', url_image);

    let formData = new FormData();
    formData.append('title', title);
    formData.append('desc', desc);
    formData.append('content', content);
    formData.append('url_image', url_image);
    formData.append('tanggal', tanggal);

    axios.post("http://localhost/Kelompok3/backend/tambahInfo.php", formData, {
        headers: {
            'Content-Type': 'multipart/form-data',
        }
    })
    .then(function(response) {
        console.log(response.data);
        alert(response.data);
        window.location.href = "./kelolaPage.php";
    })
    .catch(function(error) {
        console.error('Error:', error.response ? error.response.data : error.message);
        alert('Error adding news: ' + (error.response ? error.response.data : error.message));
    });
}
    </script>
</body>
</html>