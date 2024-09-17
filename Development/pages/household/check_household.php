<?php
require '../../database.php';

if (isset($_POST['household_id'])) {
    $household_id = $_POST['household_id'];

    $sql = "SELECT total_members FROM household_tb WHERE household_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $household_id);
    $stmt->execute();
    $stmt->bind_result($total_members);
    $stmt->fetch();

    if ($total_members) {
        echo $total_members;
    } else {
        echo "No Household Found";
    }

    $stmt->close();
}

$conn->close();
?>
