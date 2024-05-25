<?php
require '../config/protected.php';
require '../vendor/autoload.php';
require '../app/controller/OrderController.php';

$controller = new OrderController($conn);

if (isset($_GET['id'])) {
    $order = $controller->getOrderById($_GET['id']);
    $user = $controller->getUserById($order['user_id']);
    $inventory = $controller->getInventoryById($order['inventory_id']);
}

$invoiceData = [
    'order_date' => $order['order_date'],
    'order_id' => $order['id'],
    'user_name' => $user['username'],
    'inventory_name' => $inventory['nama'],
    'quantity' => $order['quantity'],
    'total_price' => $order['total_price'],
    'email' => $order['email'],
    'address' => $order['address'],
    'paymentMethod' => $order['paymentMethod'],
    'status' => $order['status']
];

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
$pdf->Image('../public/img/logo.png', 10, 0, 50);

// Set font
$pdf->SetFont('helvetica', '', 12);

// Add a logo

// Add header
$pdf->SetFont('helvetica', 'B', 20);
$pdf->Cell(0, 15, 'INVOICE', 0, 1, 'C');

// Set font
$pdf->SetFont('helvetica', '', 12);
// Add order details
$pdf->Cell(0, 5, 'Order ID: ' . $invoiceData['order_id'], 0, 1);
$pdf->Cell(0, 5, 'Order Date: ' . $invoiceData['order_date'], 0, 1);
$pdf->Ln(10);

// Set up the table
$pdf->SetFillColor(240, 240, 240); // Set background color
$pdf->SetTextColor(0, 0, 0);       // Set text color
$pdf->SetDrawColor(200, 200, 200); // Set border color
$pdf->SetLineWidth(0.3);

// Set column widths
$col1_width = 40;
$col2_width = 0;

// Add table headers

$pdf->Cell($col1_width, 10, 'User:', 1, 0, 'L', 1);
$pdf->Cell($col2_width, 10, $invoiceData['user_name'], 1, 1, 'L', 0);

$pdf->Cell($col1_width, 10, 'Email:', 1, 0, 'L', 1);
$pdf->Cell($col2_width, 10, $invoiceData['email'], 1, 1, 'L', 0);

$pdf->Cell($col1_width, 10, 'Address:', 1, 0, 'L', 1);
$pdf->Cell($col2_width, 10, $invoiceData['address'], 1, 1, 'L', 0);

$pdf->Cell($col1_width, 10, 'Status:', 1, 0, 'L', 1);
$pdf->Cell($col2_width, 10, $invoiceData['status'], 1, 1, 'L', 0);

// Add a line break
$pdf->Ln(10);

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
$pdf->Cell($columnWidths[0], 5, 'Item', 1, 0, 'C', 1);
$pdf->Cell($columnWidths[1], 5, 'Qty', 1, 0, 'C', 1);
$pdf->Cell($columnWidths[2], 5, 'Unit Price', 1, 0, 'C', 1);
$pdf->Cell($columnWidths[3], 5, 'Total', 1, 1, 'C', 1);

// Add table data
$pdf->SetFont('helvetica', '', 12);
$pdf->SetX($startX); // Set the X position
$pdf->Cell($columnWidths[0], 5, $invoiceData['inventory_name'], 1);
$pdf->Cell($columnWidths[1], 5, $invoiceData['quantity'], 1, 0, 'C');
$pdf->Cell($columnWidths[2], 5, 'Rp' . number_format($invoiceData['total_price'] / $invoiceData['quantity'], 2), 1, 0, 'R');
$pdf->Cell($columnWidths[3], 5, 'Rp' . number_format($invoiceData['total_price'], 2), 1, 1, 'R');

// Add a line break
$pdf->Ln(5);

// Add total price
$pdf->SetFont('helvetica', 'B', 12);
$pdf->SetX($startX); // Set the X position
$pdf->Cell($columnWidths[0] + $columnWidths[1] + $columnWidths[2], 5, 'Total:', 0, 0, 'R');
$pdf->Cell($columnWidths[3], 5, 'Rp' . number_format($invoiceData['total_price'], 2), 1, 1, 'R');

// Add QR code
$pdf->Ln(10); // Add some space before the QR code
$pdf->Cell(0, 10, 'Payment Method: ' . $invoiceData['paymentMethod'], 0, 1);
$qrUrl = 'https://saweria.co/untilspwn';
$pdf->write2DBarcode($qrUrl, 'QRCODE,L', '', '', 50, 50);

// Add footer
$pdf->SetY(-50);
$pdf->SetFont('helvetica', 'I', 12);
$pdf->Cell(0, 10, 'Thank you for your purchase!', 0, 1, 'C');
$pdf->Cell(0, 10, 'Contact us at support@pedilz.com', 0, 1, 'C');

// Output PDF
$pdf->Output('invoice.pdf', 'I');
