<?php
include('../../connection.php');

mysqli_begin_transaction($con);  // Start transaction
try {
    // Fetch rao_id from POST request
    $rao_bd_id = isset($_POST['rao_bd_id']) ? intval($_POST['rao_bd_id']) : 0;

    // Validate rao_id
    if ($rao_bd_id <= 0) {
        echo json_encode(['status' => 'false', 'error' => 'Invalid rao_bd_id']);
        exit();
    }

    $sql_fetch_rao_bd = "SELECT chairman, period_covered, brgy_captain FROM tb_rao_bd WHERE rao_bd_id = ? AND isDisplayed = 1 ";
    $stmt_fetch_rao_bd = mysqli_prepare($con, $sql_fetch_rao_bd);
    mysqli_stmt_bind_param($stmt_fetch_rao_bd, "i", $rao_bd_id);

    if (!mysqli_stmt_execute($stmt_fetch_rao_bd)) {
        throw new Exception("Error executing fetch rao_bd query: " . mysqli_error($con));
    }

    // Fetch the result
    $result_fetch_rao_bd = mysqli_stmt_get_result($stmt_fetch_rao_bd);

    if ($row = mysqli_fetch_assoc($result_fetch_rao_bd)) {
        $chairman = $row['chairman'];
        $period_covered = $row['period_covered'];
        $brgy_captain = $row['brgy_captain'];
    } else {
        throw new Exception("No data found for rao_bd_id: " . $rao_bd_id . " in tb_rao_bd");
    }

    // Close the statement to free resources
    mysqli_stmt_close($stmt_fetch_rao_bd);

    /////////////////////////////// AP

    $rao_bd_ap = []; // Initialize the array for storing fetched rao_bd_ap data

    // Fetch data from tb_rao_bd_ap
    $sql_fetch_rao_bd_ap = "SELECT * FROM tb_rao_bd_ap WHERE rao_bd_id = ?";
    $stmt_fetch_rao_bd_ap = mysqli_prepare($con, $sql_fetch_rao_bd_ap);
    mysqli_stmt_bind_param($stmt_fetch_rao_bd_ap, "i", $rao_bd_id);
    if (!mysqli_stmt_execute($stmt_fetch_rao_bd_ap)) {
        throw new Exception("Error executing fetch rao_bd_ap query: " . mysqli_error($con));
    }
    $rao_bd_ap_result = mysqli_stmt_get_result($stmt_fetch_rao_bd_ap);

    // Fetch rows into $rao_bd_ap
    while ($row = $rao_bd_ap_result->fetch_assoc()) {
        $rao_bd_ap[] = $row; // Append each row to the array
    }

    mysqli_stmt_close($stmt_fetch_rao_bd_ap);

    ///////////////////////////// OB
    $rao_bd_ob = []; // Initialize the array for storing fetched rao_bd_ob data

    // Fetch data from tb_rao_bd_ob
    $sql_fetch_rao_bd_ob = "SELECT * FROM tb_rao_bd_ob WHERE rao_bd_id = ?";
    $stmt_fetch_rao_bd_ob = mysqli_prepare($con, $sql_fetch_rao_bd_ob);
    mysqli_stmt_bind_param($stmt_fetch_rao_bd_ob, "i", $rao_bd_id);
    if (!mysqli_stmt_execute($stmt_fetch_rao_bd_ob)) {
        throw new Exception("Error executing fetch rao_bd_ob query: " . mysqli_error($con));
    }
    $rao_bd_ob_result = mysqli_stmt_get_result($stmt_fetch_rao_bd_ob);

    // Fetch rows into $rao_bd_ob
    while ($row = $rao_bd_ob_result->fetch_assoc()) {
        $rao_bd_ob[] = $row; // Append each row to the array
    }

    mysqli_stmt_close($stmt_fetch_rao_bd_ob);

    //////////////////////////// TOTALS

    //Fetch from tb_rao_bd_ap_totals
    $rao_bd_BF_totals = [];
    $rao_bd_TA_totals = [];
    $rao_bd_TO_totals = [];
    $rao_bd_OB_totals = [];
    $rao_bd_AB_totals = [];

    // Fetch data from tb_rao_bd_ap_totals
    $sql_fetch_rao_bd_totals = "SELECT * FROM tb_rao_bd_totals WHERE rao_bd_id = ? AND isDisplayed = 1";
    $stmt_fetch_rao_bd_totals = mysqli_prepare($con, $sql_fetch_rao_bd_totals);
    mysqli_stmt_bind_param($stmt_fetch_rao_bd_totals, "i", $rao_bd_id);

    if (!mysqli_stmt_execute($stmt_fetch_rao_bd_totals)) {
        throw new Exception("Error executing fetch rao_bd_ap query: " . mysqli_error($con));
    }

    $rao_bd_totals_result = mysqli_stmt_get_result($stmt_fetch_rao_bd_totals);

    // Fetch rows and separate by total_type
    while ($row = $rao_bd_totals_result->fetch_assoc()) {
        if ($row['total_type'] == 'BF') {
            $rao_bd_BF_totals[] = $row;
        } elseif ($row['total_type'] == 'TA') {
            $rao_bd_TA_totals[] = $row;
        }elseif ($row['total_type'] == 'TO') {
            $rao_bd_TO_totals[] = $row;
        } elseif ($row['total_type'] == 'OB') {
            $rao_bd_OB_totals[] = $row;
        }elseif($row['total_type'] == 'AB'){
            $rao_bd_AB_totals[] = $row;
        }
    }

    // Close the statement
    mysqli_stmt_close($stmt_fetch_rao_bd_totals);

     // Commit transaction
     mysqli_commit($con);

     // Prepare response
    $response = [
        'status' => 'true',
        'rao_bd_id' => $rao_bd_id,
        'chairman' => $chairman,
        'period_covered' => $period_covered,
        'brgy_captain' => $brgy_captain,
        'rao_bd_ap' => $rao_bd_ap,
        'rao_bd_BF_totals' =>  $rao_bd_BF_totals,
        'rao_bd_TA_totals' =>  $rao_bd_TA_totals,
        'rao_bd_ob' => $rao_bd_ob,
        'rao_bd_TO_totals' => $rao_bd_TO_totals,
        'rao_bd_OB_totals'  =>$rao_bd_OB_totals,
        'rao_bd_AB_totals' => $rao_bd_AB_totals,

        ];
} catch (Exception $e) {

    // Rollback transaction in case of error
    mysqli_rollback($con);
    
    // Send error response
    $response = ['status' => 'false', 'error' => $e->getMessage()];
    error_log("Error processing data: " . $e->getMessage());
}finally {
    // Close the connection
    mysqli_close($con);
}
// Send response to client
echo json_encode($response);
?>

