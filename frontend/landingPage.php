<?php include('header.php'); ?>
<head>
    <link rel="stylesheet" href="../bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        /* Header Styles */
        .hero-section {
            position: relative;
            background-color: #000;
            overflow: hidden;
        }

        .hero-img {
            opacity: 0.6;
            height: 500px;
            object-fit: cover;
        }

        .hero-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            max-width: 800px;
        }

        .animate-text {
            animation: fadeInUp 1s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Table Styles */
        #newsTable {
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        #newsTable thead {
            background-color: rgb(10, 10, 10);
            color: white;
        }

        #newsTable tbody tr:hover {
            background-color: rgba(0,123,255,0.1);
            transition: background-color 0.3s ease;
        }

        .news-image {
            object-fit: cover;
            border-radius: 5px;
            display: block;
            margin: 0 auto;
            transition: transform 0.3s ease;
        }

        .news-image:hover {
            transform: scale(1.1);
        }

        .btn-detail {
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 15px;
        }

        .dataTables_wrapper .dataTables_filter input {
            margin-left: 10px;
            padding: 5px 10px;
            border-radius: 5px;
            border: 1px solid #ced4da;
        }
    </style>
</head>
<section class="hero-section">
    <img src="../Assets/Images/computer-chip-dark-background-with-word-intel-it.jpg" class="w-100 hero-img" alt="Processor Background">
    <div class="hero-content text-center text-white px-4">
        <div class="animate-text">
            <h1 class="display-3 fw-bold mb-3">Selamat datang di CoreTech Solutions</h1>
            <p class="lead mb-4">Tujuan Utama kami untuk Prosesor Berkinerja Tinggi</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="#SearchProduct" class="btn btn-dark btn-lg">
                    <i class="bi bi-cpu me-2  "> </i>Cari Produk
                </a>
                <a href="#keunggulan" class="btn btn-outline-light btn-lg">
                    <i class="bi bi-info-circle me-2"></i>Pelajari lebih lanjut
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="bg-dark py-5" id="keunggulan">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-md-4">
                <div class="card border-0 bg-transparent">
                    <div class="card-body">
                        <i class="bi bi-award text-primary display-4 text-white"></i>
                        <h3 class="mt-3 text-white ">Kualitas Premium</h3>
                        <p class="text-muted">Kami menawarkan procecor premium dengan spek tinggi!!</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 bg-transparent">
                    <div class="card-body">
                        <i class="bi bi-shield-check text-primary display-4 text-white"></i>
                        <h3 class="mt-3 text-white">Jaminan Garansi!!</h3>
                        <p class="text-muted">Semua produk yang kami jual mendapatkan garansi extra!!</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 bg-transparent">
                    <div class="card-body">
                        <i class="bi bi-headset text-primary display-4 text-white"></i>
                        <h3 class="mt-3 text-white">24/7 Bantuan</h3>
                        <p class="text-muted">Teknisi berpengalaman untuk bantuan yang kamu butuhkan!!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<div class="container my-5" id="SearchProduct">
    <div class="row mb-4">
        <div class="col">
            <h2 class="text-black border-bottom pb-3">Informasi Detail Processor</h2>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card shadow-sm">
                <div class="card-body">
                    <table id="newsTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    let table = $('#newsTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": function(data, callback, settings) {
            axios.get("http://localhost/Kelompok3/backend/landing.php", {
                params: {
                    draw: data.draw,
                    key: data.search.value,
                    length: data.length,
                    start: data.start
                }
            })
            .then(function(response) {
                let formattedData = response.data.map((row, index) => {
                    row.no = index + 1;
                    return row;
                });
                 
                callback({
                    draw: data.draw,
                    recordsTotal: formattedData.length,
                    recordsFiltered: formattedData.length,
                    data: formattedData
                });
            })
            .catch(function(error) {
                console.error(error);
                alert("Error fetching news data");
            });
        },
        "columns": [
            { "data": "no" },
            { "data": "title" },
            { "data": "desc" },
            {
                "data": "img",
                "render": function(data, type, row) {
                    return '<img src="http://localhost/kelompok3/' + data + '" alt="image" class="news-image" style="max-width: 100px; max-height: 100px;">';
                }
            },
            {
                "data": null,
                "render": function(data, type, row) {
                    return '<a href="detailPage.php?id=' + row.id + '" class="btn btn-dark btn-sm btn-detail"><i class="bi bi-eye me-1"></i>Detail</a>';
                }
            }
        ]
    });
});
</script>
