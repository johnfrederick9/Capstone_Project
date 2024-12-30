<?php
include('../../connection.php');

$output = array();
$sql_base = "SELECT resident_id, resident_firstname, resident_middlename, resident_lastname, resident_birthdate, resident_height, resident_weight, resident_BMIstat, resident_heightstat, resident_weightstat, resident_medical, resident_suffixes FROM tb_resident WHERE isDisplayed = 1"; // Fetch only required columns

$totalQuery = mysqli_query($con, $sql_base);
$total_all_rows = mysqli_num_rows($totalQuery);

// Base SQL query for filtering and searching
$sql = $sql_base;

if (isset($_POST['search']['value'])) {
    $search_value = mysqli_real_escape_string($con, $_POST['search']['value']); // Sanitize input
    $sql .= " AND (
        resident_firstname LIKE '%" . $search_value . "%' OR
        resident_middlename LIKE '%" . $search_value . "%' OR
        resident_lastname LIKE '%" . $search_value . "%' OR
        resident_height LIKE '%" . $search_value . "%' OR
        resident_weight LIKE '%" . $search_value . "%' OR
        resident_BMIstat LIKE '%" . $search_value . "%' OR
        resident_heightstat LIKE '%" . $search_value . "%' OR
        resident_weightstat LIKE '%" . $search_value . "%' OR
        resident_medical LIKE '%" . $search_value . "%'
    )";
}

// Count rows after filtering
$count_filtered_query = mysqli_query($con, $sql);
$count_filtered_rows = mysqli_num_rows($count_filtered_query);

// Add pagination
if ($_POST['length'] != -1) {
    $start = intval($_POST['start']);
    $length = intval($_POST['length']);
    $sql .= " LIMIT " . $start . ", " . $length;
}

$query = mysqli_query($con, $sql);
$data = array();

while ($row = mysqli_fetch_assoc($query)) {
    // Calculate the age dynamically
    $birthdate = new DateTime($row['resident_birthdate']);
    $currentDate = new DateTime();
    $age = $currentDate->diff($birthdate)->y;

    // Calculate BMI if height and weight are available
    $height_meters = $row['resident_height'] / 100; // Convert height from cm to meters
    $weight = $row['resident_weight']; // Assume weight is already in kg
    $bmi = ($height_meters > 0) ? number_format($weight / ($height_meters * $height_meters), 2) : 'N/A';

    // Determine BMI status
    $bmi_status = 'N/A';
    if ($bmi !== 'N/A') {
        if ($bmi < 18.5) {
            $bmi_status = 'Underweight';
        } elseif ($bmi >= 18.5 && $bmi <= 24.9) {
            $bmi_status = 'Normal';
        } elseif ($bmi >= 25 && $bmi <= 29.9) {
            $bmi_status = 'Overweight';
        } elseif ($bmi >= 30) {
            $bmi_status = 'Obese';
        }
    }

    // Format full name
    $firstname = ucwords(strtolower($row['resident_firstname']));
    $lastname = ucwords(strtolower($row['resident_lastname']));
    $middle_initial = $row['resident_middlename'] 
        ? strtoupper(substr($row['resident_middlename'], 0, 1)) . '.' 
        : '';
    $suffix = $row['resident_suffixes'] 
        ? ' ' . ucwords(strtolower($row['resident_suffixes'])) 
        : '';
    $full_name = $firstname . ' ' . $middle_initial . ' ' . $lastname . $suffix;

    // Prepare row data
    $sub_array = array();
    $sub_array[] = $row['resident_id'];
    $sub_array[] = '<input type="checkbox" class="row-checkbox" value="' . $row['resident_id'] . '">';
    $sub_array[] = $full_name; // Combined full name
    $sub_array[] = $age; // Use the computed age
    $sub_array[] = $row['resident_height'];
    $sub_array[] = $row['resident_weight'];
    $sub_array[] = $bmi; // Computed BMI
    $sub_array[] = $bmi_status; // Computed BMI Status
    $sub_array[] = $row['resident_medical'];
    $sub_array[] = '
    <div class="dropdown">
        <button class="action-btn" onclick="toggleDropdown(this)">
            ACTIONS <i class="bx bx-chevron-down"></i>
        </button>
        <div class="dropdown-menu">
            <a href="javascript:void(0);" data-id="' . $row['resident_id'] . '" class="dropdown-item view-btn viewbtn">
                <i class="bx bx-show"></i>
            </a>
            <a href="javascript:void(0);" data-id="' . $row['resident_id'] . '" class="dropdown-item update-btn editbtn">
                <i class="bx bx-edit"></i>
            </a>
            <a href="javascript:void(0);" data-id="' . $row['resident_id'] . '" class="dropdown-item delete-btn deleteBtn">
                <i class="bx bx-trash"></i>
            </a>
        </div>
    </div>';
    $data[] = $sub_array;
}

// Prepare JSON response
$output = array(
    'draw' => intval($_POST['draw']),
    'recordsTotal' => $total_all_rows,
    'recordsFiltered' => $count_filtered_rows,
    'data' => $data,
);

echo json_encode($output);
?>
