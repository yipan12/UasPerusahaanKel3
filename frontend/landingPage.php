<?php include('header.php'); ?>
<head>
    <link rel="stylesheet" href="../bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        .open-sans {
    font-family: 'Open Sans', sans-serif;
    font-weight: 400; 
    
}   
curve-transition {
    margin-top: -20px;
    line-height: 0;
}

.curve-transition svg {
    width: 100%;
    height: auto;
}

/* Featured Products styling */
.featured-products {
    background-color: #000;
    margin-top: -5px;
}

.product-card {
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    transition: transform 0.3s ease;
    cursor: pointer;
}

.product-card:hover {
    transform: translateY(-10px);
}

.product-image {
    position: relative;
    overflow: hidden;
}

.product-image img {
    height: 300px;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.product-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.product-card:hover .product-overlay {
    opacity: 1;
}

.overlay-content {
    text-align: center;
    color: white;
    padding: 20px;
    transform: translateY(20px);
    transition: transform 0.3s ease;
}

.product-card:hover .overlay-content {
    transform: translateY(0);
}

.overlay-content h3 {
    font-size: 1.5rem;
    margin-bottom: 10px;
    font-weight: 600;
}

.overlay-content p {
    margin: 0;
    font-size: 1.1rem;
    opacity: 0.9;
}
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
                <a href="#pelajari" class="btn btn-outline-light btn-lg">
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

<!--  transisi -->
<div class="curve-transition">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120">
        <path fill="#000" fill-opacity="1" d="M0,64L48,80C96,96,192,128,288,128C384,128,480,96,576,85.3C672,75,768,85,864,90.7C960,96,1056,96,1152,90.7C1248,85,1344,75,1392,69.3L1440,64L1440,120L1392,120C1344,120,1248,120,1152,120C1056,120,960,120,864,120C768,120,672,120,576,120C480,120,384,120,288,120C192,120,96,120,48,120L0,120Z"></path>
    </svg>
</div>

<!--fitur product  -->
<div class="featured-products py-5" id="pelajari">
    <div class="container">
        <h1 class="text-white fs-3 open-sans fw-bold mb-4">Featured Products</h1>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="product-card">
                    <div class="product-image">
                        <img src="../Assets/Images/amd.jpg" class="d-block w-100" alt="AMD Processor">
                        <div class="product-overlay">
                            <div class="overlay-content">
                                <h3>Teknologi AI</h3>
                                <p>Lebih Cepat dan Lebih Pintar</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="product-card">
                    <div class="product-image">
                        <img src="../Assets/Images/amd prosesor.jpg" class="d-block w-100" alt="AMD Processor">
                        <div class="product-overlay">
                            <div class="overlay-content">
                                <h3>Performa Maksimal</h3>
                                <p>di Setiap Momen</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="product-card">
                    <div class="product-image">
                        <img src="../Assets/Images/gpu.jpg" class="d-block w-100" alt="GPU">
                        <div class="product-overlay">
                            <div class="overlay-content">
                                <h3>Performa Tertinggi</h3>
                                <p>di Kelasnya</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- akhir fitur product -->

<footer class="bg-dark text-white py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Logo coreTech dan garis -->
                <div class="text-center mb-4">
                    <h3 class="fw-bold">CoreTech Solutions</h3>
                    <hr class="mx-auto opacity-25" style="width: 60px; height: 3px; background-color: #007bff;">
                </div>
                
                <!-- Team kelompok -->
                <div class="text-center mb-4">
                    <h4 class="text-primary mb-4">Team CoreTech Solution</h4>
                    
                    <div class="row g-4 justify-content-center">
                        <div class="col-sm-6 col-lg-4">
                            <div class="bg-dark bg-opacity-50 p-3 rounded-3 shadow-sm h-100">
                                <h6 class="fw-bold mb-1">Irpan Maulana</h6>
                                <small class="text-primary">22552011284</small>
                            </div>
                        </div>
                        
                        <div class="col-sm-6 col-lg-4">
                            <div class="bg-dark bg-opacity-50 p-3 rounded-3 shadow-sm h-100">
                                <h6 class="fw-bold mb-1">M Daffa Haikal Iskandar</h6>
                                <small class="text-primary">22552011202</small>
                            </div>
                        </div>
                        
                        <div class="col-sm-6 col-lg-4">
                            <div class="bg-dark bg-opacity-50 p-3 rounded-3 shadow-sm h-100">
                                <h6 class="fw-bold mb-1">Arya Wardana</h6>
                                <small class="text-primary">2255201330</small>
                            </div>
                        </div>
                        
                        <div class="col-sm-6 col-lg-4">
                            <div class="bg-dark bg-opacity-50 p-3 rounded-3 shadow-sm h-100">
                                <h6 class="fw-bold mb-1">Nuramar</h6>
                                <small class="text-primary">22552011291</small>
                            </div>
                        </div>
                        
                        <div class="col-sm-6 col-lg-4">
                            <div class="bg-dark bg-opacity-50 p-3 rounded-3 shadow-sm h-100">
                                <h6 class="fw-bold mb-1">Hermawan Sopian</h6>
                                <small class="text-primary">21552011163</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Copyright -->
                <div class="text-center mt-5 pt-3 border-top border-secondary">
                    <small class="text-muted">&copy; Copyright by Kelompok3 <br>
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
        </div>
    </div>
</footer>

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
