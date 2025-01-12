<?php 
include('../../connection.php');

$output = array();

// Fetch all households and count their members
$sql = "SELECT 
            h.id, 
            h.household_id, 
            h.household_name, 
            h.household_head, 
            h.household_address, 
            h.household_contact,
            h.isDisplayed,
            (SELECT COUNT(*) 
             FROM tb_resident r 
             WHERE r.household_id = h.household_id AND r.isDisplayed = 1) AS member_count
        FROM tb_household h";

$totalQuery = mysqli_query($con, $sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
    0 => 'id',
    1 => 'household_id',
    2 => 'household_name',
    3 => 'household_head',
    4 => 'household_address',
    5 => 'household_contact',
    6 => 'member_count',       
);

$search_value = '';
if (isset($_POST['search']['value'])) {
    $search_value = $_POST['search']['value'];
    $sql .= " WHERE (household_id LIKE '%" . $search_value . "%'";
    $sql .= " OR household_name LIKE '%" . $search_value . "%'";
    $sql .= " OR household_head LIKE '%" . $search_value . "%'";
    $sql .= " OR household_address LIKE '%" . $search_value . "%'";
    $sql .= " OR household_contact LIKE '%" . $search_value . "%')";
}

// Calculate filtered records count
$filterQuery = mysqli_query($con, $sql);
$recordsFiltered = mysqli_num_rows($filterQuery);

if (isset($_POST['length']) && $_POST['length'] != -1) {
    $start = intval($_POST['start']);
    $length = intval($_POST['length']);
    $sql .= " LIMIT " . $start . ", " . $length;
}

$query = mysqli_query($con, $sql);
$data = array();

while ($row = mysqli_fetch_assoc($query)) {
    $household_id = $row['household_id'];

    // Check if the household has members with `isDisplayed = 1`
    $member_check_sql = "SELECT COUNT(*) as member_count 
                         FROM tb_resident 
                         WHERE household_id = '$household_id' AND isDisplayed = 1";
    $member_check_query = mysqli_query($con, $member_check_sql);
    $member_check_result = mysqli_fetch_assoc($member_check_query);
    $member_count = $member_check_result['member_count'];

    if ($member_count == 0 && $row['isDisplayed'] == 1) {
        // No members; set household `isDisplayed` to 0
        $update_sql = "UPDATE tb_household SET isDisplayed = 0 WHERE household_id = '$household_id'";
        mysqli_query($con, $update_sql);
    } elseif ($member_count > 0 && $row['isDisplayed'] == 0) {
        // Members exist; set household `isDisplayed` to 1
        $update_sql = "UPDATE tb_household SET isDisplayed = 1 WHERE household_id = '$household_id'";
        mysqli_query($con, $update_sql);
    }

    // Refresh the `isDisplayed` status of the household
    $display_check_sql = "SELECT isDisplayed FROM tb_household WHERE household_id = '$household_id'";
    $display_check_query = mysqli_query($con, $display_check_sql);
    $display_status = mysqli_fetch_assoc($display_check_query)['isDisplayed'];

    // Include the household in the output only if it is displayed
    if ($display_status == 1) {
        $sub_array = array();
        $sub_array[] = $row['id'];
        $sub_array[] = '<input type="checkbox" class="row-checkbox" value="' . $row['household_id'] . '">';
        $sub_array[] = $row['household_id'];
        $sub_array[] = $row['household_name'];
        $sub_array[] = $row['household_head'];
        $sub_array[] = $row['household_address'];
        $sub_array[] = $row['household_contact'];
        $sub_array[] = $member_count; // Include the member count
        $sub_array[] = '
        <div class="dropdown">
            <button class="action-btn" onclick="toggleDropdown(this)">
                ACTIONS <i class="bx bx-chevron-down"></i>
            </button>
            <div class="dropdown-menu">
                <!-- View Members Button -->
                <a href="javascript:void(0);" data-household-id="' . $row['household_id'] . '" class="dropdown-item view-btn viewbtn">
                    <i class="bx bx-show"></i>
                </a>
                <!-- Update Button -->
                <a href="javascript:void(0);" data-id="' . $row['id'] . '" class="dropdown-item update-btn editbtn">
                    <i class="bx bx-edit"></i>
                </a>
                <!-- Delete Button -->
                <a href="javascript:void(0);" data-id="' . $row['id'] . '" class="dropdown-item delete-btn deleteBtn">
                    <i class="bx bx-trash"></i>
                </a>
            </div>
        </div>';
        $data[] = $sub_array;
    }
}

$output = array(
    'draw' => isset($_POST['draw']) ? intval($_POST['draw']) : 0, // Ensure `draw` is set
    'recordsTotal' => $total_all_rows,
    'recordsFiltered' => $recordsFiltered, // Use filtered count
    'data' => $data,
);

echo json_encode($output);
?>
