<?php
include('../../connection.php');

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    
    // Query to fetch employee details
    $sql = "SELECT * FROM tb_business_m WHERE bemp_id = $id";
    $query = mysqli_query($con, $sql);
    
    // Query to fetch Barangay Captain's details
    $captain_sql = "SELECT lastname, firstname, middlename, barangayposition 
                    FROM tb_user 
                    WHERE barangayposition = 'Barangay Captain'";
    $captain_query = mysqli_query($con, $captain_sql);

    // Check if both queries are successful
    if ($row = mysqli_fetch_assoc($query)) {
        $captain_row = mysqli_fetch_assoc($captain_query);

        // Format the Barangay Captain's name
        if ($captain_row) {
            $captain_name = strtoupper($captain_row['firstname'] . ' ' . substr($captain_row['middlename'], 0, 1) . '. ' . $captain_row['lastname']);
            $captain_position = $captain_row['barangayposition'];
        } else {
            $captain_name = "UNKNOWN";
            $captain_position = "Barangay Captain";
        }

        // Format the date
        $originalDate = $row['bemp_date'];
        $formattedDate = date('jS \d\a\y \o\f F Y', strtotime($originalDate));

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
                    font-family: "Times New Roman", Times, serif;
                    font-size: 12pt;
                }
                .certificate-container {
                    background-color: white;
                    width: calc(8.5in - 1in); /* Short bond paper size minus margins */
                    height: calc(11in - 1in);
                    padding: 1in; /* Ensures text and elements fit within the border */
                    box-sizing: border-box;
                    border: 10px solid black; /* Single outer border */
                    position: relative;
                }
                .header {
                    text-align: center;
                    margin-top: -20px;
                    margin-bottom: 2px;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                }
                    @media print {
                    img {
                        display: block !important;
                    }
                }

                .header img {
                    margin-top: -80px;
                    width: 80px;
                    height: 80px;
                }
                .header-content {
                    text-align: center;
                    flex-grow: 1;
                }
                .header h1 {
                    margin: 5px 0;
                    font-size: 18px;
                }
                .header h2 {
                    font-size: 14px;
                    text-transform: uppercase;
                    font-weight: bold;
                }
                .header h3 {
                    margin: 3px 0;
                    font-size: 13px;
                }
                .content {
                    text-align: justify;
                    margin-top: 10px;
                }
                .content p {
                    text-indent: 50px;
                    margin-bottom: 15px;
                    text-align: justify;
                    margin: 15px 0;
                    line-height: 1.6;
                }
                .signature {
                    margin-top: 30px;
                    text-align: left;
                }
                .signature strong {
                    display: block;
                    font-size: 14px;
                }
                .footer {
                    margin-top: 20px;
                    font-size: 12px;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                   
                    padding-top: 10px;
                }
                .footer-box {
                    border: 2px solid black;
                    text-align: center;
                    font-size: 14px;
                    width: 130px;
                }
                .footer-box .row {
                    display: grid;
                    grid-template-columns: 1fr 1fr; /* Two columns in each row */
                    text-align: left; /* Align text to the left within rows */
                    border-bottom: 1px solid black; /* Add a horizontal line to separate each row */
                    padding-bottom: 2px; /* Add some space after the line for visual separation */
                }

                .footer-box .column {
                    display: flex;
                    align-items: center; /* Center content vertically in each cell */
                    justify-content: center; /* Center content horizontally in each cell */
                    flex-direction: column; /* Stack items vertically if necessary */
                    padding: 2px; /* Add padding inside each column */
                }

                .footer-box .column:first-child {
                    border-right: 1px solid black; /* Add vertical line on the right of the first column */
                }

                .footer-box .row .column p {
                    margin: 0; /* Add spacing between lines */
                }
                .footer p {
                    margin: 0;
                    font-size: medium;
                }
                @media print {
                    body {
                        margin: 0;
                        padding: 0;
                    }
                    .certificate-container {
                        margin: 0;
                        padding: 1in; /* Maintain margins for printing */
                    }
                }
            </style>
        </head>
        <body>
            <div class="certificate-container">
                <div class="header">
                    <!-- Left-side municipal logo -->
                    <img src="../../assets/image/Logo.png">

                    <!-- Center header content -->
                    <div class="header-content">
                        <h3>Republic of the Philippines</h3>
                        <h3>Province of Cebu</h3>
                        <h3>Municipality of Dalaguete</h3>
                        <h3>Barangay Mantalongon</h3>
                        <h2 style="border-bottom: 1px solid black; display: inline-block; width: 100%; margin-left: auto; margin-right: auto;">OFFICE OF THE PUNONG BARANGAY</h2>
                        <h2 style="margin-bottom: 0; font: bold; margin-top: 0;">BARANGAY CLEARANCE</h2>
                    </div>

                    <!-- Right-side barangay logo -->
                    <img src="../../assets/image/municipal.png">
                </div>

                  <p>TO WHOM IT MAY CONCERN:</p>
                <div class="content">
                    <p>This is to certify for the application of <strong style="text-transform: uppercase;">'.$row['bemp_name'].'</strong>, . (resident in '.$row['bemp_address'].', Mantalongon, Dalaguete, Cebu) has employed as <strong style="text-transform: uppercase;">'.$row['bemp_employed'].'</strong>, located at '.$row['bemp_locate'].' of Barangay Mantalongon, Municipality of Dalaguete, Province of Cebu.</p>
                    <p>This certification is issued upon the request of the above name to support the application of business permit <strong>FOR OCCUPATIONAL REQUIREMENTS/EMPLOYMENT PURPOSES</strong>.</p>
                    <p>Given this '.$formattedDate.' at Mantalongon, Dalaguete, Cebu.</p>
                </div>
                 <div class="signature" style="display: inline-block; text-align: left;">
                    <strong style="display: block; text-align: left;"><u>'.$captain_name.'</u></strong>
                    <p style="text-align: center; margin-top: 0; width: center;">Punong Barangay</p>
                </div>
                <div class="footer">
                    <div class="footer-box">
                        <div class="row">
                            <div class="column">
                                <p>PAID:</p>
                            </div>
                            <div class="column">
                                <p><strong>₱'.$row['bemp_paid'].'.00</strong></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="column">
                                <p>D.S.T.:</p>
                            </div>
                            <div class="column">
                                <p><strong>₱'.$row['bemp_dst'].'.00</strong></p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>Not valid without the official seal</p>
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
