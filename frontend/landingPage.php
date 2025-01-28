<?php include('header.php'); ?>
<head>
    <link rel="stylesheet" href="../bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <style>
        #newsTable {
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        #newsTable thead {
            background-color: #007bff;
            color: white;
        }
        #newsTable tbody tr:hover {
            background-color: rgba(0,123,255,0.1);
            transition: background-color 0.3s ease;
        }
        .news-image {
            object-fit: cover;
            border-radius: 5px;
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

<div class="container mt-5">
    <h2 class="mb-4 text-primary">News Landing Page</h2>
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
                    return '<a href="detailPage.php?id=' + row.id + '" class="btn btn-primary btn-sm btn-detail"><i class="bi bi-eye"></i>Detail</a>';
                }
            }
        ]
    });
});
</script>