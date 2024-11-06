<?php
include('../../connection.php');

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Fetch rao_id from POST request
$rao_id = isset($_POST['rao_id']) ? $con->real_escape_string($_POST['rao_id']) : '';

// Validate rao_id
if (empty($rao_id)) {
    echo json_encode(array('error' => 'Invalid rao_id'));
    exit();
}

// Prepare and execute the SQL statement to fetch data from tb_rao
$stmt = $con->prepare("SELECT * FROM tb_rao WHERE rao_id = ? LIMIT 1");
$stmt->bind_param("s", $rao_id);
$stmt->execute();
$result = $stmt->get_result();

// Check for errors in the query
if ($con->error) {
    echo json_encode(array('error' => $con->error));
    exit();
}

// Fetch the row
$row = $result->fetch_assoc();

// Check if row exists
if ($row) {
    // Fetch related data from tb_rao_ap_data
    $relatedStmtAp = $con->prepare("SELECT * FROM tb_rao_ap_data WHERE rao_id = ?");
    $relatedStmtAp->bind_param("s", $rao_id);
    $relatedStmtAp->execute();
    $relatedResultAp = $relatedStmtAp->get_result();
    
    if ($relatedResultAp) {
        $row['related_data_ap'] = $relatedResultAp->fetch_all(MYSQLI_ASSOC);
    } else {
        $row['related_data_ap'] = array('error' => $con->error);
    }

    // Fetch related data from tb_rao_ob_data
    $relatedStmtOb = $con->prepare("SELECT * FROM tb_rao_ob_data WHERE rao_id = ?");
    $relatedStmtOb->bind_param("s", $rao_id);
    $relatedStmtOb->execute();
    $relatedResultOb = $relatedStmtOb->get_result();
    
    if ($relatedResultOb) {
        $row['related_data_ob'] = $relatedResultOb->fetch_all(MYSQLI_ASSOC);
    } else {
        $row['related_data_ob'] = array('error' => $con->error);
    }

    // Encode data to JSON and output
    echo json_encode($row);
} else {
    echo json_encode(array('error' => 'No data found for the provided rao_id'));
}

// Close the prepared statements
$stmt->close();
$relatedStmtAp->close();
$relatedStmtOb->close();

// Close the database connection
$con->close();
?>
