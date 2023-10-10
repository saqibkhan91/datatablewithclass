<!DOCTYPE html>
<html>
<head>
    <title>Data Tables with Pagination</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <style>
        .pagination {
            margin-top: 10px;
        }
        .pagination ul li {
            display: inline-block;
            margin-right: 5px;
        }
        .pagination ul li a {
            padding: 5px 10px;
            border: 1px solid #ccc;
            text-decoration: none;
        }
        .pagination ul li a.active {
            background-color: #ccc;
        }
    </style>
</head>
<body>

<div id="datatableContainer"></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

<script>
 

    $(document).ready(function() {
        function loadDataTable(page) {
            $.ajax({
                url: 'datatable.php',
                type: 'POST',
                data: { page: page },
                success: function(response) {
                    $('#datatableContainer').html(response);
                    $('#dataTable').DataTable();
                }
            });
        }

        loadDataTable(<?php echo $page; ?>);

        $(document).on('click', '.page-link', function(e) {
            e.preventDefault();
            var page = $(this).data('page');
            loadDataTable(page);
        });
    });
</script>

</body>
</html>
