<script>
        // Cek session token
        document.addEventListener('DOMContentLoaded', function () {
            const sessionToken = localStorage.getItem('session_token');
            if (!sessionToken) {
                window.location.href = 'login.php'; // Redirect ke login jika token tidak ada
            } else {
                const formData = new FormData();
                formData.append('session_token', sessionToken);

                axios.post('http://localhost/Kelompok3/backend/sesion.php', formData)
                    .then(response => {
                        if (response.data.status === 'success') {
                            localStorage.setItem('name', response.data.hasil.name); 
                        } else {
                            window.location.href = 'login.php'; 
                        }
                    })
                    .catch(() => {
                        alert('Error checking session');
                    });
            }
        });
    </script>