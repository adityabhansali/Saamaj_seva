<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/SocietyManagement/config.php');
use Dompdf\Dompdf;

// Check if HTML is provided in the POST request
if(isset($_POST['html'])) {
    // Create a new Dompdf instance
    $dompdf = new Dompdf();

    // HTML content before the dynamic content
    $htmlStart = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table of Pachchigars</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .row {
            /* Remove the background-image property */
            padding: 10px;
            margin-bottom: 20px;
        }
        .col {
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            font-size: 14px; /* Adjust font size as needed */
            margin: 0; /* Remove margin */
        }
        .col p {
            margin-bottom: 0; /* Remove margin bottom from <p> elements inside .col */
        }
        .bold-text {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="">';

    // HTML content after the dynamic content
    $htmlEnd = '    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>';

    // Load HTML content from the POST request, with the start and end HTML
    $dompdf->loadHtml($htmlStart . $_POST['html'] . $htmlEnd);

    // Render the PDF
    $dompdf->render();

    // Define the directory where you want to save the PDF file
    $pdfDirectory = $_SERVER['DOCUMENT_ROOT'] . '/SocietyManagement/pdfs/';

    // Create the directory if it doesn't exist
    if (!file_exists($pdfDirectory)) {
        mkdir($pdfDirectory, 0777, true);
    }

    // Generate a unique filename for the PDF
    $pdfFileName = 'generated_pdf_' . uniqid() . '.pdf';

    // Store the PDF in the specified directory with the unique filename
    $pdfFilePath = $pdfDirectory . $pdfFileName;
    file_put_contents($pdfFilePath, $dompdf->output());

    // Response with the stored PDF location
    echo json_encode(array('pdf_location' => '/SocietyManagement/pdfs/' . $pdfFileName));
} else {
    // If HTML is not provided in the POST request, send an error response
    echo json_encode(array('error' => 'No HTML content provided'));
}
?>
