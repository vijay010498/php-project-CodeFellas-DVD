<?php
// Start or resume the session
session_start();

// Assuming you already have database connection code here

// Include FPDF library
require('fpdf/fpdf.php');

// Check if the 'checkout' action is triggered
if (isset($_POST['checkout'])) {
    // ... (previous code)

    // Create a PDF document
    $pdf = new FPDF();
    $pdf->AddPage();

    // Add order details to the PDF
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Order Details', 0, 1, 'C');
    $pdf->Ln(10);

    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'Order ID: ' . $orderId, 0, 1);
    $pdf->Cell(0, 10, 'User: ' . $user['username'], 0, 1);
    $pdf->Ln(10);

    // Add order items to the PDF
    $pdf->Cell(60, 10, 'Product', 1);
    $pdf->Cell(30, 10, 'Quantity', 1);
    $pdf->Cell(40, 10, 'Price', 1);
    $pdf->Ln();

    foreach ($cartItems as $item) {
        $pdf->Cell(60, 10, $item['name'], 1);
        $pdf->Cell(30, 10, $item['quantity'], 1);
        $pdf->Cell(40, 10, '$' . number_format($item['price'], 2), 1);
        $pdf->Ln();
    }

    // Add total price to the PDF
    $pdf->Cell(130, 10, 'Total Price', 1);
    $pdf->Cell(40, 10, '$' . number_format($totalPrice, 2), 1);
    
    // Save the PDF to a file or send to the browser
    $pdf->Output('order_invoice_' . $orderId . '.pdf', 'D');
}
?>
