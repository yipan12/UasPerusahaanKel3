
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">

<div class="card shadow p-4" style="width: 350px;">
    <h2 class="text-center mb-4">Login</h2>

    <form id="loginForm">
        <div class="mb-3">
            <label for="user" class="form-label">Username*</label>
            <input type="text" id="user" name="user" class="form-control" placeholder="Masukkan Username" required>
        </div>

        <div class="mb-3">
            <label for="pwd" class="form-label">Password*</label>
            <input type="password" id="pwd" name="pwd" class="form-control" placeholder="Masukkan Password" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>

    <div class="text-center mt-3">
        <p class="mb-0">Belum punya akun? <a href="registrasi.php" class="text-primary">Registrasi di sini</a></p>
    </div>

    <div class="text-center mt-4 text-muted">
        <p>&copy; CoreTech Solution</p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        e.preventDefault(); 
        login();
    });

    function login() {
        const username = document.getElementById('user').value; 
        const password = document.getElementById('pwd').value;

        // Remove any existing alerts
        const existingAlert = document.querySelector('.alert');
        if (existingAlert) {
            existingAlert.remove();
        }

        const formData = new FormData();
        formData.append('user', username);
        formData.append('pwd', password);

        axios.post('http://localhost/Kelompok3/backend/login.php', formData)
            .then(response => {
                if (response.data.status === 'success') {
                    const sessionToken = response.data.session_token;
                    localStorage.setItem('session_token', sessionToken);
                    localStorage.setItem('username', username);
                    window.location.href = 'index.php';
                } else {
                    throw new Error(response.data.message || 'Login failed');
                }
            })
            .catch(error => {
                console.error(error);
                const alert = document.createElement('div');
                alert.className = 'alert alert-danger mt-3';
                alert.innerHTML = `<i class="fas fa-exclamation-circle me-2"></i>${error.response?.data?.message || error.message}`;
                document.getElementById('loginForm').appendChild(alert);
            });
    }
</script>

</body>
</html>