<?php
    //INDIGENCY_CERTIFICATE CODE
    // Fetch certificate details using the ID
    if (isset($_GET['indigency_id'])) {
        $indigency_id = $_GET['indigency_id'];
        $stmt = $conn->prepare("SELECT * FROM tb_indigency WHERE indigency_id = ?");
        $stmt->bind_param("i", $indigency_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        // Format the date from the database
        $indigency_date = date("jS F Y", strtotime($row['indigency_date']));
    }
?>