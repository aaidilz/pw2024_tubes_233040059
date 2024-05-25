<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

// Start the session to manage user data
session_start();

// Include necessary files
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/app/controller/OrderController.php';

if (!isset($_GET['id'])) {
    die('User ID tidak ditemukan');
}

$user_id = $_GET['id'];
$controller = new OrderController($conn);
$order_details = $controller->getOrderDetailsByUserId($user_id);


$pdf = new TCPDF();

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Pedilz');
$pdf->SetTitle('Invoice');
$pdf->SetSubject('Invoice');
$pdf->SetKeywords('Invoice');

// Set margins and auto page break
$pdf->SetMargins(20, 20, 20);
$pdf->SetAutoPageBreak(true, 20);

// Add a page
$pdf->AddPage();
$pdf->Image('public/img/logo.png', 10, 0, 50);

// Set font
$pdf->SetFont('helvetica', '', 12);

// Add a logo

// Add header
$pdf->SetFont('helvetica', 'B', 20);
$pdf->Cell(0, 15, 'INVOICE', 0, 1, 'C');

// Set font
$pdf->SetFont('helvetica', '', 12);
// Adjust column widths to fit the table within the page
$columnWidths = [80, 20, 45, 45];

// Calculate total width of the table
$totalWidth = array_sum($columnWidths);

// Calculate the starting X position to center the table
$startX = ($pdf->GetPageWidth() - $totalWidth) / 2;

// Add table header
$pdf->SetFont('helvetica', 'B', 12);
$pdf->SetFillColor(224, 235, 255);
$pdf->SetX($startX); // Set the X position
$pdf->Cell($columnWidths[0], 5, 'Nama Barang', 1, 0, 'C', 1);
$pdf->Cell($columnWidths[1], 5, 'Qty', 1, 0, 'C', 1);
$pdf->Cell($columnWidths[2], 5, 'Harga Unit', 1, 0, 'C', 1);
$pdf->Cell($columnWidths[3], 5, 'Total', 1, 1, 'C', 1);

// add order data for each
$pdf->SetFont('helvetica', '', 12);
foreach ($order_details as $order) {
    $pdf->SetX($startX); // Set the X position
    $pdf->Cell($columnWidths[0], 5, $order['inventory_name'], 1, 0, 'L', 0);
    $pdf->Cell($columnWidths[1], 5, $order['quantity'], 1, 0, 'C', 0);
    $pdf->Cell($columnWidths[2], 5, 'Rp' . number_format($order['harga'], 0, ',', '.'), 1, 0, 'R', 0);
    $pdf->Cell($columnWidths[3], 5, 'Rp' . number_format($order['total_price'], 0, ',', '.'), 1, 1, 'R', 0);
}

// Add a line break
$pdf->Ln(5);

// Add total price
$pdf->SetFont('helvetica', 'B', 12);
$pdf->SetX($startX); // Set the X position
$pdf->Cell($columnWidths[0] + $columnWidths[1] + $columnWidths[2], 5, 'Total:', 0, 0, 'R');
$pdf->Cell($columnWidths[3], 5, 'Rp' . number_format(array_sum(array_column($order_details, 'total_price')), 0, ',', '.'), 1, 1, 'R');

// Add QR code
$pdf->Ln(10); // Add some space before the QR code
$pdf->Cell(0, 10, 'Payment Method: ' . $order['paymentMethod'], 0, 1);
$qrUrl = 'https://saweria.co/untilspwn';
$pdf->write2DBarcode($qrUrl, 'QRCODE,L', '', '', 50, 50);

// Add footer
$pdf->SetY(-50);
$pdf->SetFont('helvetica', 'I', 12);
$pdf->Cell(0, 10, 'Thank you for your purchase!', 0, 1, 'C');
$pdf->Cell(0, 10, 'Contact us at support@pedilz.com', 0, 1, 'C');


// Close and output PDF document
$pdf->Output('order_details.pdf', 'I');
