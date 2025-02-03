<!-- editNews.php -->
<?php 
include("../frontend/header.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Informasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-gradient: linear-gradient(45deg,rgb(0, 0, 0) 0%,rgb(49, 49, 49) 100%);
        }
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
        .form-control {
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
        .preview-image {
            max-width: 200px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="news-form-container">
                    <div class="form-header">
                        <h2 class="mb-0">Edit Informasi</h2>
                    </div>
                    <div class="form-body">
                        <form id="editNewsForm">
                            <input type="hidden" id="id" name="id">
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
                                <label for="image" class="form-label">Unggah Gambar Baru (Opsional)</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                               
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn btn-submit text-white w-100 py-3" onclick="editNews()">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                        <hr class="my-4">
                
                <div class="text-center">
                    <small class="text-muted">
                        <p class="mb-2">© 2025 Kelompok 3</p>
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
        // Get URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        const newsId = urlParams.get('id');
        
        async function getData() {
    try {
        if (!newsId) {
            alert('ID berita tidak ditemukan');
            return;
        }
        
        document.getElementById('id').value = newsId;
        
        let formData = new FormData();
        formData.append('id', newsId);
        
        const response = await axios.post(
            "http://localhost/Kelompok3/backend/selectData.php", 
            formData
        );
        
        if (response.data) {
            document.getElementById("title").value = response.data.title || '';
            document.getElementById("desc").value = response.data.desc || '';
            document.getElementById("content").value = response.data.content || '';
            
            
            if (response.data.img) {
                const previewContainer = document.createElement('div');
                previewContainer.className = 'mt-2';
                previewContainer.innerHTML = `
                    <p>Image saat ini:</p>
                    <img src="http://localhost/Kelompok3/backend/${response.data.img}" 
                         alt="Image saat ini" 
                         style="max-width: 200px; max-height: 200px;">
                `;
                document.getElementById('image').parentNode.appendChild(previewContainer);
            }
        }
    } catch (error) {
        console.error('Error:', error);
        alert("Gagal mengambil data berita: " + (error.response?.data?.error || error.message));
    }
}

async function editNews() {
    try {
        // Log semua data form
        const formData = new FormData();
        formData.append('id', document.getElementById('id').value);
        formData.append('title', document.getElementById('title').value);
        formData.append('desc', document.getElementById('desc').value);
        formData.append('content', document.getElementById('content').value);
        
        // Format tanggal
        const today = new Date();
        const formattedDate = today.getFullYear() + '-' + 
                            String(today.getMonth() + 1).padStart(2, '0') + '-' + 
                            String(today.getDate()).padStart(2, '0');
        formData.append('tanggal', formattedDate);

        // Log semua data yang akan dikirim
        console.log('=== Data yang akan dikirim ===');
        for (let pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }

        // Cek file gambar
        const imageInput = document.getElementById('image');
        if (imageInput.files.length > 0) {
            console.log('Ada file gambar yang dipilih');
            const file = imageInput.files[0];
            console.log('Ukuran file:', file.size/1024/1024, 'MB');
            console.log('Tipe file:', file.type);
            formData.append('url_image', file);
        } else {
            console.log('Tidak ada file gambar yang dipilih');
        }

        console.log('Mengirim request ke server...');
        const response = await axios.post(
            "http://localhost/Kelompok3/backend/editInfo.php",
            formData,
            {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }
        );

        console.log('Response dari server:', response.data);

        if (response.data.success) {
            alert("Berhasil mengubah informasi");
            window.location.href = './kelolaPage.php';
        } else {
            throw new Error(response.data.message || "Gagal mengubah informasi");
        }

    } catch (error) {
        console.error('Detail error:', error);
        console.error('Response error:', error.response?.data);
        alert("Gagal mengubah informasi: " + (error.response?.data?.message || error.message));
    }
}
        // Initialize the form
        window.onload = getData;
    </script>
</body>
</html>