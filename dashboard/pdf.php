<?php
session_start();
if (isset($_SESSION['username']) == false) {
    header("location: index.php");
exit();
}
// Include FPDF library
require('../vendor/fpdf/fpdf.php');

// Include database connection
include "../service/connection.php";


// Query to fetch data from the database
// Query to fetch data with proper JOIN
$sql = "SELECT 
        r.id, 
        t.nama, 
        r.date, 
        r.time, 
        e.name AS event_name, 
        t.level AS class 
    FROM reports r
    JOIN tamu t ON r.fid_tamu = t.id
    JOIN events e ON r.events_fid = e.id
    WHERE DATE(r.time) = CURDATE()
";
$query = $conn->query($sql);


// Create instance of FPDF class
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Title of the PDF
$pdf->Cell(200, 10, 'Guest Book Report - ' . date('Y-m-d'), 0, 1, 'C');
$pdf->Ln(10); // Add space between title and table

// Set font for table header
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(0, 51, 102); // Dark blue background for header
$pdf->SetTextColor(255, 255, 255); // White text

// Table headers
$pdf->Cell(20, 10, 'ID', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Name', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'Date', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Time', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'Event', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Class', 1, 1, 'C', true);

// Set font for table data
$pdf->SetFont('Arial', '', 12);
$pdf->SetTextColor(0, 0, 0); // Black text

// Fetch data and fill the table
while ($row = $query->fetch_assoc()) {
    $pdf->Cell(20, 10, $row['id'], 1, 0, 'C');
    $pdf->Cell(30, 10, $row['nama'], 1, 0, 'C');
    $pdf->Cell(40, 10, $row['date'], 1, 0, 'C');
    $pdf->Cell(30, 10, $row['time'], 1, 0, 'C');
    $pdf->Cell(40, 10, $row['event_name'], 1, 0, 'C');
    $pdf->Cell(30, 10, $row['class'], 1, 1, 'C');
}


// Output the PDF
$pdf->Output();
