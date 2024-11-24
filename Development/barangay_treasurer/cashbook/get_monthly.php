<?php
include('../../connection.php');

$date = $_GET['date'];
$monthYear = date('Y-m', strtotime($date));
$previousMonthYear = date('Y-m', strtotime('first day of previous month', strtotime($monthYear . '-01')));

try {
    // Check if the selected month record already exists
    $sql_date_check = "SELECT COUNT(*) as month_count FROM tb_cashbook_monthly WHERE DATE_FORMAT(date_data, '%Y-%m') = ? AND isDisplayed = 1";
    $stmt_date_check = mysqli_prepare($con, $sql_date_check);
    mysqli_stmt_bind_param($stmt_date_check, "s", $monthYear);
    mysqli_stmt_execute($stmt_date_check);
    mysqli_stmt_bind_result($stmt_date_check, $count);
    mysqli_stmt_fetch($stmt_date_check);
    mysqli_stmt_close($stmt_date_check);

    if ($count > 0) {
        $response = [
            'status' => 'false',
            'error' => 'A record for this month already exists. Please choose a different period.'
        ];
        echo json_encode($response);
        exit;
    }

    // Get the earliest recorded month
    $earliestMonthQuery = "SELECT MIN(DATE_FORMAT(date_data, '%Y-%m')) as earliest_month FROM tb_cashbook_monthly WHERE isDisplayed = 1";
    $earliestMonthStmt = mysqli_prepare($con, $earliestMonthQuery);
    mysqli_stmt_execute($earliestMonthStmt);
    mysqli_stmt_bind_result($earliestMonthStmt, $earliestMonth);
    mysqli_stmt_fetch($earliestMonthStmt);
    mysqli_stmt_close($earliestMonthStmt);

    // Check if selected month is before the earliest record
    if ($earliestMonth && $monthYear < $earliestMonth) {
        // Fetch initial balances for dates before the earliest record
        $initQuery = "SELECT clt_init_balance, cb_init_balance FROM tb_cashbook_init LIMIT 1";
        $initStmt = mysqli_prepare($con, $initQuery);
        mysqli_stmt_execute($initStmt);
        mysqli_stmt_bind_result($initStmt, $clt_init_balance, $cb_init_balance);
        mysqli_stmt_fetch($initStmt);
        mysqli_stmt_close($initStmt);

        $response = [
            'status' => 'true',
            'clt_start_balance' => $clt_init_balance,
            'cb_start_balance' => $cb_init_balance
        ];
    } else {
        // Original logic for dates after earliest record
        $missingMonthsQuery = "
            SELECT DATE_FORMAT(date_data, '%Y-%m') AS month FROM tb_cashbook_monthly 
            WHERE DATE_FORMAT(date_data, '%Y-%m') <= ? AND isDisplayed = 1 
            ORDER BY date_data ASC";
        $missingMonthsStmt = mysqli_prepare($con, $missingMonthsQuery);
        mysqli_stmt_bind_param($missingMonthsStmt, 's', $monthYear);
        mysqli_stmt_execute($missingMonthsStmt);
        mysqli_stmt_bind_result($missingMonthsStmt, $existingMonth);

        $existingMonths = [];
        while (mysqli_stmt_fetch($missingMonthsStmt)) {
            $existingMonths[] = $existingMonth;
        }
        mysqli_stmt_close($missingMonthsStmt);

        $startDate = new DateTime($existingMonths[0] ?? $previousMonthYear);
        $endDate = new DateTime($monthYear);
        $expectedMonths = [];
        
        while ($startDate <= $endDate) {
            $expectedMonths[] = $startDate->format('Y-m');
            $startDate->modify('+1 month');
        }

        $missingMonths = array_diff($expectedMonths, $existingMonths);
        $firstMissingMonth = reset($missingMonths);

        if (!empty($missingMonths)) {
            $balanceQuery = "
                SELECT clt_end_balance, cb_end_balance FROM tb_cashbook_monthly 
                WHERE DATE_FORMAT(date_data, '%Y-%m') < ? AND isDisplayed = 1 
                ORDER BY date_data DESC LIMIT 1";
            $balanceStmt = mysqli_prepare($con, $balanceQuery);
            mysqli_stmt_bind_param($balanceStmt, 's', $firstMissingMonth);
            mysqli_stmt_execute($balanceStmt);
            mysqli_stmt_bind_result($balanceStmt, $clt_end_balance, $cb_end_balance);
            mysqli_stmt_fetch($balanceStmt);
            mysqli_stmt_close($balanceStmt);

            $response = [
                'status' => 'false',
                'error' => 'The following months are missing: ' . implode(', ', $missingMonths),
                'missingMonths' => $missingMonths,
                'firstMissingMonth' => $firstMissingMonth,
                'clt_start_balance' => $clt_end_balance,
                'cb_start_balance' => $cb_end_balance
            ];
        } else {
            $initQuery = "SELECT clt_init_balance, cb_init_balance FROM tb_cashbook_init LIMIT 1";
            $initStmt = mysqli_prepare($con, $initQuery);
            mysqli_stmt_execute($initStmt);
            mysqli_stmt_bind_result($initStmt, $clt_init_balance, $cb_init_balance);
            mysqli_stmt_fetch($initStmt);
            mysqli_stmt_close($initStmt);

            $response = [
                'status' => 'true',
                'clt_start_balance' => $clt_init_balance,
                'cb_start_balance' => $cb_init_balance
            ];
        }
    }
} catch (Exception $e) {
    $response = [
        'status' => 'false',
        'error' => $e->getMessage()
    ];
}

mysqli_close($con);
echo json_encode($response);
?>