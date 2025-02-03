<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">

<div class="card shadow p-4" style="width: 350px;">
    <h2 class="text-center mb-4">Registrasi</h2>
    
    <form id="registForm">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukkan nama" required>
        </div>

        <div class="mb-3">
            <label for="Username" class="form-label">Username</label>
            <input type="text" id="Username" name="Username" class="form-control" placeholder="Masukkan Username" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" required>
        </div>

        <div class="mb-3">
            <label for="cnfrmPassword" class="form-label">Konfirmasi Password</label>
            <input type="password" id="cnfrmPassword" name="cnfrmPassword" class="form-control" placeholder="Masukkan kembali password" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Register</button>
    </form>

    <div class="text-center mt-3">
        <p class="mb-0">Sudah punya akun? <a href="login.php" class="text-primary">Login di sini</a></p>
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
                                    Arya Wardana - 2255201330 <br>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.getElementById('registForm').addEventListener('submit', function(e) {
        e.preventDefault();
        regist();
    });
    
    function regist() {
        const username = document.getElementById('Username').value;
        const password = document.getElementById('password').value;
        const nama = document.getElementById('nama').value;
        const confirm = document.getElementById('cnfrmPassword').value;

        // Remove any existing alerts
        const existingAlert = document.querySelector('.alert');
        if (existingAlert) {
            existingAlert.remove();
        }

        // Validate password confirmation
        if(password !== confirm) {
            const alert = document.createElement('div');
            alert.className = 'alert alert-danger mt-3';
            alert.innerHTML = 'Konfirmasi password tidak sesuai';
            document.getElementById('registForm').appendChild(alert);
            return;
        }

        const formData = new FormData();
        formData.append("Username", username);
        formData.append("password", password);
        formData.append("nama", nama);
        
        axios.post("http://localhost/Kelompok3/backend/registrasi.php", formData)
            .then(response => {
                if (response.data.status === 'success') {
                    const alert = document.createElement('div');
                    alert.className = 'alert alert-success mt-3';
                    alert.innerHTML = 'Registrasi berhasil! Mengalihkan ke halaman login...';
                    document.getElementById('registForm').appendChild(alert);
                    
                    setTimeout(() => {
                        window.location.href = './login.php';
                    }, 2000);
                } else {
                    throw new Error(response.data.message || 'Registrasi gagal');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                const alert = document.createElement('div');
                alert.className = 'alert alert-danger mt-3';
                alert.innerHTML = error.response?.data?.message || error.message;
                document.getElementById('registForm').appendChild(alert);
            });
    }
</script>
</body>
</html>