<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PdfController extends Controller
{
    protected $pdf;

    public function __construct()
    {
//        $this->middleware('auth');
        $this->pdf = new Fpdf;
    }

    public function paymentReport($id,$fDate,$tDate)
    {
        $sl = 0;
        $receivedSum = 0;
        $payments= DB::select("SELECT c.customerName, p.paymentDate, p.invoice, p.invoiceDate, p.dueAmount, p.discountAmount, p.receivedAmount, (p.dueAmount-p.receivedAmount-p.discountAmount) AS balance FROM payments p LEFT JOIN customers c ON c.id=p.customerId WHERE p.customerId='$id' AND paymentDate BETWEEN '$fDate' AND '$tDate' ORDER BY paymentDate");

        //        $this->fpdf->AddFont('Courier','','courier.php');

        $this->pdf->AddPage();
        $this->pdf->SetFont('Arial', 'B', 25);
        $this->pdf->SetTextColor(0, 0, 255);
        $this->pdf->Cell(190, 15, 'Market Vine Limited', 0, 1, 'C');
        $this->pdf->SetTextColor(0, 0, 0);
        $this->pdf->SetFont('Arial', 'B', 15);
        $this->pdf->Cell(190, 6, 'Payment History', 0, 1, 'C');
        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->Cell(60, 10, 'From: '.date('d-m-Y', strtotime($fDate)). '  To: '.date('d-m-Y', strtotime($tDate)), 0, 0, 'L');
        $this->pdf->Cell(80, 10, 'Customer: '.$payments[0]->customerName, 0, 1, 'L');
        $this->pdf->Cell(10, 6, 'ID', 1, 0, 'C');
        $this->pdf->Cell(25, 6, 'Pay Date', 1, 0, 'C');
        $this->pdf->Cell(25, 6, 'Invoice', 1, 0, 'C');
        $this->pdf->Cell(25, 6, 'Inv Date', 1, 0, 'C');
        $this->pdf->Cell(25, 6, 'Due Amount', 1, 0, 'C');
        $this->pdf->Cell(25, 6, 'Disc Amount', 1, 0, 'C');
        $this->pdf->Cell(28, 6, 'Pay Amount', 1, 0, 'C');
        $this->pdf->Cell(27, 6, 'Balance', 1, 1, 'C');
        $this->pdf->SetFont('Arial', '', 10);

        foreach ($payments as $pay) {
            $sl++;
            $this->pdf->Cell(10, 6, $sl, 1, 0, 'C');
            $this->pdf->Cell(25, 6, date('d-m-Y', strtotime($pay->paymentDate)), 1, 0, 'L');
            $this->pdf->Cell(25, 6, $pay->invoice, 1, 0, 'L');
            $this->pdf->Cell(25, 6, date('d-m-Y', strtotime($pay->invoiceDate)), 1, 0, 'L');
            $this->pdf->Cell(25, 6, "$pay->dueAmount", 1, 0, 'R');
            $this->pdf->Cell(25, 6, "$pay->discountAmount", 1, 0, 'R');
            $this->pdf->Cell(28, 6, "$pay->receivedAmount", 1, 0, 'R');
            $this->pdf->Cell(27, 6, $pay->balance, 1, 1, 'R');
            $receivedSum = $receivedSum + $pay->receivedAmount;
        }
        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->SetTextColor(0, 0, 255);
        $this->pdf->Cell(135, 6, 'Grand Total(Tk) :', 1, 0, 'R');
        $this->pdf->Cell(28, 6, "$receivedSum", 1, 0, 'R');
        $this->pdf->Cell(27, 6, "", 1, 1, 'R');
        $this->pdf->Output();
        exit;
    }
}
