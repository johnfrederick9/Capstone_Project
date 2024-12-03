<?php
// resident_search.php
include('../../database.php');

if (isset($_GET['household_id'])) {
    $household_id = intval($_GET['household_id']);
    $stmt = $conn->prepare("SELECT CONCAT(resident_firstname, ' ', resident_lastname) AS full_name FROM barangay_db_tb_resident WHERE household_id = ?");
    $stmt->bind_param("i", $household_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $residents = [];
    while ($row = $result->fetch_assoc()) {
        $residents[] = $row['full_name'];
    }

    echo json_encode($residents);
    exit;
}
?>
