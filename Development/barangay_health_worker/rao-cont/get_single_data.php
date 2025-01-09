<?php
include('../../connection.php');

mysqli_begin_transaction($con);  // Start transaction
try {
    // Fetch rao_id from POST request
    $rao_cont_id = isset($_POST['rao_cont_id']) ? intval($_POST['rao_cont_id']) : 0;

    // Validate rao_id
    if ($rao_cont_id <= 0) {
        echo json_encode(['status' => 'false', 'error' => 'Invalid rao_cont_id']);
        exit();
    }

    // Prepare and execute SQL query
    $sql_fetch_attr_name = "SELECT rao_cont_att_id, attribute_name FROM tb_rao_cont_attributes WHERE rao_cont_id = ? AND isDisplayed = 1";
    $stmt_fetch_attr_name = mysqli_prepare($con, $sql_fetch_attr_name);
    mysqli_stmt_bind_param($stmt_fetch_attr_name, "i", $rao_cont_id);
    if (!mysqli_stmt_execute($stmt_fetch_attr_name)) {
        throw new Exception("Error executing fetch attribute query: " . mysqli_error($con));
    }
    // Bind and fetch results
    $result = mysqli_stmt_get_result($stmt_fetch_attr_name);
    $attribute_names = [];
    $attribute_ids = [];  // To store the rao_cont_att_id
    
    // Fetch all rows and collect attribute names and ids
    while ($row = mysqli_fetch_assoc($result)) {
        $attribute_names[] = $row['attribute_name'];
        $attribute_ids[] = $row['rao_cont_att_id'];  // Store the rao_cont_att_id
    }
    
    // Close the statement
    mysqli_stmt_close($stmt_fetch_attr_name);

    $sql_fetch_rao_cont = "SELECT chairman, period_covered, brgy_captain FROM tb_rao_cont WHERE rao_cont_id = ? AND isDisplayed = 1 ";
    $stmt_fetch_rao_cont = mysqli_prepare($con, $sql_fetch_rao_cont);
    mysqli_stmt_bind_param($stmt_fetch_rao_cont, "i", $rao_cont_id);

    if (!mysqli_stmt_execute($stmt_fetch_rao_cont)) {
        throw new Exception("Error executing fetch rao_cont query: " . mysqli_error($con));
    }

    // Fetch the result
    $result_fetch_rao_cont = mysqli_stmt_get_result($stmt_fetch_rao_cont);

    if ($row = mysqli_fetch_assoc($result_fetch_rao_cont)) {
        $chairman = $row['chairman'];
        $period_covered = $row['period_covered'];
        $brgy_captain = $row['brgy_captain'];
    } else {
        throw new Exception("No data found for rao_cont_id: " . $rao_cont_id . " in tb_rao_cont");
    }

    // Close the statement to free resources
    mysqli_stmt_close($stmt_fetch_rao_cont);

    /////////////////////////////// AP

    $rao_cont_ap = []; // Initialize the array for storing fetched rao_cont_ap data
    $rao_cont_ap_data = []; // Initialize the array for storing fetched rao_cont_ap_data

    // Fetch data from tb_rao_cont_ap
    $sql_fetch_rao_cont_ap = "SELECT * FROM tb_rao_cont_ap WHERE rao_cont_id = ?";
    $stmt_fetch_rao_cont_ap = mysqli_prepare($con, $sql_fetch_rao_cont_ap);
    mysqli_stmt_bind_param($stmt_fetch_rao_cont_ap, "i", $rao_cont_id);
    if (!mysqli_stmt_execute($stmt_fetch_rao_cont_ap)) {
        throw new Exception("Error executing fetch rao_cont_ap query: " . mysqli_error($con));
    }
    $rao_cont_ap_result = mysqli_stmt_get_result($stmt_fetch_rao_cont_ap);

    // Fetch rows into $rao_cont_ap
    while ($row = $rao_cont_ap_result->fetch_assoc()) {
        $rao_cont_ap[] = $row; // Append each row to the array
    }

    mysqli_stmt_close($stmt_fetch_rao_cont_ap);

    // Fetch data from tb_rao_cont_ap_data for each rao_cont_ap_id
    foreach ($rao_cont_ap as $apItem) {
        $rao_cont_ap_id = $apItem['rao_cont_ap_id']; // Get rao_cont_ap_id from the row

        $sql_fetch_rao_cont_ap_data = "SELECT * FROM tb_rao_cont_ap_data WHERE rao_cont_ap_id = ? AND isDisplayed = 1 ORDER BY rao_cont_att_id ASC";
        $stmt_fetch_rao_cont_ap_data = mysqli_prepare($con, $sql_fetch_rao_cont_ap_data);
        mysqli_stmt_bind_param($stmt_fetch_rao_cont_ap_data, "i", $rao_cont_ap_id);
        if (!mysqli_stmt_execute($stmt_fetch_rao_cont_ap_data)) {
            throw new Exception("Error executing fetch rao_cont_ap_data query: " . mysqli_error($con));
        }
        $rao_cont_ap_result_data = mysqli_stmt_get_result($stmt_fetch_rao_cont_ap_data);

        // Fetch rows into $rao_cont_ap_data
        while ($row = $rao_cont_ap_result_data->fetch_assoc()) {
            $rao_cont_ap_data[] = $row; // Append each row to the array
        }

        mysqli_stmt_close($stmt_fetch_rao_cont_ap_data);
    }

    //Fetch from tb_rao_cont_ap_totals
    $rao_cont_ap_BF_totals = [];
    $rao_cont_ap_TA_totals = [];

    // Fetch data from tb_rao_cont_ap_totals
    $sql_fetch_rao_cont_ap_totals = "SELECT * FROM tb_rao_cont_ap_totals WHERE rao_cont_id = ? AND isDisplayed = 1 ORDER BY rao_cont_att_id ASC";
    $stmt_fetch_rao_cont_ap_totals = mysqli_prepare($con, $sql_fetch_rao_cont_ap_totals);
    mysqli_stmt_bind_param($stmt_fetch_rao_cont_ap_totals, "i", $rao_cont_id);

    if (!mysqli_stmt_execute($stmt_fetch_rao_cont_ap_totals)) {
        throw new Exception("Error executing fetch rao_cont_ap query: " . mysqli_error($con));
    }

    $rao_cont_ap_totals_result = mysqli_stmt_get_result($stmt_fetch_rao_cont_ap_totals);

    // Fetch rows and separate by total_type
    while ($row = $rao_cont_ap_totals_result->fetch_assoc()) {
        if ($row['total_type'] == 'BF') {
            $rao_cont_ap_BF_totals[] = $row;
        } elseif ($row['total_type'] == 'TA') {
            $rao_cont_ap_TA_totals[] = $row;
        }
    }

    // Close the statement
    mysqli_stmt_close($stmt_fetch_rao_cont_ap_totals);


    //////////////////////////////////// OB

    $rao_cont_ob = []; // Initialize the array for storing fetched rao_cont_ob data
    $rao_cont_ob_data = []; // Initialize the array for storing fetched rao_cont_ob_data

    // Fetch data from tb_rao_cont_ob
    $sql_fetch_rao_cont_ob = "SELECT * FROM tb_rao_cont_ob WHERE rao_cont_id = ?";
    $stmt_fetch_rao_cont_ob = mysqli_prepare($con, $sql_fetch_rao_cont_ob);
    mysqli_stmt_bind_param($stmt_fetch_rao_cont_ob, "i", $rao_cont_id);
    if (!mysqli_stmt_execute($stmt_fetch_rao_cont_ob)) {
        throw new Exception("Error executing fetch rao_cont_ob query: " . mysqli_error($con));
    }
    $rao_cont_ob_result = mysqli_stmt_get_result($stmt_fetch_rao_cont_ob);

    // Fetch rows into $rao_cont_ob
    while ($row = $rao_cont_ob_result->fetch_assoc()) {
        $rao_cont_ob[] = $row; // Append each row to the array
    }

    mysqli_stmt_close($stmt_fetch_rao_cont_ob);

    // Fetch data from tb_rao_cont_ob_data for each rao_cont_ob_id
    foreach ($rao_cont_ob as $obItem) {
        $rao_cont_ob_id = $obItem['rao_cont_ob_id']; // Get rao_cont_ob_id from the row

        $sql_fetch_rao_cont_ob_data = "SELECT * FROM tb_rao_cont_ob_data WHERE rao_cont_ob_id = ? AND isDisplayed = 1 ORDER BY rao_cont_att_id ASC";
        $stmt_fetch_rao_cont_ob_data = mysqli_prepare($con, $sql_fetch_rao_cont_ob_data);
        mysqli_stmt_bind_param($stmt_fetch_rao_cont_ob_data, "i", $rao_cont_ob_id);
        if (!mysqli_stmt_execute($stmt_fetch_rao_cont_ob_data)) {
            throw new Exception("Error executing fetch rao_cont_ob_data query: " . mysqli_error($con));
        }
        $rao_cont_ob_result_data = mysqli_stmt_get_result($stmt_fetch_rao_cont_ob_data);

        // Fetch rows into $rao_cont_ob_data
        while ($row = $rao_cont_ob_result_data->fetch_assoc()) {
            $rao_cont_ob_data[] = $row; // Append each row to the array
        }

        mysqli_stmt_close($stmt_fetch_rao_cont_ob_data);
    }

    //Fetch from tb_rao_cont_ob_totals
    $rao_cont_ob_TO_totals = [];
    $rao_cont_ob_OB_totals = [];
    $rao_cont_ob_AB_totals = [];

    // Fetch data from tb_rao_cont_ob_totals
    $sql_fetch_rao_cont_ob_totals = "SELECT * FROM tb_rao_cont_ob_totals WHERE rao_cont_id = ? AND isDisplayed = 1 ORDER BY rao_cont_att_id ASC";
    $stmt_fetch_rao_cont_ob_totals = mysqli_prepare($con, $sql_fetch_rao_cont_ob_totals);
    mysqli_stmt_bind_param($stmt_fetch_rao_cont_ob_totals, "i", $rao_cont_id);

    if (!mysqli_stmt_execute($stmt_fetch_rao_cont_ob_totals)) {
        throw new Exception("Error executing fetch rao_cont_ob query: " . mysqli_error($con));
    }

    $rao_cont_ob_totals_result = mysqli_stmt_get_result($stmt_fetch_rao_cont_ob_totals);

    // Fetch rows and separate by total_type
    while ($row = $rao_cont_ob_totals_result->fetch_assoc()) {
        if ($row['total_type'] == 'TO') {
            $rao_cont_ob_TO_totals[] = $row;
        } elseif ($row['total_type'] == 'OB') {
            $rao_cont_ob_OB_totals[] = $row;
        }elseif($row['total_type'] == 'AB'){
            $rao_cont_ob_AB_totals[] = $row;
        }
    }

    // Close the statement
    mysqli_stmt_close($stmt_fetch_rao_cont_ob_totals);

    
// // Prepare and execute the SQL statement to fetch data from tb_rao
// $stmt = $con->prepare("SELECT * FROM tb_rao_cont WHERE rao_cont_id = ? LIMIT 1");
// $stmt->bind_param("s", $rao_cont_id);
// $stmt->execute();
// $result = $stmt->get_result();

// // Check for errors in the query
// if ($con->error) {
//     echo json_encode(array('error' => $con->error));
//     exit();
// }

// // Fetch the row
// $row = $result->fetch_assoc();

// // Check if row exists
// if ($row) {
//     // Fetch related data from tb_rao_ob_data
//     $relatedStmtob = $con->prepare("SELECT * FROM tb_rao_cont_ap_data WHERE rao_cont_id = ?");
//     $relatedStmtAp->bind_param("s", $rao_cont_id);
//     $relatedStmtAp->execute();
//     $relatedResultAp = $relatedStmtAp->get_result();
    
//     if ($relatedResultAp) {
//         $row['related_data_ap'] = $relatedResultAp->fetch_all(MYSQLI_ASSOC);
//     } else {
//         $row['related_data_ap'] = array('error' => $con->error);
//     }

//     // Fetch related data from tb_rao_ob_data
//     $relatedStmtOb = $con->prepare("SELECT * FROM tb_rao_ob WHERE rao__cont_id = ?");
//     $relatedStmtOb->bind_param("s", $rao_id);
//     $relatedStmtOb->execute();
//     $relatedResultOb = $relatedStmtOb->get_result();
    
//     if ($relatedResultOb) {
//         $row['related_data_ob'] = $relatedResultOb->fetch_all(MYSQLI_ASSOC);
//     } else {
//         $row['related_data_ob'] = array('error' => $con->error);
//     }

//     // Encode data to JSON and output
//     echo json_encode($row);
// } else {
//     echo json_encode(array('error' => 'No data found for the provided rao_id'));
// }

// // Close the prepared statements
// $stmt->close();
// $relatedStmtAp->close();
// $relatedStmtOb->close();


     // Commit transaction
     mysqli_commit($con);

     // Prepare response
    $response = [
        'status' => 'true',
        'rao_cont_id' => $rao_cont_id,
        'attribute_name' => $attribute_names,
        'attribute_ids' => $attribute_ids,  // Include the attribute IDs
        'chairman' => $chairman,
        'period_covered' => $period_covered,
        'brgy_captain' => $brgy_captain,
        'rao_cont_ap' => $rao_cont_ap,
        'rao_cont_ap_data' => $rao_cont_ap_data,
        'rao_cont_ap_BF_totals' =>  $rao_cont_ap_BF_totals,
        'rao_cont_ap_TA_totals' =>  $rao_cont_ap_TA_totals,
        'rao_cont_ob' => $rao_cont_ob,
        'rao_cont_ob_data' => $rao_cont_ob_data,
        'rao_cont_ob_TO_totals' => $rao_cont_ob_TO_totals,
        'rao_cont_ob_OB_totals'  =>$rao_cont_ob_OB_totals,
        'rao_cont_ob_AB_totals' => $rao_cont_ob_AB_totals,

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

