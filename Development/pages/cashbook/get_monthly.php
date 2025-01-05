<?php
include('../../connection.php');

$state = $_GET['state'] ?? null;
$date = $_GET['date'] ?? null;
$id = $_GET['id'] ?? null;

// Validate inputs
if (!in_array($state, ['insert', 'update']) || !$date || !strtotime($date)) {
    echo json_encode(['status' => 'false', 'error' => 'Invalid parameters.']);
    exit;
}
$id = is_numeric($id) ? intval($id) : null;

$monthYear = date('Y-m', strtotime($date));
$previousMonthYear = date('Y-m', strtotime('first day of previous month', strtotime($monthYear . '-01')));

$currentDate = date('Y-m');

try {

    // Check if the passed date is in the future
    if ($monthYear > $currentDate) {
        $response = [
            'status' => 'false',
            'error' => 'The selected date is yet to come. Please choose a valid date.'
        ];
        echo json_encode($response);
        exit;
    }

    // Check existing records
    $query = $state == 'update' 
        ? "SELECT COUNT(*) as month_count FROM tb_cashbook_monthly WHERE DATE_FORMAT(date_data, '%Y-%m') = ? AND isDisplayed = 1 AND cashbook_id != ?"
        : "SELECT COUNT(*) as month_count FROM tb_cashbook_monthly WHERE DATE_FORMAT(date_data, '%Y-%m') = ? AND isDisplayed = 1";

    $stmt = mysqli_prepare($con, $query);
    if ($state === 'update') {
        mysqli_stmt_bind_param($stmt, "si", $monthYear, $id);
    } else {
        mysqli_stmt_bind_param($stmt, "s", $monthYear);
    }
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $count);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if ($count > 0) {
        echo json_encode([
            'status' => 'false',
            'error_code' => 'DUPLICATE_RECORD',
            'error' => 'A record for this month already exists. Please choose a different period.'
        ]);
        exit;
    }

    

    // Get the earliest recorded month
    $earliestMonthQuery = "SELECT MIN(DATE_FORMAT(date_data, '%Y-%m')) as earliest_month FROM tb_cashbook_monthly WHERE isDisplayed = 1";
    $earliestMonthStmt = mysqli_prepare($con, $earliestMonthQuery);
    mysqli_stmt_execute($earliestMonthStmt);
    mysqli_stmt_bind_result($earliestMonthStmt, $earliestMonth);
    mysqli_stmt_fetch($earliestMonthStmt);
    mysqli_stmt_close($earliestMonthStmt);

    // Case when no records exist (i.e., first record being added)
    if (!$earliestMonth) {//PRIOR
        // Use the initial balances from the tb_cashbook_init table
        $initQuery = "SELECT clt_init_balance, cb_init_balance FROM tb_cashbook_init LIMIT 1";
        $initStmt = mysqli_prepare($con, $initQuery);
        mysqli_stmt_execute($initStmt);
        mysqli_stmt_bind_result($initStmt, $clt_init_balance, $cb_init_balance);
        mysqli_stmt_fetch($initStmt);
        mysqli_stmt_close($initStmt);
        
        // Set response with the initial balances
        $response = [
            'status' => 'true',
            'clt_start_balance' => $clt_init_balance,
            'cb_start_balance' => $cb_init_balance
        ];

    } else{//LATER
        // Case when records already exist (i.e., there are prior months)
        // Check if the selected month is before the earliest month
        if ($monthYear < $earliestMonth) {//PRIOR
            // If the selected month is earlier than the earliest record, return the initital balance
            //Allow insertion of the records earlier months.
            $initQuery = "SELECT clt_init_balance, cb_init_balance FROM tb_cashbook_init LIMIT 1";
            $initStmt = mysqli_prepare($con, $initQuery);
            mysqli_stmt_execute($initStmt);
            mysqli_stmt_bind_result($initStmt, $clt_init_balance, $cb_init_balance);
            mysqli_stmt_fetch($initStmt);
            mysqli_stmt_close($initStmt);
            
            // Set response with the initial balances
            $response = [
                'status' => 'true',
                'clt_start_balance' => $clt_init_balance,
                'cb_start_balance' => $cb_init_balance
            ];

        }else{//LATER
            // Case when record is later of the earliest month  (i.e.,)
            //Check if the selected month has previous month to use as initial balance
            if ($previousMonthYear) {
                // Get the previous month's ending balances
                $sql_previous_month_query = "SELECT clt_end_balance, cb_end_balance FROM tb_cashbook_monthly WHERE DATE_FORMAT(date_data, '%Y-%m') = ? AND isDisplayed = 1 LIMIT 1";
                $stmt_previous_month_query = mysqli_prepare($con, $sql_previous_month_query);
                mysqli_stmt_bind_param($stmt_previous_month_query, "s", $previousMonthYear);
                mysqli_stmt_execute($stmt_previous_month_query);
                mysqli_stmt_bind_result($stmt_previous_month_query, $clt_end_balance, $cb_end_balance);
                mysqli_stmt_fetch($stmt_previous_month_query);
                mysqli_stmt_close($stmt_previous_month_query);

                // If the previous month's balances are found, use them as the starting balance
                if ($clt_end_balance !== null && $cb_end_balance !== null) {
                    $response = [
                        'status' => 'true',
                        'clt_start_balance' => $clt_end_balance,
                        'cb_start_balance' => $cb_end_balance
                    ];
                } else {
                    // If no previous month's ending balance exists, return the initial balance
                    $response = [
                        'status' => 'true',
                        'clt_start_balance' => 0,
                        'cb_start_balance' => 0
                    ];
                }
            }else{
                // Case where no previous month exists (e.g., for the first record in the table)
                $response = [
                    'status' => 'true',
                    'clt_start_balance' => 0,
                    'cb_start_balance' => 0
                ];
            }


        }


    }
                   


    // Check if selected month is before the earliest record
    // if ($earliestMonth && $monthYear < $earliestMonth) {
    //     // Fetch initial balances for dates before the earliest record
    //     $initQuery = "SELECT clt_init_balance, cb_init_balance FROM tb_cashbook_init LIMIT 1";
    //     $initStmt = mysqli_prepare($con, $initQuery);
    //     mysqli_stmt_execute($initStmt);
    //     mysqli_stmt_bind_result($initStmt, $clt_init_balance, $cb_init_balance);
    //     mysqli_stmt_fetch($initStmt);
    //     mysqli_stmt_close($initStmt);

    //     $response = [
    //         'status' => 'true',
    //         'clt_start_balance' => $clt_init_balance,
    //         'cb_start_balance' => $cb_init_balance
    //     ];
    // } 
    //else {
    //     // Original logic for dates after earliest record
    //     $missingMonthsQuery = "
    //         SELECT DATE_FORMAT(date_data, '%Y-%m') AS month FROM tb_cashbook_monthly 
    //         WHERE DATE_FORMAT(date_data, '%Y-%m') <= ? AND isDisplayed = 1 
    //         ORDER BY date_data ASC";
    //     $missingMonthsStmt = mysqli_prepare($con, $missingMonthsQuery);
    //     mysqli_stmt_bind_param($missingMonthsStmt, 's', $monthYear);
    //     mysqli_stmt_execute($missingMonthsStmt);
    //     mysqli_stmt_bind_result($missingMonthsStmt, $existingMonth);

    //     $existingMonths = [];
    //     while (mysqli_stmt_fetch($missingMonthsStmt)) {
    //         $existingMonths[] = $existingMonth;
    //     }
    //     mysqli_stmt_close($missingMonthsStmt);

    //     $startDate = new DateTime($existingMonths[0] ?? $previousMonthYear);
    //     $endDate = new DateTime($monthYear);
    //     $expectedMonths = [];
        
    //     while ($startDate <= $endDate) {
    //         $expectedMonths[] = $startDate->format('Y-m');
    //         $startDate->modify('+1 month');
    //     }

    //     $missingMonths = array_diff($expectedMonths, $existingMonths);
    //     $firstMissingMonth = reset($missingMonths);

    //     if (!empty($missingMonths)) {
    //         $balanceQuery = "
    //             SELECT clt_end_balance, cb_end_balance FROM tb_cashbook_monthly 
    //             WHERE DATE_FORMAT(date_data, '%Y-%m') < ? AND isDisplayed = 1 
    //             ORDER BY date_data DESC LIMIT 1";
    //         $balanceStmt = mysqli_prepare($con, $balanceQuery);
    //         mysqli_stmt_bind_param($balanceStmt, 's', $firstMissingMonth);
    //         mysqli_stmt_execute($balanceStmt);
    //         mysqli_stmt_bind_result($balanceStmt, $clt_end_balance, $cb_end_balance);
    //         mysqli_stmt_fetch($balanceStmt);
    //         mysqli_stmt_close($balanceStmt);

    //         $response = [
    //             'status' => 'false',
    //             'error' => 'The following months are missing: ' . implode(', ', $missingMonths),
    //             'missingMonths' => $missingMonths,
    //             'firstMissingMonth' => $firstMissingMonth,
    //             'clt_start_balance' => $clt_end_balance,
    //             'cb_start_balance' => $cb_end_balance
    //         ];
    //     } else {
    //         $initQuery = "SELECT clt_init_balance, cb_init_balance FROM tb_cashbook_init LIMIT 1";
    //         $initStmt = mysqli_prepare($con, $initQuery);
    //         mysqli_stmt_execute($initStmt);
    //         mysqli_stmt_bind_result($initStmt, $clt_init_balance, $cb_init_balance);
    //         mysqli_stmt_fetch($initStmt);
    //         mysqli_stmt_close($initStmt);

    //         $response = [
    //             'status' => 'true',
    //             'clt_start_balance' => $clt_init_balance,
    //             'cb_start_balance' => $cb_init_balance
    //         ];
    //     }
    // }
} catch (Exception $e) {
    $response = [
        'status' => 'false',
        'error' => $e->getMessage()
    ];
}

mysqli_close($con);
echo json_encode($response);
?>