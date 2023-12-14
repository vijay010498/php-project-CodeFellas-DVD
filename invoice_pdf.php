<?php
//include connection file
require_once("Queries.php");
include_once('fpdf184/fpdf.php');

class PDF extends FPDF
{
    function Header()
    {

        //Display Company Info
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(50, 10, "DVD Fellas", 0, 1);
        $this->SetFont('Arial', '', 10);
        $this->Cell(50, 7, "University Avenue,", 0, 1);
        $this->Cell(50, 7, "Waterloo N2J L2K.", 0, 1);
        $this->Cell(50, 7, "PH : +1-(437)-233-0827", 0, 1);
        $this->Image('logo.png', 98, 10, 20);
        //Display INVOICE text
        $this->SetY(15);
        $this->SetX(-40);
        $this->SetFont('Arial', 'B', 18);
        $this->Cell(50, 10, "INVOICE", 0, 1);

        //Display Horizontal line
        $this->Line(0, 48, 210, 48);
    }

    function body($result)
    {
        $res = $result;
        // print_r($res); exit;
        //Billing Details
        $this->SetY(55);
        $this->SetX(10);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(50, 10, "Bill To: ", 0, 1);
        $this->SetFont('Arial', '', 10);
        $this->Cell(50, 7, $res[0]['firstName'], 0, 1);
        $this->Cell(50, 7, $res[0]['lastName'], 0, 1);
        $this->Cell(50, 7, $res[0]['phoneNumber'], 0, 1);
        $this->Cell(50, 7, $res[0]['address'], 0, 1);

        // //Display Invoice date
        $this->SetY(57);
        $this->SetX(-75);
        $this->Cell(50, 7, "Invoice Date : " . date('F d, Y'));

    }
    function invoice_table($value)
{
        $row = $value; 
        //Display Table headings
        $this->SetY(105);
        $this->SetX(10);
        $this->SetFillColor(180, 200, 200);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(30, 12, "Order #", 1, 0, "C", true);
        $this->Cell(50, 12, "DVD Details", 1, 0, "C", true);
        $this->Cell(30, 12, "Order Quanity", 1, 0, "C", true);
        $this->Cell(30, 12, "Price/Item", 1, 0, "C", true);
        $this->Cell(40, 12, "TOTAL", 1, 1, "C", true);
        $this->SetFont('Arial', '', 10);


        $total_amt = 0.00;
        //Display table product rows
        foreach ($value as $row) {
            $this->Cell(30, 30, $row['OrderId'], "LR", 0, "C");
            $this->Cell(50, 30, $row['Title'], "R", 0, "C");
            $this->Cell(30, 30, $row['OrderQuantity'], "R", 0, "C");
            $this->Cell(30, 30, $row['Price'], "R", 0, "C");
            $this->Cell(40, 30, $row['SubTotal'], "R", 1, "R");
            $total_amt += $row['SubTotal'];
            $totalamt_gst = $total_amt * 13 / 100 + $total_amt;
        }
        //Display table total row
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(140, 9, "TOTAL ( 13% GST + HST )", 1, 0, "R");
        $this->Cell(40, 9, number_format((float) $totalamt_gst, 2, '.', ''), 1, 1, "R");

        // //Display amount in words
        $this->SetY(225);
        $this->SetX(10);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 9, "Total Amount ", 0, 1);
        $this->Cell(0, 9, "------------------- ", 0, 1);
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 9, "CAD : $totalamt_gst", 0, 1);

    }
    function Footer()
    {
        //set footer position
        $this->SetY(-50);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, "for DVD Fellas", 0, 1, "R");
        $this->Ln(15);
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 10, "Authorized Signature", 0, 1, "R");
        $this->SetFont('Arial', '', 10);

        //Display Footer Text
        $this->Cell(0, 10, "This is a computer generated invoice", 0, 1, "C");

    }
}
class Invoice extends Queries{
    public function __construct()
    {
        parent::__construct();
    }
    public function getpdfDetails($userId, $orderId)
    {  

        $result = $this->pdfGeneration($userId);
        $value = $this->pdfOrderTable($userId, $orderId);
        
        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->body($result);
        $pdf->invoice_table($value);
        $pdf->Output();

        $pdf->Output('D');

        exit();
    }
}
// $invoice = new Invoice();
// $invoice->getpdfDetails(1, 54);
?>