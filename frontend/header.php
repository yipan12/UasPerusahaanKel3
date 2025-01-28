<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modal Example</title>

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
    <style>
       .navbar a:hover {
            color:rgb(255, 255, 255);
            text-shadow: 0 0 10px rgba(255, 0, 0, 0.8), 0 0 20px rgba(0, 123, 255, 0.6);
        }

        

        .navbar a:hover::after {
            width: 100%;
        }
    </style>
</head>


<body>

    <nav class="navbar navbar-dark sticky-top" style="background-color: #EFEFEF;">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand text-dark fw-bold" href="#">IrpanMaulana</a>
            <div class="d-flex justify-content-between w-25">

                <a href="landingPage.php" class=" text-black-50 fw-bold ">Dashboard</a>
                <a href="tambahInformasi.php" class="text-black-50 fw-bold ">Tambah</a>
                <a href="kelolaPage.php" class="text-black-50 fw-bold ">Kelola</a>
                
                <button class="btn btn-outline-dark" id="logoutButton" data-bs-toggle="modal" data-bs-target="#logoutModal">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
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