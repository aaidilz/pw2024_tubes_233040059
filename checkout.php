<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/app/controller/OrderController.php';
$controller = new OrderController($conn);

// Data yang akan ditampilkan di invoice
$invoiceData = [
    'product_name' => $_POST['product_name'],
    'price' => $_POST['price'],
    'quantity' => $_POST['quantity'],
    'total_price' => $_POST['price'] * $_POST['quantity'],
    'name' => $_POST['name'],
    'email' => $_POST['email'],
    'address' => $_POST['address'],
    'paymentMethod' => $_POST['paymentMethod']
];

// Buat instance TCPDF
$pdf = new TCPDF();

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Company');
$pdf->SetTitle('Invoice');
$pdf->SetSubject('Invoice PDF');
$pdf->SetKeywords('TCPDF, PDF, invoice');

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('helvetica', '', 12);

// Buat konten HTML untuk invoice
$html = '
<h1>Invoice</h1>
<p>Terima kasih atas pesanan Anda.</p>
<h2>Detail Pembelian</h2>
<table border="1" cellpadding="4">
    <tr>
        <th>Nama Produk</th>
        <td>' . $invoiceData['product_name'] . '</td>
    </tr>
    <tr>
        <th>Harga</th>
        <td>' . number_format($invoiceData['price'], 2) . '</td>
    </tr>
    <tr>
        <th>Kuantitas</th>
        <td>' . $invoiceData['quantity'] . '</td>
    </tr>
    <tr>
        <th>Total Harga</th>
        <td>' . number_format($invoiceData['total_price'], 2) . '</td>
    </tr>
</table>
<h2>Detail Pembeli</h2>
<table border="1" cellpadding="4">
    <tr>
        <th>Nama</th>
        <td>' . $invoiceData['name'] . '</td>
    </tr>
    <tr>
        <th>Email</th>
        <td>' . $invoiceData['email'] . '</td>
    </tr>
    <tr>
        <th>Alamat</th>
        <td>' . $invoiceData['address'] . '</td>
    </tr>
    <tr>
        <th>Metode Pembayaran</th>
        <td>' . $invoiceData['paymentMethod'] . '</td>
    </tr>
</table>
';

// Tulis HTML ke PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Tutup dan output PDF ke browser
$pdf->Output('invoice.pdf', 'I'); // 'I' untuk mengirim file ke browser, 'D' untuk mengunduh
?>