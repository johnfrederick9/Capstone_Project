<?php
include('../../connection.php');

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    
    // Query to get the specific indigency record
    $sql = "SELECT * FROM tb_indigency WHERE indigency_id = $id";
    $query = mysqli_query($con, $sql);
    
    if ($row = mysqli_fetch_assoc($query)) {
        // Convert indigency_date into the desired format
        $originalDate = $row['indigency_date'];
        $formattedDate = date('jS F Y', strtotime($originalDate)); // 13th September 2024 format

        // Output the certificate in HTML format with the provided design
        echo '
        <html>
        <head>
            <style>
                @page {
                    size: A4;
                    margin: 0;
                }
                body {
                    margin: 1cm;
                    font-size: 12pt;
                    background-color: #f5f5f5;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    min-height: 100vh;
                }
                .certificate-container {
                    background-color: white;
                    width: 8.5in;
                    height: 11in;
                    margin: auto;
                    padding: 30px;
                    box-sizing: border-box;
                    border: 10px solid black;
                    position: relative;
                }
                .border-inner {
                    border: 1px solid #444;
                    padding: 20px;
                    height: calc(100% - 40px);
                    box-sizing: border-box;
                    display: flex;
                    flex-direction: column;
                    justify-content: space-between;
                    position: relative;
                }
                .header, .footer {
                    text-align: center;
                    margin-bottom: 20px;
                }
                .header img {
                    width: 60px;
                    height: auto;
                }
                .header h1 {
                    font-size: 14px;
                    margin: 5px 0;
                }
                .header h2 {
                    font-size: 16px;
                    margin: 5px 0;
                    text-transform: uppercase;
                    font-weight: bold;
                }
                .header h3 {
                    font-size: 14px;
                    margin: 5px 0;
                }
                .content p {
                    margin: 15px 0;
                    text-align: justify;
                    line-height: 1.5;
                }
                .content strong {
                    text-transform: uppercase;
                }
                .signature {
                    text-align: left;
                    margin-top: 30px;
                }
                .signature strong {
                    display: block;
                    margin-top: 5px;
                    font-size: 14px;
                }
                .footer {
                    text-align: left;
                    font-size: 14px;
                    margin-top: 10px;
                    border-top: 1px solid #000;
                    padding-top: 5px;
                    width: 99%;
                }
                .footer div {
                    display: inline-block;
                    width: 48%;
                }
                .footer .left {
                    text-align: left;
                }
                .footer .right {
                    text-align: right;
                }
                .action-buttons {
                    margin-top: 5px;
                    text-align: center;
                }
                .action-buttons button {
                    margin: 5px;
                    padding: 10px 20px;
                    font-size: 16px;
                    cursor: pointer;
                    border-radius: 10px;
                }
                @media print {
                    body {
                        margin: 0;
                        padding: 0;
                    }
                    .certificate-container {
                        border: 10px solid black;
                        margin: 0;
                        padding: 0;
                        width: 8.5in;
                        height: 11in;
                        page-break-after: always;
                    }
                    .action-buttons, .action-buttons button {
                        display: none;
                    }
                }
            </style>
        </head>
        <body>
            <div class="certificate-container">
                <div class="border-inner">
                    <div class="header">
                        <img src="../../assets/image/Logo.png" alt="Logo">
                        <h1>Republic of the Philippines</h1>
                        <h2>Province of Cebu</h2>
                        <h3>Municipality of Dalaguete<br>Barangay Mantalongon</h3>
                        <h3>OFFICE OF THE PUNONG BARANGAY</h3>
                        <h2>BARANGAY CERTIFICATION</h2>
                        <h3>(Certificate of Indigency)</h3>
                    </div>
                    <div class="content">
                        <p><strong>TO WHOM IT MAY CONCERN:</strong></p>
                        <p>This is to CERTIFY that <strong>'.$row['indigency_cname'].'</strong> is a resident of and with postal address of Mantalongon, Dalaguete, Cebu Philippines is known as a person of good moral standing in the community and has no record inimical to the society pursuant to the files available in this office.</p>
                        <p>And the person mentioned above is the child of the spouses namely: <strong>'.$row['indigency_fname'].' and '.$row['indigency_mname'].'</strong> that belongs to indigent families of this barangay.</p>
                        <p>This is to certify further that the total amount annual family income of his/her parents will not reach 50,000 which is a way below poverty threshold level.</p>
                        <p>This certification is issued upon the request of the above mentioned named <strong>'.$row['indigency_cname'].'</strong> for Working/Scholarship Application/Requirements.</p>
                        <p>Issued this '.$formattedDate.' at Mantalongon, Dalaguete, Cebu</p>
                    </div>
                    <div class="signature">
                        <strong>JOSEPHINE B. NEPOMUCENO</strong>
                        <p>Punong Barangay</p>
                    </div>
                    <div class="footer">
                        <div class="left">
                            <p>PAID: <strong>₱50.00</strong></p>
                            <p>D.S.T.: <strong>₱30.00</strong></p>
                        </div>
                        <div class="right">
                            <p>Not valid w/o Official seal</p>
                        </div>
                    </div>
                </div>
            </div>
        </body>
        </html>';
    } else {
        echo "No record found!";
    }
} else {
    echo "Invalid request!";
}
?>
