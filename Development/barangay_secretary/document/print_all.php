<?php
include('../../connection.php');


$sql = "SELECT * FROM tb_document WHERE isDisplayed=1";
$query = mysqli_query($con, $sql);

echo '<html>
<head>
    <title>Document Data</title>
    <style>
        @page {
            size: 8.5in 11in;
            margin: 10mm 15mm 20mm 15mm;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
            font-size: 12px;
            page-break-inside: avoid;
        }
        th {
            background-color: #f2f2f2;
        }
        .header {
            text-align: center;
            margin: 0;
            padding: 10px 0;
        }
        .header h1 {
            font-size: 18px;
            margin: 0;
        }
        .header p {
            font-size: 12px;
            margin: 0;
        }
        .img-thumbnail {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
            margin: 5px;
            max-width: 70px;
            max-height: 70px;
        }
        .img-thumbnail:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        @media print {
            body {
                margin: 0;
            }
            html, body {
                height: auto;
                overflow: visible;
            }
            .header, table {
                page-break-after: avoid;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Document Data Report</h1>
        <p>Barangay Information System</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>Document Name</th>
                <th>Document Date</th>
                <th>Document Info</th>
                <th>Document Type</th>
                <th>Images</th>
            </tr>
        </thead>
        <tbody>';

while ($row = mysqli_fetch_assoc($query)) {
    $document_id = $row['document_id'];

    // Fetch images for the document
    $imageQuery = "SELECT filepath FROM tb_document_files WHERE document_id = '$document_id'";
    $imageResult = mysqli_query($con, $imageQuery);

    $images = array();
    while ($imageRow = mysqli_fetch_assoc($imageResult)) {
        $filepath = $imageRow['filepath'];
        if (file_exists($filepath)) {
            $images[] = '<img src="' . $filepath . '" class="img-thumbnail" alt="Document Image">';
        } else {
            $images[] = '<p class="text-danger">Image not found</p>';
        }
    }

    $imagesHTML = !empty($images) ? implode('', $images) : '<p>No images available</p>';

    echo '<tr>
            <td>' . $row['document_name'] . '</td>
            <td>' . $row['document_date'] . '</td>
            <td>' . $row['document_info'] . '</td>
            <td>' . $row['document_type'] . '</td>
            <td>' . $imagesHTML . '</td>
          </tr>';
}

echo '</tbody></table>';
?>

<script>
    window.onload = function() {
        const images = document.querySelectorAll("img");
        const imagePromises = Array.from(images).map(img => {
            return new Promise(resolve => {
                if (img.complete) {
                    resolve();
                } else {
                    img.onload = resolve;
                    img.onerror = resolve;
                }
            });
        });

        Promise.all(imagePromises).then(() => {
            window.print();
            window.onafterprint = () => {
                window.close();
            };
        });
    };
</script>

</body>
</html>
