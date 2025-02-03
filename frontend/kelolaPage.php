<?php 
include('header.php');

?>

<head>
    <link rel="stylesheet" href="../bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
</head>

<div class="container mt-5">
    <h2 class="mb-4">ListNews</h2>
    <table id="newsTable" class="table table-hover">
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

<script>
$(document).ready(function() {
    let table = $('#newsTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": function(data, callback, settings) {
            axios.get("http://localhost/Kelompok3/backend/kelola.php", {
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
                  console.log(data); // Debugging untuk melihat data
                     return '<img src="http://localhost/kelompok3/' + data + '" alt="image" style="max-width: 100px; max-height: 100px;">';
                } 

            },
            { 
                "data": null,
                "render": function(data, type, row) {
    return `
        <button class="btn btn-danger btn-sm" onclick="deleteNews(${row.id})">Delete</button>
        <a href="editInformasi.php?id=${row.id}" class="btn btn-primary btn-sm">Edit</a>
    `;
}
            }
        ]
    });
});

// Function to delete news
function deleteNews(id) {
    if (confirm("Yakin ingin menghapus informasi?")) {
        axios.post("http://localhost/Kelompok3/backend/delete.php", { id: id })
            .then(function(response) {
                console.log("Response from delete.php:", response);  
                if (response.data.status === 'success') {
                    alert("Berita berhasil di-hapus!");
                    $('#newsTable').DataTable().ajax.reload(); 
                } else {
                    alert("Error: " + response.data.message);
                }
            })
            .catch(function(error) {
                console.error("Error deleting news:", error);  
                alert("Error deleting news");
            });
    }
}


</script>
