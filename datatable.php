<?php
require_once 'classDatabaseManager.php';

$dbManager = new databaseManager();

function getTotalRows()
{
    global $dbManager;
    $query = "SELECT COUNT(*) as count FROM user";
    $result = $dbManager->executeQuery($query, [], 'cread');
    if ($result !== false) {
        return $result[0]['count'];
    }
    return 0;
}

$page = isset($_POST['page']) ? $_POST['page'] : 1;
$recordsPerPage = 10;

if (isset($_POST['selectedValue'])) {
    $selectedValue = $_POST['selectedValue'];

    switch ($selectedValue) {
        case '10':
            $recordsPerPage = 10;
            break;
        case '25':
            $recordsPerPage = 25;
            break;
        case '50':
            $recordsPerPage = 50;
            break;
        case '100':
            $recordsPerPage = 100;
            break;
        default:
            $recordsPerPage = 10;
            break;
    }
}

$start = ($page - 1) * $recordsPerPage;

$query = "SELECT * FROM user LIMIT $start, $recordsPerPage";
$result = $dbManager->executeQuery($query, [], 'cread');

if ($result !== false) {
    $output = '';

    $output .= '<form id="myForm" method="POST" action="">';
    $output .= '<select id="mySelect" name="selectedValue" class="form-select" aria-label="Default select example">';
    $output .= '<option value="10" ' . ($recordsPerPage == 10 ? 'selected' : '') . '>10</option>';
    $output .= '<option value="25" ' . ($recordsPerPage == 25 ? 'selected' : '') . '>25</option>';
    $output .= '<option value="50" ' . ($recordsPerPage == 50 ? 'selected' : '') . '>50</option>';
    $output .= '<option value="100" ' . ($recordsPerPage == 100 ? 'selected' : '') . '>100</option>';
    $output .= '</select>';
    $output .= '</form>';

    $output .= '<table>';
    $output .= '<thead>';
    $output .= '<tr>';
    $output .= '<th>User ID</th>';
    $output .= '<th>User Name</th>';
    $output .= '</tr>';
    $output .= '</thead>';
    $output .= '<tbody>';

    foreach ($result as $row) {
        $output .= '<tr>';
        $output .= '<td>' . $row['user_id'] . '</td>';
        $output .= '<td>' . $row['user_name'] . '</td>';
        $output .= '</tr>';
    }

    $output .= '</tbody>';
    $output .= '</table>';

    $totalRows = getTotalRows();
    $totalPages = ceil($totalRows / $recordsPerPage);

    $output .= '<div class="pagination">';
    $output .= '<ul>';

    if ($page > 1) {
        $output .= '<li><a href="#" class="page-link" data-page="' . ($page - 1) . '">Previous</a></li>';
    }

    for ($i = 1; $i <= $totalPages; $i++) {
        $output .= '<li><a href="#" class="page-link ' . ($page == $i ? 'active' : '') . '" data-page="' . $i . '">' . $i . '</a></li>';
    }

    if ($page < $totalPages) {
        $output .= '<li><a href="#" class="page-link" data-page="' . ($page + 1) . '">Next</a></li>';
    }

    $output .= '</ul>';
    $output .= '</div>';

    echo $output;
}
?>


<script>
    // // Retrieve the pagination and select elements
    // var paginationElement = document.querySelector(".pagination");
    // var selectElement = document.getElementById("mySelect");

    // // Add event listener to the select element
    // selectElement.addEventListener("change", function() {
    //     // Submit the form when the select value changes
    //     document.getElementById("myForm").submit();
    // });

    // // Add event listeners to the pagination links
    // paginationElement.addEventListener("click", function(event) {
    //     var target = event.target;
    //     if (target.tagName === "A") {
    //         // Retrieve the data-page attribute value
    //         var page = target.getAttribute("data-page");
    //         // Set the value of the page input field
    //         document.getElementById("pageInput").value = page;
    //         // Submit the form
    //         document.getElementById("myForm").submit();
    //     }
    // });
</script>