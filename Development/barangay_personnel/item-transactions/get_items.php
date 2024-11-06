<?php
require 'database.php';

$query = "SELECT item_name, available_count FROM tb_inventory WHERE lendability = 1 AND available_count > 0";
$result = $conn->query($query);

$items = [];
while ($row = $result->fetch_assoc()) {
    $items[] = $row;
}

header('Content-Type: application/json');
echo json_encode($items);
?>
