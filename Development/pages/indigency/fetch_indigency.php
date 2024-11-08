<?php
include('../../connection.php');

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    
    $sql = "SELECT * FROM tb_indigency WHERE indigency_id = $id";
    $query = mysqli_query($con, $sql);
    
    if ($row = mysqli_fetch_assoc($query)) {
        $originalDate = $row['indigency_date'];
        $formattedDate = date('jS F Y', strtotime($originalDate));

        echo '
        <html>
        <head>
            <style>
                @page {
                    margin: 0;
                }
                body {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    background-color: #f5f5f5;
                    min-height: 100vh;
                    font-size: 12pt;
                }
                .certificate-container {
                    background-color: white;
                    width: calc(8.5in - 1in); /* width of short bond paper minus 1/2-inch margins on each side */
                    height: calc(11in - 1in); /* height of short bond paper minus 1/2-inch margins on each side */
                    padding: 0.5in;
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
                }
                .header, .footer {
                    text-align: center;
                    margin-bottom: 20px;
                }
                .header img {
                    width: 60px;
                    height: auto;
                }
                .header h1, .header h2, .header h3 {
                    margin: 5px 0;
                }
                .header h2 {
                    font-size: 16px;
                    text-transform: uppercase;
                    font-weight: bold;
                }
                .content p {
                    margin: 15px 0;
                    text-align: justify;
                    line-height: 1.5;
                }
                .signature {
                    text-align: left;
                    margin-top: 30px;
                }
                .signature strong {
                    display: block;
                    font-size: 14px;
                }
                .footer {
                    text-align: left;
                    font-size: 14px;
                    margin-top: 10px;
                    border-top: 1px solid #000;
                    padding-top: 5px;
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
                    margin-top: 10px;
                    text-align: center;
                }
                .action-buttons button {
                    margin: 5px;
                    padding: 10px 20px;
                    font-size: 16px;
                    cursor: pointer;
                }
                .paper-select {
                    text-align: center;
                    margin-bottom: 10px;
                }
                @media print {
                    .action-buttons, .paper-select {
                        display: none;
                    }
                    body, .certificate-container {
                        margin: 0;
                        padding: 0;
                    }
                    .certificate-container {
                        border: 10px solid black;
                        width: calc(8.5in - 1in);
                        height: calc(11in - 1in);
                    }
                }
            </style>
            <script>
                function adjustPaperSize() {
                    const paperSize = document.getElementById("paperSize").value;
                    const certificateContainer = document.querySelector(".certificate-container");
                    
                    if (paperSize === "short") {
                        certificateContainer.style.width = "calc(8.5in - 1in)";
                        certificateContainer.style.height = "calc(11in - 1in)";
                    } else if (paperSize === "long") {
                        certificateContainer.style.width = "calc(8.5in - 1in)";
                        certificateContainer.style.height = "calc(13in - 1in)";
                    } else if (paperSize === "a4") {
                        certificateContainer.style.width = "calc(8.27in - 1in)";
                        certificateContainer.style.height = "calc(11.69in - 1in)";
                    }
                }
                window.onload = adjustPaperSize;
            </script>
        </head>
        <body>
            <div class="paper-select">
                <label for="paperSize">Select Paper Size:</label>
                <select id="paperSize" onchange="adjustPaperSize()">
                    <option value="short" selected>Short Bond Paper (8.5 x 11 in)</option>
                    <option value="long">Long Bond Paper (8.5 x 13 in)</option>
                    <option value="a4">A4 (8.27 x 11.69 in)</option>
                </select>
            </div>
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
