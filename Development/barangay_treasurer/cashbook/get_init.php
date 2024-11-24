<?php
include('../../connection.php');

try {
    // Query to fetch the initial balance record
    $query = "SELECT clt_init_balance, cb_init_balance FROM tb_cashbook_init LIMIT 1";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch the data as an associative array
        $data = mysqli_fetch_assoc($result);
        $response = array(
            'status' => 'true',
            'clt_init_balance' => $data['clt_init_balance'],
            'cb_init_balance' => $data['cb_init_balance']
        );
    } else {
        // No record found
        $response = array(
            'status' => 'false',
            'message' => 'No initial balance record found.'
        );
    }
} catch (Exception $e) {
    $response = array(
        'status' => 'false',
        'error' => $e->getMessage()
    );
}

mysqli_close($con);

// Return response as JSON
echo json_encode($response);
?>
