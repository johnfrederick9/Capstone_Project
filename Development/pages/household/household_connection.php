<?php

include ("../../connection.php");

// Fetch household details
$household_id = $_GET['household_id']; // Get the household_id from the request
$sql = "
    SELECT 
        tb_household.household_id,
        tb_household.household_address,
        tb_resident.resident_id,
        CONCAT(tb_resident.resident_firstname, ' ', tb_resident.resident_lastname) AS resident_name,
        tb_resident.resident_sex,
        tb_resident.resident_birthdate,
        tb_resident.resident_contact,
        tb_resident.resident_householdrole
    FROM tb_household
    LEFT JOIN tb_resident ON tb_household.household_id = tb_resident.household_id
    WHERE tb_household.household_id = ?
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $household_id);
$stmt->execute();
$result = $stmt->get_result();

$household = [];
while ($row = $result->fetch_assoc()) {
    $household[] = $row;
}

echo json_encode($household);

$stmt->close();
$conn->close();
?>