<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CoreTech Solution</title>

    <!-- DataTables CSS (latest version) -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery (latest version) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JavaScript (latest version) -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <!-- DataTables Bootstrap 4 (latest version) -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
       .navbar a:hover {
            color:rgb(255, 255, 255);
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.8), 0 0 20px rgba(245, 246, 247, 0.6);
        }

        

        .navbar a:hover::after {
            width: 100%;
        }
    </style>
</head>


<body>

    <nav class="navbar navbar-dark sticky-top " style="background-color: #101820; height: 70px;">
        <div class="container d-flex justify-content-between align-items-center">
            <!-- halaman -->
           <div class=" d-flex justify-content-between align-items-center" style="width: 35%;">
           <a class="navbar-brand text-white fw-bold" href="./landingPage.php">CoreTech Solution</a>
            <a href="landingPage.php" class=" text-decoration-none text-white fw-bold ">Dashboard</a>
                <a href="tambahInformasi.php" class=" text-decoration-none text-white fw-bold ">Tambah</a>
                <a href="kelolaPage.php" class=" text-decoration-none text-white fw-bold ">Kelola</a>
           </div>
                
            
            <div class="d-flex justify-content-evenly align-items-center" style="width: 150px;">
            <a href="profile.php"><i class="fas fa-user text-white"> </i></a>
                <a class="text-white text-decoration-none" id="logoutButton" data-bs-toggle="modal" data-bs-target="#logoutModal">
                    <i class="fas fa-sign-out-alt"> </i> 
                </a>
            </div>
        </div>
    </nav>

    <!-- Logout Confirmation Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content glassmorphism">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="logoutModalLabel">
                        <i class="fas fa-exclamation-circle"></i> Confirm Logout
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <p class="mb-0 fs-5">Yakin mau keluar dari halaman?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger px-4" id="confirmLogoutButton">Logout</button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .glassmorphism {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 10px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
    </style>

<script>
        // Logout functionality
        document.getElementById('confirmLogoutButton').addEventListener('click', function () {
            const sessionToken = localStorage.getItem('session_token');
            const formData = new FormData();
            formData.append('session_token', sessionToken);

            axios.post('http://localhost/Kelompok3/backend/logout.php', formData)
                .then(response => {
                    if (response.data.status === 'success') {
                        localStorage.removeItem('session_token');
                        localStorage.removeItem('name');
                        window.location.href = 'login.php'; // Redirect to login after logout
                    } else {
                        alert('Logout failed: ' + response.data.message);
                    }
                })
                .catch(() => {
                    alert('Error connecting to the server');
                });
        });

     

        // Manually triggering modal for other buttons
        document.querySelectorAll('.btn-outline-secondary, .btn-outline-success, .btn-outline-info').forEach(button => {
            button.addEventListener('click', function () {
                const modal = new bootstrap.Modal(document.getElementById('logoutModal'));
                modal.show();
            });
        });
    </script>
</body>

</html>