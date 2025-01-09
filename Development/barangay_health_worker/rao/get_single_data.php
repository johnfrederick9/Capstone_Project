<?php
include('../../connection.php');

mysqli_begin_transaction($con);  // Start transaction
try {
    // Fetch rao_id from POST request
    $rao_ps_id = isset($_POST['rao_ps_id']) ? intval($_POST['rao_ps_id']) : 0;

    // Validate rao_id
    if ($rao_ps_id <= 0) {
        echo json_encode(['status' => 'false', 'error' => 'Invalid rao_ps_id']);
        exit();
    }

    $sql_fetch_rao_ps = "SELECT chairman, period_covered, brgy_captain FROM tb_rao_ps WHERE rao_ps_id = ? AND isDisplayed = 1 ";
    $stmt_fetch_rao_ps = mysqli_prepare($con, $sql_fetch_rao_ps);
    mysqli_stmt_bind_param($stmt_fetch_rao_ps, "i", $rao_ps_id);

    if (!mysqli_stmt_execute($stmt_fetch_rao_ps)) {
        throw new Exception("Error executing fetch rao_ps query: " . mysqli_error($con));
    }

    // Fetch the result
    $result_fetch_rao_ps = mysqli_stmt_get_result($stmt_fetch_rao_ps);

    if ($row = mysqli_fetch_assoc($result_fetch_rao_ps)) {
        $chairman = $row['chairman'];
        $period_covered = $row['period_covered'];
        $brgy_captain = $row['brgy_captain'];
    } else {
        throw new Exception("No data found for rao_ps_id: " . $rao_ps_id . " in tb_rao_ps");
    }

    // Close the statement to free resources
    mysqli_stmt_close($stmt_fetch_rao_ps);

    /////////////////////////////// AP

    $rao_ps_ap = []; // Initialize the array for storing fetched rao_ps_ap data

    // Fetch data from tb_rao_ps_ap
    $sql_fetch_rao_ps_ap = "SELECT * FROM tb_rao_ps_ap WHERE rao_ps_id = ?";
    $stmt_fetch_rao_ps_ap = mysqli_prepare($con, $sql_fetch_rao_ps_ap);
    mysqli_stmt_bind_param($stmt_fetch_rao_ps_ap, "i", $rao_ps_id);
    if (!mysqli_stmt_execute($stmt_fetch_rao_ps_ap)) {
        throw new Exception("Error executing fetch rao_ps_ap query: " . mysqli_error($con));
    }
    $rao_ps_ap_result = mysqli_stmt_get_result($stmt_fetch_rao_ps_ap);

    // Fetch rows into $rao_ps_ap
    while ($row = $rao_ps_ap_result->fetch_assoc()) {
        $rao_ps_ap[] = $row; // Append each row to the array
    }

    mysqli_stmt_close($stmt_fetch_rao_ps_ap);

    ///////////////////////////// OB
    $rao_ps_ob = []; // Initialize the array for storing fetched rao_ps_ob data

    // Fetch data from tb_rao_ps_ob
    $sql_fetch_rao_ps_ob = "SELECT * FROM tb_rao_ps_ob WHERE rao_ps_id = ?";
    $stmt_fetch_rao_ps_ob = mysqli_prepare($con, $sql_fetch_rao_ps_ob);
    mysqli_stmt_bind_param($stmt_fetch_rao_ps_ob, "i", $rao_ps_id);
    if (!mysqli_stmt_execute($stmt_fetch_rao_ps_ob)) {
        throw new Exception("Error executing fetch rao_ps_ob query: " . mysqli_error($con));
    }
    $rao_ps_ob_result = mysqli_stmt_get_result($stmt_fetch_rao_ps_ob);

    // Fetch rows into $rao_ps_ob
    while ($row = $rao_ps_ob_result->fetch_assoc()) {
        $rao_ps_ob[] = $row; // Append each row to the array
    }

    mysqli_stmt_close($stmt_fetch_rao_ps_ob);

    //////////////////////////// TOTALS

    //Fetch from tb_rao_ps_ap_totals
    $rao_ps_BF_totals = [];
    $rao_ps_TA_totals = [];
    $rao_ps_TO_totals = [];
    $rao_ps_OB_totals = [];
    $rao_ps_AB_totals = [];

    // Fetch data from tb_rao_ps_ap_totals
    $sql_fetch_rao_ps_totals = "SELECT * FROM tb_rao_ps_totals WHERE rao_ps_id = ? AND isDisplayed = 1";
    $stmt_fetch_rao_ps_totals = mysqli_prepare($con, $sql_fetch_rao_ps_totals);
    mysqli_stmt_bind_param($stmt_fetch_rao_ps_totals, "i", $rao_ps_id);

    if (!mysqli_stmt_execute($stmt_fetch_rao_ps_totals)) {
        throw new Exception("Error executing fetch rao_ps_ap query: " . mysqli_error($con));
    }

    $rao_ps_totals_result = mysqli_stmt_get_result($stmt_fetch_rao_ps_totals);

    // Fetch rows and separate by total_type
    while ($row = $rao_ps_totals_result->fetch_assoc()) {
        if ($row['total_type'] == 'BF') {
            $rao_ps_BF_totals[] = $row;
        } elseif ($row['total_type'] == 'TA') {
            $rao_ps_TA_totals[] = $row;
        }elseif ($row['total_type'] == 'TO') {
            $rao_ps_TO_totals[] = $row;
        } elseif ($row['total_type'] == 'OB') {
            $rao_ps_OB_totals[] = $row;
        }elseif($row['total_type'] == 'AB'){
            $rao_ps_AB_totals[] = $row;
        }
    }

    // Close the statement
    mysqli_stmt_close($stmt_fetch_rao_ps_totals);

     // Commit transaction
     mysqli_commit($con);

     // Prepare response
    $response = [
        'status' => 'true',
        'rao_ps_id' => $rao_ps_id,
        'chairman' => $chairman,
        'period_covered' => $period_covered,
        'brgy_captain' => $brgy_captain,
        'rao_ps_ap' => $rao_ps_ap,
        'rao_ps_BF_totals' =>  $rao_ps_BF_totals,
        'rao_ps_TA_totals' =>  $rao_ps_TA_totals,
        'rao_ps_ob' => $rao_ps_ob,
        'rao_ps_TO_totals' => $rao_ps_TO_totals,
        'rao_ps_OB_totals'  =>$rao_ps_OB_totals,
        'rao_ps_AB_totals' => $rao_ps_AB_totals,

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

