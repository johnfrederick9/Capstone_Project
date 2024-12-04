<?php
include('../../connection.php');

// Retrieve and validate rao_cocont_id
$rao_cocont_id = mysqli_real_escape_string($con, $_POST["rao_cocont_id"] ?? '');

if (empty($rao_cocont_id)) {
    echo json_encode(array('status' => 'failed', 'message' => 'Invalid RAO cocont ID'));
    exit();
}

// Prepare and execute the SQL statement to update the `tb_rao_cocont` table
$sql_rao_cocont = "UPDATE tb_rao_cocont SET isDisplayed = 0 WHERE rao_cocont_id = ?";
$stmt_rao_cocont = $con->prepare($sql_rao_cocont);

if ($stmt_rao_cocont === false) {
    echo json_encode(array('status' => 'failed', 'message' => 'Failed to prepare the SQL statement for tb_rao_cocont.'));
    mysqli_close($con);
    exit();
}

$stmt_rao_cocont->bind_param("i", $rao_cocont_id);
if (!$stmt_rao_cocont->execute()) {
    echo json_encode(array(
        'status' => 'failed',
        'message' => 'Failed to update tb_rao_cocont: ' . $stmt_rao_cocont->error
    ));
    $stmt_rao_cocont->close();
    mysqli_close($con);
    exit();
}

// Fetch the rao_cocont_att_id
$sql_fetch_att_id = "SELECT rao_cocont_att_id FROM tb_rao_cocont_attributes WHERE rao_cocont_id = ?";
$stmt_fetch_att_id = mysqli_prepare($con, $sql_fetch_att_id);

if ($stmt_fetch_att_id === false) {
    echo json_encode(array('status' => 'failed', 'message' => 'Failed to prepare fetch attribute ID query.'));
    mysqli_close($con);
    exit();
}

mysqli_stmt_bind_param($stmt_fetch_att_id, "i", $rao_cocont_id);
if (!mysqli_stmt_execute($stmt_fetch_att_id)) {
    echo json_encode(array('status' => 'failed', 'message' => 'Error fetching attribute IDs: ' . mysqli_error($con)));
    $stmt_fetch_att_id->close();
    mysqli_close($con);
    exit();
}

mysqli_stmt_bind_result($stmt_fetch_att_id, $attributeId);
$attributeIds = [];
while (mysqli_stmt_fetch($stmt_fetch_att_id)) {
    $attributeIds[] = $attributeId; // Store all attribute IDs in an array
}
$stmt_fetch_att_id->close();

if (empty($attributeIds)) {
    echo json_encode(array('status' => 'failed', 'message' => 'No attributes found for the given RAO cocont ID.'));
    mysqli_close($con);
    exit();
}

// Prepare and execute the SQL statement to update the `tb_rao_cocont_attributes` table
$sql_rao_cocont_attributes = "UPDATE tb_rao_cocont_attributes SET isDisplayed = 0 WHERE rao_cocont_id = ?";
$stmt_rao_cocont_attributes = $con->prepare($sql_rao_cocont_attributes);

if ($stmt_rao_cocont_attributes === false) {
    echo json_encode(array('status' => 'failed', 'message' => 'Failed to prepare the SQL statement for tb_rao_cocont_attributes.'));
    $stmt_rao_cocont->close();
    mysqli_close($con);
    exit();
}

$stmt_rao_cocont_attributes->bind_param("i", $rao_cocont_id);
if (!$stmt_rao_cocont_attributes->execute()) {
    echo json_encode(array(
        'status' => 'failed',
        'message' => 'Failed to update tb_rao_cocont_attributes: ' . $stmt_rao_cocont_attributes->error
    ));
    $stmt_rao_cocont->close();
    $stmt_rao_cocont_attributes->close();
    mysqli_close($con);
    exit();
}

// For AP Data
foreach ($attributeIds as $att_id) {
    $sql_delete_ap_data = "UPDATE tb_rao_cocont_ap_data SET isDisplayed = 0 WHERE rao_cocont_att_id = ?";
    $stmt_delete_ap_data = mysqli_prepare($con, $sql_delete_ap_data);
    mysqli_stmt_bind_param($stmt_delete_ap_data, 'i', $att_id);

    if (!mysqli_stmt_execute($stmt_delete_ap_data)) {
        echo json_encode(array('status' => 'failed', 'message' => 'Error updating AP Data: ' . mysqli_error($con)));
        mysqli_stmt_close($stmt_delete_ap_data);
        mysqli_close($con);
        exit();
    }
    mysqli_stmt_close($stmt_delete_ap_data);
}

// For OB Data
foreach ($attributeIds as $att_id) {
    $sql_delete_ob_data = "UPDATE tb_rao_cocont_ob_data SET isDisplayed = 0 WHERE rao_cocont_att_id = ?";
    $stmt_delete_ob_data = mysqli_prepare($con, $sql_delete_ob_data);
    mysqli_stmt_bind_param($stmt_delete_ob_data, 'i', $att_id);

    if (!mysqli_stmt_execute($stmt_delete_ob_data)) {
        echo json_encode(array('status' => 'failed', 'message' => 'Error updating OB Data: ' . mysqli_error($con)));
        mysqli_stmt_close($stmt_delete_ob_data);
        mysqli_close($con);
        exit();
    }
    mysqli_stmt_close($stmt_delete_ob_data);
}

// For AP Totals
$sql_delete_ap_totals = "UPDATE tb_rao_cocont_ap_totals SET isDisplayed = 0 WHERE rao_cocont_id = ?";
$stmt_delete_ap_totals = mysqli_prepare($con, $sql_delete_ap_totals);
mysqli_stmt_bind_param($stmt_delete_ap_totals, "i", $rao_cocont_id);
if (!mysqli_stmt_execute($stmt_delete_ap_totals)) {
    echo json_encode(array('status' => 'failed', 'message' => 'Error updating AP Totals: ' . mysqli_error($con)));
    mysqli_stmt_close($stmt_delete_ap_totals);
    mysqli_close($con);
    exit();
}
mysqli_stmt_close($stmt_delete_ap_totals);

// For OB Totals
$sql_delete_ob_totals = "UPDATE tb_rao_cocont_ob_totals SET isDisplayed = 0 WHERE rao_cocont_id = ?";
$stmt_delete_ob_totals = mysqli_prepare($con, $sql_delete_ob_totals);
mysqli_stmt_bind_param($stmt_delete_ob_totals, "i", $rao_cocont_id);
if (!mysqli_stmt_execute($stmt_delete_ob_totals)) {
    echo json_encode(array('status' => 'failed', 'message' => 'Error updating OB Totals: ' . mysqli_error($con)));
    mysqli_stmt_close($stmt_delete_ob_totals);
    mysqli_close($con);
    exit();
}
mysqli_stmt_close($stmt_delete_ob_totals);

// If all queries were successful, return success response
echo json_encode(array(
    'status' => 'success',
    'message' => 'RAO record and attributes were successfully updated.'
));

// Close the statements and database connection
$stmt_rao_cocont->close();
$stmt_rao_cocont_attributes->close();
mysqli_close($con);
?>
