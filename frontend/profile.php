<?php 
include('header.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; }
        .profile-container { max-width: 800px; }
        .profile-image { 
            width: 150px; 
            height: 150px; 
            object-fit: cover; 
            border-radius: 50%; 
        }
        .image-upload-container { position: relative; }
        .image-upload-overlay {
            position: absolute;
            bottom: 0;
            right: 0;
            background: rgba(0,0,0,0.5);
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container profile-container my-4">
        <div class="row g-4">
            <!-- Profile Image Section -->
            <div class="col-md-4">
                <div class="card shadow-lg">
                    <div class="card-body text-center image-upload-container">
                        <img id="profileImage" src="" alt="Profile" class="profile-image mb-3">
                        <input type="file" id="imageUpload" style="display:none" accept="image/*">
                        <div class="image-upload-overlay" onclick="document.getElementById('imageUpload').click()">
                            Edit
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Details Section -->
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <form id="profileForm">
                            <div class="mb-3">
                                <label class="form-label">name</label>
                                <input type="text" class="form-control" id="name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">New Password (optional)</label>
                                <input type="password" class="form-control" id="newPassword">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="confirmPassword">
                            </div>
                            <button type="submit" class="btn btn-dark w-100">Update Profile</button>
                        </form>
                    </div>
                </div>
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

    

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
    const sessionToken = localStorage.getItem('session_token');
    const username = localStorage.getItem('username');

    if (!sessionToken || !username) {
        alert('Sesi habis. Silakan login kembali.');
        window.location.href = 'login.php';
        return;
    }

    axios.post('http://localhost/Kelompok3/backend/get_profile.php', { username: username })
    .then(response => {
        console.log('Respon get_profile:', response.data);
        
        if (response.data.status === 'success') {
            const user = response.data.user;
            document.getElementById('name').value = user.name;
            document.getElementById('username').value = username;
            
            if (user.profile_photo) {
                document.getElementById('profileImage').src = 
                    'http://localhost/Kelompok3/backend/' + user.profile_photo;
            }
        } else {
            throw new Error(response.data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Gagal memuat profil: ' + error.message);
    });
});
    // Handler Unggah Gambar
    document.getElementById('imageUpload').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const formData = new FormData();
        formData.append('profile_photo', file);
        formData.append('username', document.getElementById('username').value);

        axios.post('http://localhost/Kelompok3/backend/upload_profile_photo.php', formData, {
            headers: { 'Content-Type': 'multipart/form-data' }
        })
        .then(response => {
            if (response.data.status === 'success') {
                document.getElementById('profileImage').src = 
                    'http://localhost/Kelompok3/backend/' + response.data.photo_path;
                alert('Foto profil diperbarui');
            }
        })
        .catch(error => {
            console.error('Kesalahan unggah foto:', error);
            alert('Gagal mengunggah foto');
        });
    });

    // Handler Pembaruan Profil
    document.getElementById('profileForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const name = document.getElementById('name').value;
        const username = document.getElementById('username').value;
        const passwordBaru = document.getElementById('newPassword').value;
        const konfirmasiPassword = document.getElementById('confirmPassword').value;

        if (passwordBaru !== konfirmasiPassword) {
            alert('Kata sandi tidak cocok');
            return;
        }

        const formData = new FormData();
        formData.append('name', name);
        formData.append('username', username);
        if (passwordBaru) {
            formData.append('newPassword', passwordBaru);
        }

        axios.post('http://localhost/Kelompok3/backend/update_profile.php', formData)
            .then(response => {
                if (response.data.status === 'success') {
                    alert('Profil berhasil diperbarui');
                } else {
                    throw new Error(response.data.message);
                }
            })
            .catch(error => {
                console.error('Kesalahan:', error);
                alert('Gagal memperbarui profil: ' + error.message);
            });
    });
    </script>
</body>
</html>