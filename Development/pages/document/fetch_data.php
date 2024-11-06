<?php 
include('../../connection.php');

$output = array();
$sql = "SELECT * FROM tb_document WHERE isDisplayed = 1"; // Only fetch records with isDisplayed = 1

$totalQuery = mysqli_query($con, $sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
    0 => 'document_id',
    1 => 'document_name',
    2 => 'document_date',
    3 => 'document_info',
    4 => 'document_type',    
);

$search_value = '';
if(isset($_POST['search']['value']) && $_POST['search']['value'] != '')
{
    $search_value = $_POST['search']['value'];
    $sql .= " AND (document_name LIKE '%".$search_value."%' 
              OR document_date LIKE '%".$search_value."%' 
              OR document_info LIKE '%".$search_value."%' 
              OR document_type LIKE '%".$search_value."%')";
}

// Get the filtered row count
$filteredQuery = mysqli_query($con, $sql);
$total_filtered_rows = mysqli_num_rows($filteredQuery);

if($_POST['length'] != -1)
{
    $start = $_POST['start'];
    $length = $_POST['length'];
    $sql .= " LIMIT ".$start.", ".$length;
}    

$query = mysqli_query($con, $sql);
$data = array();

while($row = mysqli_fetch_assoc($query))
{
    $sub_array = array();
    $sub_array[] = $row['document_id'];
    $sub_array[] = '<input type="checkbox" class="row-checkbox" value="'.$row['document_id'].'">';
    $sub_array[] = $row['document_name'];
    $sub_array[] = $row['document_date'];
    $sub_array[] = $row['document_info'];
    $sub_array[] = $row['document_type'];
    $sub_array[] = '
        <div class="dropdown">
            <button class="action-btn" onclick="toggleDropdown(this)">
                ACTIONS <i class="bx bx-chevron-down"></i>
            </button>
            <div class="dropdown-menu">
				<a href="javascript:void(0);" onclick="openViewModal(' . $row['document_id'] . ');" class="dropdown-item view-btn viewbtn">
					<i class="bx bx-show"></i>
				</a>
                <a href="javascript:void(0);" data-id="' . $row['document_id'] . '" class="dropdown-item update-btn editbtn">
                    <i class="bx bx-edit"></i>
                </a>
                <a href="javascript:void(0);" data-id="' . $row['document_id'] . '" class="dropdown-item delete-btn deleteBtn">
                    <i class="bx bx-trash"></i>
                </a>
            </div>
        </div>';
    $data[] = $sub_array;
}

$output = array(
    'draw' => intval($_POST['draw']),
    'recordsTotal' => $total_all_rows,
    'recordsFiltered' => $total_filtered_rows,
    'data' => $data,
);

echo json_encode($output);
?>
