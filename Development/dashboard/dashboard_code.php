<?php
// Fetch counts from the database using $conn (connection must be open)
$residents_count = $conn->query("SELECT COUNT(*) AS count FROM tb_resident WHERE isDisplayed = 1")->fetch_assoc()['count'];
$employee_count = $conn->query("SELECT COUNT(*) AS count FROM tb_employee WHERE isDisplayed = 1")->fetch_assoc()['count'];
$document_count = $conn->query("SELECT COUNT(*) AS count FROM tb_document")->fetch_assoc()['count'];
$project_count = $conn->query("SELECT COUNT(*) AS count FROM tb_project")->fetch_assoc()['count'];
$certificate_count = $conn->query("SELECT COUNT(*) AS count FROM tb_indigency")->fetch_assoc()['count'];
$inventory_count = $conn->query("SELECT COUNT(*) AS count FROM tb_inventory")->fetch_assoc()['count'];
$financial_count = $conn->query("SELECT COUNT(*) AS count FROM tb_financial")->fetch_assoc()['count'];
?>
