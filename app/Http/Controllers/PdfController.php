<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;


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
        $payments = Payment::where('customerId', $id)
            ->whereBetween('paymentDate', [$fDate, $tDate])
            ->orderBy('paymentDate')
            ->get();

        //        $this->fpdf->AddFont('Courier','','courier.php');

        $this->pdf->AddPage();
        $this->pdf->SetFont('Arial', 'B', 25);
        $this->pdf->SetTextColor(0, 0, 255);
        $this->pdf->Cell(190, 25, 'Market Vine Limited', 0, 1, 'C');

        $this->pdf->SetTextColor(0, 0, 0);
        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->Cell(10, 6, 'SL', 1, 0, 'C');
        $this->pdf->Cell(30, 6, 'Invoice', 1, 0, 'C');
        $this->pdf->Cell(35, 6, 'Invoice Date', 1, 0, 'C');
        $this->pdf->Cell(35, 6, 'Payment Date', 1, 0, 'C');
        $this->pdf->Cell(40, 6, 'Discount Amount', 1, 0, 'C');
        $this->pdf->Cell(40, 6, 'Payment Amount', 1, 1, 'C');
        $this->pdf->SetFont('Arial', '', 10);

        foreach ($payments as $pay) {
            $sl++;
            $this->pdf->Cell(10, 6, $sl, 1, 0, 'C');
            $this->pdf->Cell(30, 6, $pay->invoice, 1, 0, 'L');
            $this->pdf->Cell(35, 6, date('d-m-Y', strtotime($pay->invoiceDate)), 1, 0, 'L');
            $this->pdf->Cell(35, 6, date('d-m-Y', strtotime($pay->paymentDate)), 1, 0, 'L');
            $this->pdf->Cell(40, 6, "$pay->discountAmount", 1, 0, 'R');
            $this->pdf->Cell(40, 6, "$pay->receivedAmount/-", 1, 1, 'R');
            $receivedSum = $receivedSum + $pay->receivedAmount;
        }
        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->SetTextColor(0, 0, 255);
        $this->pdf->Cell(150, 6, '', 1, 0, 'C');
        $this->pdf->Cell(40, 6, "$receivedSum/-", 1, 1, 'R');
        $this->pdf->Output();
        exit;
    }
}
