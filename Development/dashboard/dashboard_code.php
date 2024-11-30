<?php
// Fetch counts from the database using $conn (connection must be open)
$residents_count = $conn->query("SELECT COUNT(*) AS count FROM tb_resident WHERE isDisplayed = 1")->fetch_assoc()['count'];
$employee_count = $conn->query("SELECT COUNT(*) AS count FROM tb_employee WHERE isDisplayed = 1")->fetch_assoc()['count'];
$document_count = $conn->query("SELECT COUNT(*) AS count FROM tb_document WHERE isDisplayed = 1")->fetch_assoc()['count'];
$project_count = $conn->query("SELECT COUNT(*) AS count FROM tb_project WHERE isDisplayed = 1")->fetch_assoc()['count'];
$certificate_count = $conn->query("SELECT COUNT(*) AS count FROM tb_indigency WHERE isDisplayed = 1")->fetch_assoc()['count'];
$inventory_count = $conn->query("SELECT COUNT(*) AS count FROM tb_inventory WHERE isDisplayed = 1")->fetch_assoc()['count'];
$financial_count = $conn->query("SELECT COUNT(*) AS count FROM tb_cashbook WHERE isDisplayed = 1")->fetch_assoc()['count'];
$household_count = $conn->query("SELECT COUNT(*) AS count FROM tb_household WHERE isDisplayed = 1")->fetch_assoc()['count'];
?>
