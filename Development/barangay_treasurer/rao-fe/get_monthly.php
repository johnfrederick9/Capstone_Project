<?php
include('../../connection.php');

$task = $_GET['task'];
$date = $_GET['date'];
$id = $_GET['id'];
$monthYear = date('Y-m', strtotime($date));
$previousMonthYear = date('Y-m', strtotime('first day of previous month', strtotime($monthYear . '-01')));

try {
    
    // Check if the selected month record already exists
    if($task == "update"){


         // If it's an update task, we exclude the current record with the provided id
         $sql_date_check = "SELECT COUNT(*) as month_count FROM tb_rao_fe WHERE DATE_FORMAT(period_covered, '%Y-%m') = ? AND isDisplayed = 1 AND rao_fe_id != ?";
         $stmt_date_check = mysqli_prepare($con, $sql_date_check);
         mysqli_stmt_bind_param($stmt_date_check, "si", $monthYear, $id); // Bind the date and the id
         mysqli_stmt_execute($stmt_date_check);
         mysqli_stmt_bind_result($stmt_date_check, $count);
         mysqli_stmt_fetch($stmt_date_check);
         mysqli_stmt_close($stmt_date_check);
 
         if ($count > 0) {
             $response = [
                 'status' => 'false',
                 'count'=>$count,
                 'error' => 'A record for this month already exists. Please choose a different period.'
             ];
             echo json_encode($response);
             exit;
         }
         $response = [
             'status' => 'true',
             'count'=>$count,
         ];

    }
    else{ //if task is "insert"
        $sql_date_check = "SELECT COUNT(*) as month_count FROM tb_rao_fe WHERE DATE_FORMAT(period_covered, '%Y-%m') = ? AND isDisplayed = 1";
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
        $response = [
            'status' => 'true',
        ];
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
