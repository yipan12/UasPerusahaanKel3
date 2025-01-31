<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sessionToken = localStorage.getItem('session_token');
            if (!sessionToken) {
                window.location.href = 'login.php';
                return;
            }

            const formData = new FormData();
            formData.append('session_token', sessionToken);

            axios.post('http://localhost/Kelompok3/backend/sesion.php', formData)
                .then(response => {
                    if (response.data.status === 'success') {
                        localStorage.setItem('name', response.data.hasil.name);
                        window.location.href = './landingPage.php';
                    } else {
                        throw new Error(response.data.message || 'Invalid session');
                    }
                })
                .catch(error => {
                    console.error('Session check error:', error);
                    localStorage.removeItem('session_token');
                    localStorage.removeItem('name');
                    window.location.href = './login.php';
                });
        });
    </script>
</head>
<body>
    <div class="text-center">
        <p>Memeriksa sesi...</p>
    </div>
</body>
</html>