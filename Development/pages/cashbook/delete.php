<?php
include('../../connection.php');

// Retrieve and validate cashbook_id
$cashbook_id = mysqli_real_escape_string($con, $_POST["cashbook_id"] ?? '');

mysqli_begin_transaction($con);

try {
    if (empty($cashbook_id)) {
        echo json_encode(array('status' => 'failed', 'message' => 'Invalid cashbook_id'));
        exit();
    }

    // Step 1: Fetch the period_covered from the tb_cashbook table
    $sql_period_covered = "SELECT period_covered FROM tb_cashbook WHERE cashbook_id = ?";
    $stmt_period_covered = mysqli_prepare($con, $sql_period_covered);
    mysqli_stmt_bind_param($stmt_period_covered, 'i', $cashbook_id);

    if (!$stmt_period_covered || !mysqli_stmt_execute($stmt_period_covered)) {
        echo json_encode(array('status' => 'failed', 'message' => 'Failed to fetch period_covered: ' . mysqli_stmt_error($stmt_period_covered)));
        mysqli_close($con);
        exit();
    }

    mysqli_stmt_bind_result($stmt_period_covered, $period_covered);
    mysqli_stmt_fetch($stmt_period_covered);
    mysqli_stmt_close($stmt_period_covered);

    if (empty($period_covered)) {
        echo json_encode(array('status' => 'failed', 'message' => 'No period_covered found for the given cashbook_id'));
        mysqli_close($con);
        exit();
    }

    // Step 2: Update the tb_cashbook table (set isDisplayed = 0)
    $sql_update_cashbook = "UPDATE tb_cashbook SET isDisplayed = 0 WHERE cashbook_id = ?";
    $stmt_update_cashbook = mysqli_prepare($con, $sql_update_cashbook);
    mysqli_stmt_bind_param($stmt_update_cashbook, "i", $cashbook_id);

    if (!$stmt_update_cashbook || !mysqli_stmt_execute($stmt_update_cashbook)) {
        echo json_encode(array('status' => 'failed', 'message' => 'Failed to update tb_cashbook: ' . mysqli_stmt_error($stmt_update_cashbook)));
        mysqli_close($con);
        exit();
    }

    mysqli_stmt_close($stmt_update_cashbook);

    // Step 3: Update the tb_cashbook_monthly table (set isDisplayed = 0)
    $sql_update_monthly = "UPDATE tb_cashbook_monthly SET isDisplayed = 0 WHERE date_data = ?";
    $stmt_update_monthly = mysqli_prepare($con, $sql_update_monthly);
    mysqli_stmt_bind_param($stmt_update_monthly, "s", $period_covered);

    if (!$stmt_update_monthly || !mysqli_stmt_execute($stmt_update_monthly)) {
        echo json_encode(array('status' => 'failed', 'message' => 'Failed to update tb_cashbook_monthly: ' . mysqli_stmt_error($stmt_update_monthly)));
        mysqli_close($con);
        exit();
    }

    mysqli_stmt_close($stmt_update_monthly);

    // Commit all updates
    mysqli_commit($con);

    // Step 4: Query to get the updated earliest and latest dates after committing the updates
    $sql_dates = "SELECT 
    MIN(date_data) AS earliest_date,
    MAX(date_data) AS latest_date 
    FROM tb_cashbook_monthly
    WHERE isDisplayed = 1";

    $result_dates = mysqli_query($con, $sql_dates);

    if ($result_dates && mysqli_num_rows($result_dates) > 0) {
    $dates = mysqli_fetch_assoc($result_dates);

    $earliest_date = !empty($dates['earliest_date']) ? date('Y-m-d', strtotime($dates['earliest_date'])) : null;
    $latest_date = !empty($dates['latest_date']) ? date('Y-m-d', strtotime($dates['latest_date'])) : null;
    $target_date = date('Y-m-d', strtotime($period_covered));

    // Set the target date and status to always use 'First'
    $_GET['target_date'] = $earliest_date;
    $_GET['date_status'] = 'First';
    $message = "Recalculate from the first date";

    mysqli_free_result($result_dates);
    }

    $data = array(
    'status' => 'success',
    'message' => 'Cashbook and monthly records updated successfully',
    'earliest_date' => $earliest_date,
    'latest_date' => $latest_date,
    'target_date' => $target_date
    );

    if (isset($_GET['target_date'])) {
    include('recalculate_data.php');
    }


} catch (Exception $e) {
    mysqli_rollback($con);
    echo json_encode(array('status' => 'failed', 'error' => $e->getMessage()));
}

echo json_encode($data);
?>
