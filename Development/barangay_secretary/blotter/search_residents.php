<?php
include '../../connection.php';

$term = $_GET['term'] ?? '';
$exclude = $_GET['exclude'] ?? '';

// Query to get resident names excluding the already selected one
$query = "SELECT CONCAT(resident_firstname, ' ', 
                        IF(resident_middlename != '' AND resident_middlename IS NOT NULL, CONCAT(LEFT(resident_middlename, 1), '.'), ''), ' ', 
                        resident_lastname) AS resident_fullname 
          FROM tb_resident 
          WHERE CONCAT(resident_firstname, ' ', 
                       IF(resident_middlename != '' AND resident_middlename IS NOT NULL, CONCAT(LEFT(resident_middlename, 1), '.'), ''), ' ', 
                       resident_lastname) LIKE ? 
            AND CONCAT(resident_firstname, ' ', 
                       IF(resident_middlename != '' AND resident_middlename IS NOT NULL, CONCAT(LEFT(resident_middlename, 1), '.'), ''), ' ', 
                       resident_lastname) != ?";

$stmt = $conn->prepare($query);
$searchTerm = "%{$term}%";
$stmt->bind_param('ss', $searchTerm, $exclude);
$stmt->execute();
$result = $stmt->get_result();

$names = [];
while ($row = $result->fetch_assoc()) {
    $names[] = ['label' => $row['resident_fullname'], 'value' => $row['resident_fullname']];
}

echo json_encode($names);
?>
