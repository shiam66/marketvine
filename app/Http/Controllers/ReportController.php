<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Payment;
use App\Models\SalesBudget;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function paymentsHistory($id)
    {
        $customerById = Customer::find($id);
        $customers = Customer::where('status', 1)->get();
        $payments = Payment::where('customerId', $id)
            ->orderBy('paymentDate')
            ->get();

        $maxDate = DB::select("SELECT MAX(paymentDate) AS maxDate FROM payments WHERE customerId='$id'");
        $minDate = DB::select("SELECT MIN(paymentDate) AS minDate FROM payments WHERE customerId='$id'");

        return view('frontEnd.reports.paymentHistory', [
            'customers' => $customers,
            'customerById' => $customerById,
            'payments' => $payments,
            'fromDate' => $minDate[0]->minDate,
            'toDate' => $maxDate[0]->maxDate
        ]);
    }

    public function paymentHistoryView(Request $request)
    {
        $customerById = Customer::find($request->customerId);
        $customers = Customer::where('status', 1)->get();
        $payments = Payment::where('customerId', $request->customerId)
            ->whereBetween('paymentDate', [$request->fromDate, $request->toDate])
            ->orderBy('paymentDate')
            ->get();

        return view('frontEnd.reports.paymentHistory', [
            'customers' => $customers,
            'customerById' => $customerById,
            'payments' => $payments,
            'fromDate' => $request->fromDate,
            'toDate' => $request->toDate
        ]);
    }

    public function salesTableAnalysis()
    {
        $salesYears = DB::table('sales_details')
            ->groupBy(DB::raw('YEAR(invoiceDate)'))
            ->orderByDesc(DB::raw('YEAR(invoiceDate)'))
            ->select(DB::raw('YEAR(invoiceDate) as salesyear'))
            ->get();

        $yearId = SalesBudget::Select('budgetYear')->max('budgetYear');
        $lastYearId = $yearId - 1;
        $salesBudget = SalesBudget::where('budgetYear', '=', $yearId)->first();
        $salesAnalysis[] = 0;
        $paymentAnalysis[] = 0;
        for ($month = 1; $month <= 12; $month++) {
            $salesAnalysis[] = DB::table('sales_details')
                ->whereYear('invoiceDate', '=', $yearId)
                ->whereMonth('invoiceDate', '=', $month)
                ->select(DB::raw('sum(amount) as sumAmount'))
                ->get();

            $paymentAnalysis[] = DB::table('payments')
                ->whereYear('paymentDate', '=', $yearId)
                ->whereMonth('paymentDate', '=', $month)
                ->select(DB::raw('sum(receivedAmount) as sumAmount'))
                ->get();
        }

        $lastSalesAnalysis[] = 0;
        for ($month = 1; $month <= 12; $month++) {
            $lastSalesAnalysis[] = DB::table('sales_details')
                ->whereYear('invoiceDate', '=', $lastYearId)
                ->whereMonth('invoiceDate', '=', $month)
                ->select(DB::raw('sum(amount) as sumAmount'))
                ->get();
        }

        return view('frontEnd.reports.salesTableAnalysis', [
            'salesYears' => $salesYears,
            'salesBudget' => $salesBudget,
            'salesAnalysis' => $salesAnalysis,
            'paymentAnalysis' => $paymentAnalysis,
            'lastSalesAnalysis' => $lastSalesAnalysis
        ]);
    }

    public function salesByYear(Request $request)
    {
        $yearId = $request->get('yearId');
        $lastYearId = $yearId - 1;
        $output = "";

        $salesBudget = SalesBudget::where('budgetYear', '=', $yearId)->first();

        $salesAnalysis[] = 0;
        $paymentAnalysis[] = 0;
        for ($month = 1; $month <= 12; $month++) {
            $salesAnalysis[] = DB::table('sales_details')
                ->whereYear('invoiceDate', '=', $yearId)
                ->whereMonth('invoiceDate', '=', $month)
                ->select(DB::raw('sum(amount) as sumAmount'))
                ->get();

            $paymentAnalysis[] = DB::table('payments')
                ->whereYear('paymentDate', '=', $yearId)
                ->whereMonth('paymentDate', '=', $month)
                ->select(DB::raw('sum(receivedAmount) as sumAmount'))
                ->get();
        }

        $lastSalesAnalysis[] = 0;
        for ($month = 1; $month <= 12; $month++) {
            $lastSalesAnalysis[] = DB::table('sales_details')
                ->whereYear('invoiceDate', '=', $lastYearId)
                ->whereMonth('invoiceDate', '=', $month)
                ->select(DB::raw('sum(amount) as sumAmount'))
                ->get();
        }

        $salesAchvJan = $salesAnalysis[1][0]->sumAmount;
        $salesAchvFeb = $salesAnalysis[2][0]->sumAmount;
        $salesAchvMar = $salesAnalysis[3][0]->sumAmount;
        $salesAchvApr = $salesAnalysis[4][0]->sumAmount;
        $salesAchvMay = $salesAnalysis[5][0]->sumAmount;
        $salesAchvJun = $salesAnalysis[6][0]->sumAmount;
        $salesAchvJul = $salesAnalysis[7][0]->sumAmount;
        $salesAchvAug = $salesAnalysis[8][0]->sumAmount;
        $salesAchvSep = $salesAnalysis[9][0]->sumAmount;
        $salesAchvOct = $salesAnalysis[10][0]->sumAmount;
        $salesAchvNov = $salesAnalysis[11][0]->sumAmount;
        $salesAchvDec = $salesAnalysis[12][0]->sumAmount;

        $salesTarJan = $salesBudget->salesJan;
        $salesTarFeb = $salesBudget->salesFeb;
        $salesTarMar = $salesBudget->salesMar;
        $salesTarApr = $salesBudget->salesApr;
        $salesTarMay = $salesBudget->salesMay;
        $salesTarJun = $salesBudget->salesJun;
        $salesTarJul = $salesBudget->salesJul;
        $salesTarAug = $salesBudget->salesAug;
        $salesTarSep = $salesBudget->salesSep;
        $salesTarOct = $salesBudget->salesOct;
        $salesTarNov = $salesBudget->salesNov;
        $salesTarDec = $salesBudget->salesDec;

        $salesAchvPerJan = round($salesAchvJan / $salesTarJan * 100);
        $salesAchvPerFeb = round($salesAchvFeb / $salesTarFeb * 100);
        $salesAchvPerMar = round($salesAchvMar / $salesTarMar * 100);
        $salesAchvPerApr = round($salesAchvApr / $salesTarApr * 100);
        $salesAchvPerMay = round($salesAchvMay / $salesTarMay * 100);
        $salesAchvPerJun = round($salesAchvJun / $salesTarJun * 100);
        $salesAchvPerJul = round($salesAchvJul / $salesTarJul * 100);
        $salesAchvPerAug = round($salesAchvAug / $salesTarAug * 100);
        $salesAchvPerSep = round($salesAchvSep / $salesTarSep * 100);
        $salesAchvPerOct = round($salesAchvOct / $salesTarOct * 100);
        $salesAchvPerNov = round($salesAchvNov / $salesTarNov * 100);
        $salesAchvPerDec = round($salesAchvDec / $salesTarDec * 100);

        $recTarJan = $salesBudget->recJan;
        $recTarFeb = $salesBudget->recFeb;
        $recTarMar = $salesBudget->recMar;
        $recTarApr = $salesBudget->recApr;
        $recTarMay = $salesBudget->recMay;
        $recTarJun = $salesBudget->recJun;
        $recTarJul = $salesBudget->recJul;
        $recTarAug = $salesBudget->recAug;
        $recTarSep = $salesBudget->recSep;
        $recTarOct = $salesBudget->recOct;
        $recTarNov = $salesBudget->recNov;
        $recTarDec = $salesBudget->recDec;

        $paymentJan = $paymentAnalysis[1][0]->sumAmount;
        $paymentFeb = $paymentAnalysis[2][0]->sumAmount;
        $paymentMar = $paymentAnalysis[3][0]->sumAmount;
        $paymentApr = $paymentAnalysis[4][0]->sumAmount;
        $paymentMay = $paymentAnalysis[5][0]->sumAmount;
        $paymentJun = $paymentAnalysis[6][0]->sumAmount;
        $paymentJul = $paymentAnalysis[7][0]->sumAmount;
        $paymentAug = $paymentAnalysis[8][0]->sumAmount;
        $paymentSep = $paymentAnalysis[9][0]->sumAmount;
        $paymentOct = $paymentAnalysis[10][0]->sumAmount;
        $paymentNov = $paymentAnalysis[11][0]->sumAmount;
        $paymentDec = $paymentAnalysis[12][0]->sumAmount;

        $recAchvPerJan = round($paymentJan / $recTarJan * 100);
        $recAchvPerFeb = round($paymentFeb / $recTarFeb * 100);
        $recAchvPerMar = round($paymentMar / $recTarMar * 100);
        $recAchvPerApr = round($paymentApr / $recTarApr * 100);
        $recAchvPerMay = round($paymentMay / $recTarMay * 100);
        $recAchvPerJun = round($paymentJun / $recTarJun * 100);
        $recAchvPerJul = round($paymentJul / $recTarJul * 100);
        $recAchvPerAug = round($paymentAug / $recTarAug * 100);
        $recAchvPerSep = round($paymentSep / $recTarSep * 100);
        $recAchvPerOct = round($paymentOct / $recTarOct * 100);
        $recAchvPerNov = round($paymentNov / $recTarNov * 100);
        $recAchvPerDec = round($paymentDec / $recTarDec * 100);

        $lastSalesAchvJan = $lastSalesAnalysis[1][0]->sumAmount;
        $lastSalesAchvFeb = $lastSalesAnalysis[2][0]->sumAmount;
        $lastSalesAchvMar = $lastSalesAnalysis[3][0]->sumAmount;
        $lastSalesAchvApr = $lastSalesAnalysis[4][0]->sumAmount;
        $lastSalesAchvMay = $lastSalesAnalysis[5][0]->sumAmount;
        $lastSalesAchvJun = $lastSalesAnalysis[6][0]->sumAmount;
        $lastSalesAchvJul = $lastSalesAnalysis[7][0]->sumAmount;
        $lastSalesAchvAug = $lastSalesAnalysis[8][0]->sumAmount;
        $lastSalesAchvSep = $lastSalesAnalysis[9][0]->sumAmount;
        $lastSalesAchvOct = $lastSalesAnalysis[10][0]->sumAmount;
        $lastSalesAchvNov = $lastSalesAnalysis[11][0]->sumAmount;
        $lastSalesAchvDec = $lastSalesAnalysis[12][0]->sumAmount;

        $cumSalesAchvJan = $salesAchvJan;
        $cumSalesAchvFeb = $salesAchvJan + $salesAchvFeb;
        $cumSalesAchvMar = $salesAchvJan + $salesAchvFeb + $salesAchvMar;
        $cumSalesAchvApr = $salesAchvJan + $salesAchvFeb + $salesAchvMar + $salesAchvApr;
        $cumSalesAchvMay = $salesAchvJan + $salesAchvFeb + $salesAchvMar + $salesAchvApr + $salesAchvMay;
        $cumSalesAchvJun = $salesAchvJan + $salesAchvFeb + $salesAchvMar + $salesAchvApr + $salesAchvMay + $salesAchvJun;
        $cumSalesAchvJul = $salesAchvJan + $salesAchvFeb + $salesAchvMar + $salesAchvApr + $salesAchvMay + $salesAchvJun + $salesAchvJul;
        $cumSalesAchvAug = $salesAchvJan + $salesAchvFeb + $salesAchvMar + $salesAchvApr + $salesAchvMay + $salesAchvJun + $salesAchvJul + $salesAchvAug;
        $cumSalesAchvSep = $salesAchvJan + $salesAchvFeb + $salesAchvMar + $salesAchvApr + $salesAchvMay + $salesAchvJun + $salesAchvJul + $salesAchvAug + $salesAchvSep;
        $cumSalesAchvOct = $salesAchvJan + $salesAchvFeb + $salesAchvMar + $salesAchvApr + $salesAchvMay + $salesAchvJun + $salesAchvJul + $salesAchvAug + $salesAchvSep + $salesAchvOct;
        $cumSalesAchvNov = $salesAchvJan + $salesAchvFeb + $salesAchvMar + $salesAchvApr + $salesAchvMay + $salesAchvJun + $salesAchvJul + $salesAchvAug + $salesAchvSep + $salesAchvOct + $salesAchvNov;
        $cumSalesAchvDec = $salesAchvJan + $salesAchvFeb + $salesAchvMar + $salesAchvApr + $salesAchvMay + $salesAchvJun + $salesAchvJul + $salesAchvAug + $salesAchvSep + $salesAchvOct + $salesAchvNov + $salesAchvDec;

        $cumSalesSplyJan = $lastSalesAchvJan;
        $cumSalesSplyFeb = $lastSalesAchvJan + $lastSalesAchvFeb;
        $cumSalesSplyMar = $lastSalesAchvJan + $lastSalesAchvFeb + $lastSalesAchvMar;
        $cumSalesSplyApr = $lastSalesAchvJan + $lastSalesAchvFeb + $lastSalesAchvMar + $lastSalesAchvApr;
        $cumSalesSplyMay = $lastSalesAchvJan + $lastSalesAchvFeb + $lastSalesAchvMar + $lastSalesAchvApr + $lastSalesAchvMay;
        $cumSalesSplyJun = $lastSalesAchvJan + $lastSalesAchvFeb + $lastSalesAchvMar + $lastSalesAchvApr + $lastSalesAchvMay + $lastSalesAchvJun;
        $cumSalesSplyJul = $lastSalesAchvJan + $lastSalesAchvFeb + $lastSalesAchvMar + $lastSalesAchvApr + $lastSalesAchvMay + $lastSalesAchvJun + $lastSalesAchvJul;
        $cumSalesSplyAug = $lastSalesAchvJan + $lastSalesAchvFeb + $lastSalesAchvMar + $lastSalesAchvApr + $lastSalesAchvMay + $lastSalesAchvJun + $lastSalesAchvJul + $lastSalesAchvAug;
        $cumSalesSplySep = $lastSalesAchvJan + $lastSalesAchvFeb + $lastSalesAchvMar + $lastSalesAchvApr + $lastSalesAchvMay + $lastSalesAchvJun + $lastSalesAchvJul + $lastSalesAchvAug + $lastSalesAchvSep;
        $cumSalesSplyOct = $lastSalesAchvJan + $lastSalesAchvFeb + $lastSalesAchvMar + $lastSalesAchvApr + $lastSalesAchvMay + $lastSalesAchvJun + $lastSalesAchvJul + $lastSalesAchvAug + $lastSalesAchvSep + $lastSalesAchvOct;
        $cumSalesSplyNov = $lastSalesAchvJan + $lastSalesAchvFeb + $lastSalesAchvMar + $lastSalesAchvApr + $lastSalesAchvMay + $lastSalesAchvJun + $lastSalesAchvJul + $lastSalesAchvAug + $lastSalesAchvSep + $lastSalesAchvOct + $lastSalesAchvNov;
        $cumSalesSplyDec = $lastSalesAchvJan + $lastSalesAchvFeb + $lastSalesAchvMar + $lastSalesAchvApr + $lastSalesAchvMay + $lastSalesAchvJun + $lastSalesAchvJul + $lastSalesAchvAug + $lastSalesAchvSep + $lastSalesAchvOct + $lastSalesAchvNov + $lastSalesAchvDec;

        $cumSalesTarJan = $salesTarJan;
        $cumSalesTarFeb = $salesTarJan + $salesTarFeb;
        $cumSalesTarMar = $salesTarJan + $salesTarFeb + $salesTarMar;
        $cumSalesTarApr = $salesTarJan + $salesTarFeb + $salesTarMar + $salesTarApr;
        $cumSalesTarMay = $salesTarJan + $salesTarFeb + $salesTarMar + $salesTarApr + $salesTarMay;
        $cumSalesTarJun = $salesTarJan + $salesTarFeb + $salesTarMar + $salesTarApr + $salesTarMay + $salesTarJun;
        $cumSalesTarJul = $salesTarJan + $salesTarFeb + $salesTarMar + $salesTarApr + $salesTarMay + $salesTarJun + $salesTarJul;
        $cumSalesTarAug = $salesTarJan + $salesTarFeb + $salesTarMar + $salesTarApr + $salesTarMay + $salesTarJun + $salesTarJul + $salesTarAug;
        $cumSalesTarSep = $salesTarJan + $salesTarFeb + $salesTarMar + $salesTarApr + $salesTarMay + $salesTarJun + $salesTarJul + $salesTarAug + $salesTarSep;
        $cumSalesTarOct = $salesTarJan + $salesTarFeb + $salesTarMar + $salesTarApr + $salesTarMay + $salesTarJun + $salesTarJul + $salesTarAug + $salesTarSep + $salesTarOct;
        $cumSalesTarNov = $salesTarJan + $salesTarFeb + $salesTarMar + $salesTarApr + $salesTarMay + $salesTarJun + $salesTarJul + $salesTarAug + $salesTarSep + $salesTarOct + $salesTarNov;
        $cumSalesTarDec = $salesTarJan + $salesTarFeb + $salesTarMar + $salesTarApr + $salesTarMay + $salesTarJun + $salesTarJul + $salesTarAug + $salesTarSep + $salesTarOct + $salesTarNov + $salesTarDec;

        $cumSalesSplyPerJan = round(($cumSalesAchvJan - $cumSalesSplyJan) / $cumSalesSplyJan * 100);
        $cumSalesSplyPerFeb = round(($cumSalesAchvFeb - $cumSalesSplyFeb) / $cumSalesSplyFeb * 100);
        $cumSalesSplyPerMar = round(($cumSalesAchvMar - $cumSalesSplyMar) / $cumSalesSplyMar * 100);
        $cumSalesSplyPerApr = round(($cumSalesAchvApr - $cumSalesSplyApr) / $cumSalesSplyApr * 100);
        $cumSalesSplyPerMay = round(($cumSalesAchvMay - $cumSalesSplyMay) / $cumSalesSplyMay * 100);
        $cumSalesSplyPerJun = round(($cumSalesAchvJun - $cumSalesSplyJun) / $cumSalesSplyJun * 100);
        $cumSalesSplyPerJul = round(($cumSalesAchvJul - $cumSalesSplyJul) / $cumSalesSplyJul * 100);
        $cumSalesSplyPerAug = round(($cumSalesAchvAug - $cumSalesSplyAug) / $cumSalesSplyAug * 100);
        $cumSalesSplyPerSep = round(($cumSalesAchvSep - $cumSalesSplySep) / $cumSalesSplySep * 100);
        $cumSalesSplyPerOct = round(($cumSalesAchvOct - $cumSalesSplyOct) / $cumSalesSplyOct * 100);
        $cumSalesSplyPerNov = round(($cumSalesAchvNov - $cumSalesSplyNov) / $cumSalesSplyNov * 100);
        $cumSalesSplyPerDec = round(($cumSalesAchvDec - $cumSalesSplyDec) / $cumSalesSplyDec * 100);

        $cumSalesAchvPerJan = round($salesAchvJan / $salesTarJan * 100);
        $cumSalesAchvPerFeb = round(($salesAchvJan + $salesAchvFeb) / ($salesTarJan + $salesTarFeb) * 100);
        $cumSalesAchvPerMar = round(($salesAchvJan + $salesAchvFeb + $salesAchvMar) / ($salesTarJan + $salesTarFeb + $salesTarMar) * 100);
        $cumSalesAchvPerApr = round(($salesAchvJan + $salesAchvFeb + $salesAchvMar + $salesAchvApr) / ($salesTarJan + $salesTarFeb + $salesTarMar + $salesTarApr) * 100);
        $cumSalesAchvPerMay = round(($salesAchvJan + $salesAchvFeb + $salesAchvMar + $salesAchvApr + $salesAchvMay) / ($salesTarJan + $salesTarFeb + $salesTarMar + $salesTarApr + $salesTarMay) * 100);
        $cumSalesAchvPerJun = round(($salesAchvJan + $salesAchvFeb + $salesAchvMar + $salesAchvApr + $salesAchvMay + $salesAchvJun) / ($salesTarJan + $salesTarFeb + $salesTarMar + $salesTarApr + $salesTarMay + $salesTarJun) * 100);
        $cumSalesAchvPerJul = round(($salesAchvJan + $salesAchvFeb + $salesAchvMar + $salesAchvApr + $salesAchvMay + $salesAchvJun + $salesAchvJul) / ($salesTarJan + $salesTarFeb + $salesTarMar + $salesTarApr + $salesTarMay + $salesTarJun + $salesTarJul) * 100);
        $cumSalesAchvPerAug = round(($salesAchvJan + $salesAchvFeb + $salesAchvMar + $salesAchvApr + $salesAchvMay + $salesAchvJun + $salesAchvJul + $salesAchvAug) / ($salesTarJan + $salesTarFeb + $salesTarMar + $salesTarApr + $salesTarMay + $salesTarJun + $salesTarJul + $salesTarAug) * 100);
        $cumSalesAchvPerSep = round(($salesAchvJan + $salesAchvFeb + $salesAchvMar + $salesAchvApr + $salesAchvMay + $salesAchvJun + $salesAchvJul + $salesAchvAug + $salesAchvSep) / ($salesTarJan + $salesTarFeb + $salesTarMar + $salesTarApr + $salesTarMay + $salesTarJun + $salesTarJul + $salesTarAug + $salesTarSep) * 100);
        $cumSalesAchvPerOct = round(($salesAchvJan + $salesAchvFeb + $salesAchvMar + $salesAchvApr + $salesAchvMay + $salesAchvJun + $salesAchvJul + $salesAchvAug + $salesAchvSep + $salesAchvOct) / ($salesTarJan + $salesTarFeb + $salesTarMar + $salesTarApr + $salesTarMay + $salesTarJun + $salesTarJul + $salesTarAug + $salesTarSep + $salesTarOct) * 100);
        $cumSalesAchvPerNov = round(($salesAchvJan + $salesAchvFeb + $salesAchvMar + $salesAchvApr + $salesAchvMay + $salesAchvJun + $salesAchvJul + $salesAchvAug + $salesAchvSep + $salesAchvOct + $salesAchvNov) / ($salesTarJan + $salesTarFeb + $salesTarMar + $salesTarApr + $salesTarMay + $salesTarJun + $salesTarJul + $salesTarAug + $salesTarSep + $salesTarOct + $salesTarNov) * 100);
        $cumSalesAchvPerDec = round(($salesAchvJan + $salesAchvFeb + $salesAchvMar + $salesAchvApr + $salesAchvMay + $salesAchvJun + $salesAchvJul + $salesAchvAug + $salesAchvSep + $salesAchvOct + $salesAchvNov + $salesAchvDec) / ($salesTarJan + $salesTarFeb + $salesTarMar + $salesTarApr + $salesTarMay + $salesTarJun + $salesTarJul + $salesTarAug + $salesTarSep + $salesTarOct + $salesTarNov + $salesTarDec) * 100);

        $splyPerJan = round(($salesAchvJan - $lastSalesAchvJan) / $lastSalesAchvJan * 100);
        $splyPerFeb = round(($salesAchvFeb - $lastSalesAchvFeb) / $lastSalesAchvFeb * 100);
        $splyPerMar = round(($salesAchvMar - $lastSalesAchvMar) / $lastSalesAchvMar * 100);
        $splyPerApr = round(($salesAchvApr - $lastSalesAchvApr) / $lastSalesAchvApr * 100);
        $splyPerMay = round(($salesAchvMay - $lastSalesAchvMay) / $lastSalesAchvMay * 100);
        $splyPerJun = round(($salesAchvJun - $lastSalesAchvJun) / $lastSalesAchvJun * 100);
        $splyPerJul = round(($salesAchvJul - $lastSalesAchvJul) / $lastSalesAchvJul * 100);
        $splyPerAug = round(($salesAchvAug - $lastSalesAchvAug) / $lastSalesAchvAug * 100);
        $splyPerSep = round(($salesAchvSep - $lastSalesAchvSep) / $lastSalesAchvSep * 100);
        $splyPerOct = round(($salesAchvOct - $lastSalesAchvOct) / $lastSalesAchvOct * 100);
        $splyPerNov = round(($salesAchvNov - $lastSalesAchvNov) / $lastSalesAchvNov * 100);
        $splyPerDec = round(($salesAchvDec - $lastSalesAchvDec) / $lastSalesAchvDec * 100);

        $output .= '
            <tr>
                <td><b>This month sales Tar</b></td>
                <td><span class="sw_text">' . $salesTarJan . '</span></td>
                <td><span class="sw_text">' . $salesTarFeb . '</span></td>
                <td><span class="sw_text">' . $salesTarMar . '</span></td>
                <td><span class="sw_text">' . $salesTarApr . '</span></td>
                <td><span class="sw_text">' . $salesTarMay . '</span></td>
                <td><span class="sw_text">' . $salesTarJun . '</span></td>
                <td><span class="sw_text">' . $salesTarJul . '</span></td>
                <td><span class="sw_text">' . $salesTarAug . '</span></td>
                <td><span class="sw_text">' . $salesTarSep . '</span></td>
                <td><span class="sw_text">' . $salesTarOct . '</span></td>
                <td><span class="sw_text">' . $salesTarNov . '</span></td>
                <td><span class="sw_text">' . $salesTarDec . '</span></td>
            </tr>

            <tr>
                <td><b>This month sales Achv</b></td>
                <td><span class="sw_text">' . $salesAchvJan . '</span></td>
                <td><span class="sw_text">' . $salesAchvFeb . '</span></td>
                <td><span class="sw_text">' . $salesAchvMar . '</span></td>
                <td><span class="sw_text">' . $salesAchvApr . '</span></td>
                <td><span class="sw_text">' . $salesAchvMay . '</span></td>
                <td><span class="sw_text">' . $salesAchvJun . '</span></td>
                <td><span class="sw_text">' . $salesAchvJul . '</span></td>
                <td><span class="sw_text">' . $salesAchvAug . '</span></td>
                <td><span class="sw_text">' . $salesAchvSep . '</span></td>
                <td><span class="sw_text">' . $salesAchvOct . '</span></td>
                <td><span class="sw_text">' . $salesAchvNov . '</span></td>
                <td><span class="sw_text">' . $salesAchvDec . '</span></td>
            </tr>

            <tr>
                <td><b>This month Achv %</b></td>
                <td class="' . $this->setColour($salesAchvPerJan) . ' text-white"><span class="sw_text">' . $salesAchvPerJan . '%</span></td>
                <td class="' . $this->setColour($salesAchvPerFeb) . ' text-white"><span class="sw_text">' . $salesAchvPerFeb . '%</span></td>
                <td class="' . $this->setColour($salesAchvPerMar) . ' text-white"><span class="sw_text">' . $salesAchvPerMar . '%</span></td>
                <td class="' . $this->setColour($salesAchvPerApr) . ' text-white"><span class="sw_text">' . $salesAchvPerApr . '%</span></td>
                <td class="' . $this->setColour($salesAchvPerMay) . ' text-white"><span class="sw_text">' . $salesAchvPerMay . '%</span></td>
                <td class="' . $this->setColour($salesAchvPerJun) . ' text-white"><span class="sw_text">' . $salesAchvPerJun . '%</span></td>
                <td class="' . $this->setColour($salesAchvPerJul) . ' text-white"><span class="sw_text">' . $salesAchvPerJul . '%</span></td>
                <td class="' . $this->setColour($salesAchvPerAug) . ' text-white"><span class="sw_text">' . $salesAchvPerAug . '%</span></td>
                <td class="' . $this->setColour($salesAchvPerSep) . ' text-white"><span class="sw_text">' . $salesAchvPerSep . '%</span></td>
                <td class="' . $this->setColour($salesAchvPerOct) . ' text-white"><span class="sw_text">' . $salesAchvPerOct . '%</span></td>
                <td class="' . $this->setColour($salesAchvPerNov) . ' text-white"><span class="sw_text">' . $salesAchvPerNov . '%</span></td>
                <td class="' . $this->setColour($salesAchvPerDec) . ' text-white"><span class="sw_text">' . $salesAchvPerDec . '%</span></td>
            </tr>

            <tr>
                <td><b>Cum. Sales target</b></td>
                <td><span class="sw_text">' . $cumSalesTarJan . '</span></td>
                <td><span class="sw_text">' . $cumSalesTarFeb . '</span></td>
                <td><span class="sw_text">' . $cumSalesTarMar . '</span></td>
                <td><span class="sw_text">' . $cumSalesTarApr . '</span></td>
                <td><span class="sw_text">' . $cumSalesTarMay . '</span></td>
                <td><span class="sw_text">' . $cumSalesTarJun . '</span></td>
                <td><span class="sw_text">' . $cumSalesTarJul . '</span></td>
                <td><span class="sw_text">' . $cumSalesTarAug . '</span></td>
                <td><span class="sw_text">' . $cumSalesTarSep . '</span></td>
                <td><span class="sw_text">' . $cumSalesTarOct . '</span></td>
                <td><span class="sw_text">' . $cumSalesTarNov . '</span></td>
                <td><span class="sw_text">' . $cumSalesTarDec . '</span></td>
            </tr>

            <tr>
                <td><b>Cum. Sales achv</b></td>
                <td><span class="sw_text">' . $cumSalesAchvJan . '</span></td>
                <td><span class="sw_text">' . $cumSalesAchvFeb . '</span></td>
                <td><span class="sw_text">' . $cumSalesAchvMar . '</span></td>
                <td><span class="sw_text">' . $cumSalesAchvApr . '</span></td>
                <td><span class="sw_text">' . $cumSalesAchvMay . '</span></td>
                <td><span class="sw_text">' . $cumSalesAchvJun . '</span></td>
                <td><span class="sw_text">' . $cumSalesAchvJul . '</span></td>
                <td><span class="sw_text">' . $cumSalesAchvAug . '</span></td>
                <td><span class="sw_text">' . $cumSalesAchvSep . '</span></td>
                <td><span class="sw_text">' . $cumSalesAchvOct . '</span></td>
                <td><span class="sw_text">' . $cumSalesAchvNov . '</span></td>
                <td><span class="sw_text">' . $cumSalesAchvDec . '</span></td>
            </tr>

            <tr>
                <td><b>Cum. Sales achv %</b></td>
                <td class="' . $this->setColour($cumSalesAchvPerJan) . ' text-white"><span class="sw_text">' . $cumSalesAchvPerJan . '%</span></td>
                <td class="' . $this->setColour($cumSalesAchvPerFeb) . ' text-white"><span class="sw_text">' . $cumSalesAchvPerFeb . '%</span></td>
                <td class="' . $this->setColour($cumSalesAchvPerMar) . ' text-white"><span class="sw_text">' . $cumSalesAchvPerMar . '%</span></td>
                <td class="' . $this->setColour($cumSalesAchvPerApr) . ' text-white"><span class="sw_text">' . $cumSalesAchvPerApr . '%</span></td>
                <td class="' . $this->setColour($cumSalesAchvPerMay) . ' text-white"><span class="sw_text">' . $cumSalesAchvPerMay . '%</span></td>
                <td class="' . $this->setColour($cumSalesAchvPerJun) . ' text-white"><span class="sw_text">' . $cumSalesAchvPerJun . '%</span></td>
                <td class="' . $this->setColour($cumSalesAchvPerJul) . ' text-white"><span class="sw_text">' . $cumSalesAchvPerJul . '%</span></td>
                <td class="' . $this->setColour($cumSalesAchvPerAug) . ' text-white"><span class="sw_text">' . $cumSalesAchvPerAug . '%</span></td>
                <td class="' . $this->setColour($cumSalesAchvPerSep) . ' text-white"><span class="sw_text">' . $cumSalesAchvPerSep . '%</span></td>
                <td class="' . $this->setColour($cumSalesAchvPerOct) . ' text-white"><span class="sw_text">' . $cumSalesAchvPerOct . '%</span></td>
                <td class="' . $this->setColour($cumSalesAchvPerNov) . ' text-white"><span class="sw_text">' . $cumSalesAchvPerNov . '%</span></td>
                <td class="' . $this->setColour($cumSalesAchvPerDec) . ' text-white"><span class="sw_text">' . $cumSalesAchvPerDec . '%</span></td>
            </tr>

            <tr>
                <td><b>Sales SPLY</b></td>
                <td><span class="sw_text">' . $lastSalesAchvJan . '</span></td>
                <td><span class="sw_text">' . $lastSalesAchvFeb . '</span></td>
                <td><span class="sw_text">' . $lastSalesAchvMar . '</span></td>
                <td><span class="sw_text">' . $lastSalesAchvApr . '</span></td>
                <td><span class="sw_text">' . $lastSalesAchvMay . '</span></td>
                <td><span class="sw_text">' . $lastSalesAchvJun . '</span></td>
                <td><span class="sw_text">' . $lastSalesAchvJul . '</span></td>
                <td><span class="sw_text">' . $lastSalesAchvAug . '</span></td>
                <td><span class="sw_text">' . $lastSalesAchvSep . '</span></td>
                <td><span class="sw_text">' . $lastSalesAchvOct . '</span></td>
                <td><span class="sw_text">' . $lastSalesAchvNov . '</span></td>
                <td><span class="sw_text">' . $lastSalesAchvDec . '</span></td>
            </tr>

            <tr>
                <td><b>Sales Gr% SPLY</b></td>
                <td class="' . $this->growSetColour($splyPerJan) . ' text-white"><span class="sw_text">' . $splyPerJan . '%</span></td>
                <td class="' . $this->growSetColour($splyPerFeb) . ' text-white"><span class="sw_text">' . $splyPerFeb . '%</span></td>
                <td class="' . $this->growSetColour($splyPerMar) . ' text-white"><span class="sw_text">' . $splyPerMar . '%</span></td>
                <td class="' . $this->growSetColour($splyPerApr) . ' text-white"><span class="sw_text">' . $splyPerApr . '%</span></td>
                <td class="' . $this->growSetColour($splyPerMay) . ' text-white"><span class="sw_text">' . $splyPerMay . '%</span></td>
                <td class="' . $this->growSetColour($splyPerJun) . ' text-white"><span class="sw_text">' . $splyPerJun . '%</span></td>
                <td class="' . $this->growSetColour($splyPerJul) . ' text-white"><span class="sw_text">' . $splyPerJul . '%</span></td>
                <td class="' . $this->growSetColour($splyPerAug) . ' text-white"><span class="sw_text">' . $splyPerAug . '%</span></td>
                <td class="' . $this->growSetColour($splyPerSep) . ' text-white"><span class="sw_text">' . $splyPerSep . '%</span></td>
                <td class="' . $this->growSetColour($splyPerOct) . ' text-white"><span class="sw_text">' . $splyPerOct . '%</span></td>
                <td class="' . $this->growSetColour($splyPerNov) . ' text-white"><span class="sw_text">' . $splyPerNov . '%</span></td>
                <td class="' . $this->growSetColour($splyPerDec) . ' text-white"><span class="sw_text">' . $splyPerDec . '%</span></td>
            </tr>

            <tr>
                <td><b>Cum. Sales SPLY</b></td>
                <td><span class="sw_text">' . $cumSalesSplyJan . '</span></td>
                <td><span class="sw_text">' . $cumSalesSplyFeb . '</span></td>
                <td><span class="sw_text">' . $cumSalesSplyMar . '</span></td>
                <td><span class="sw_text">' . $cumSalesSplyApr . '</span></td>
                <td><span class="sw_text">' . $cumSalesSplyMay . '</span></td>
                <td><span class="sw_text">' . $cumSalesSplyJun . '</span></td>
                <td><span class="sw_text">' . $cumSalesSplyJul . '</span></td>
                <td><span class="sw_text">' . $cumSalesSplyAug . '</span></td>
                <td><span class="sw_text">' . $cumSalesSplySep . '</span></td>
                <td><span class="sw_text">' . $cumSalesSplyOct . '</span></td>
                <td><span class="sw_text">' . $cumSalesSplyNov . '</span></td>
                <td><span class="sw_text">' . $cumSalesSplyDec . '</span></td>
            </tr>

            <tr>
                <td><b>Cum. Sales SPLY Grw.%</b></td>
                <td class="' . $this->growSetColour($cumSalesSplyPerJan) . ' text-white"><span class="sw_text">' . $cumSalesSplyPerJan . '%</span></td>
                <td class="' . $this->growSetColour($cumSalesSplyPerFeb) . ' text-white"><span class="sw_text">' . $cumSalesSplyPerFeb . '%</span></td>
                <td class="' . $this->growSetColour($cumSalesSplyPerMar) . ' text-white"><span class="sw_text">' . $cumSalesSplyPerMar . '%</span></td>
                <td class="' . $this->growSetColour($cumSalesSplyPerApr) . ' text-white"><span class="sw_text">' . $cumSalesSplyPerApr . '%</span></td>
                <td class="' . $this->growSetColour($cumSalesSplyPerMay) . ' text-white"><span class="sw_text">' . $cumSalesSplyPerMay . '%</span></td>
                <td class="' . $this->growSetColour($cumSalesSplyPerJun) . ' text-white"><span class="sw_text">' . $cumSalesSplyPerJun . '%</span></td>
                <td class="' . $this->growSetColour($cumSalesSplyPerJul) . ' text-white"><span class="sw_text">' . $cumSalesSplyPerJul . '%</span></td>
                <td class="' . $this->growSetColour($cumSalesSplyPerAug) . ' text-white"><span class="sw_text">' . $cumSalesSplyPerAug . '%</span></td>
                <td class="' . $this->growSetColour($cumSalesSplyPerSep) . ' text-white"><span class="sw_text">' . $cumSalesSplyPerSep . '%</span></td>
                <td class="' . $this->growSetColour($cumSalesSplyPerOct) . ' text-white"><span class="sw_text">' . $cumSalesSplyPerOct . '%</span></td>
                <td class="' . $this->growSetColour($cumSalesSplyPerNov) . ' text-white"><span class="sw_text">' . $cumSalesSplyPerNov . '%</span></td>
                <td class="' . $this->growSetColour($cumSalesSplyPerDec) . ' text-white"><span class="sw_text">' . $cumSalesSplyPerDec . '%</span></td>
            </tr>

            <tr>
                <td><b>Recov Target</b></td>
                <td><span class="sw_text">' . $recTarJan . '</span></td>
                <td><span class="sw_text">' . $recTarFeb . '</span></td>
                <td><span class="sw_text">' . $recTarMar . '</span></td>
                <td><span class="sw_text">' . $recTarApr . '</span></td>
                <td><span class="sw_text">' . $recTarMay . '</span></td>
                <td><span class="sw_text">' . $recTarJun . '</span></td>
                <td><span class="sw_text">' . $recTarJul . '</span></td>
                <td><span class="sw_text">' . $recTarAug . '</span></td>
                <td><span class="sw_text">' . $recTarSep . '</span></td>
                <td><span class="sw_text">' . $recTarOct . '</span></td>
                <td><span class="sw_text">' . $recTarNov . '</span></td>
                <td><span class="sw_text">' . $recTarDec . '</span></td>
            </tr>

            <tr>
                <td><b>Recov This Month</b></td>
                <td><span class="sw_text">' . $paymentJan . '</span></td>
                <td><span class="sw_text">' . $paymentFeb . '</span></td>
                <td><span class="sw_text">' . $paymentMar . '</span></td>
                <td><span class="sw_text">' . $paymentApr . '</span></td>
                <td><span class="sw_text">' . $paymentMay . '</span></td>
                <td><span class="sw_text">' . $paymentJun . '</span></td>
                <td><span class="sw_text">' . $paymentJul . '</span></td>
                <td><span class="sw_text">' . $paymentAug . '</span></td>
                <td><span class="sw_text">' . $paymentSep . '</span></td>
                <td><span class="sw_text">' . $paymentOct . '</span></td>
                <td><span class="sw_text">' . $paymentNov . '</span></td>
                <td><span class="sw_text">' . $paymentDec . '</span></td>
            </tr>

            <tr>
                <td><b>Recovery Acv%</b></td>
                <td class="' . $this->setColour($recAchvPerJan) . ' text-white"><span class="sw_text">' . $recAchvPerJan . '%</span></td>
                <td class="' . $this->setColour($recAchvPerFeb) . ' text-white"><span class="sw_text">' . $recAchvPerFeb . '%</span></td>
                <td class="' . $this->setColour($recAchvPerMar) . ' text-white"><span class="sw_text">' . $recAchvPerMar . '%</span></td>
                <td class="' . $this->setColour($recAchvPerApr) . ' text-white"><span class="sw_text">' . $recAchvPerApr . '%</span></td>
                <td class="' . $this->setColour($recAchvPerMay) . ' text-white"><span class="sw_text">' . $recAchvPerMay . '%</span></td>
                <td class="' . $this->setColour($recAchvPerJun) . ' text-white"><span class="sw_text">' . $recAchvPerJun . '%</span></td>
                <td class="' . $this->setColour($recAchvPerJul) . ' text-white"><span class="sw_text">' . $recAchvPerJul . '%</span></td>
                <td class="' . $this->setColour($recAchvPerAug) . ' text-white"><span class="sw_text">' . $recAchvPerAug . '%</span></td>
                <td class="' . $this->setColour($recAchvPerSep) . ' text-white"><span class="sw_text">' . $recAchvPerSep . '%</span></td>
                <td class="' . $this->setColour($recAchvPerOct) . ' text-white"><span class="sw_text">' . $recAchvPerOct . '%</span></td>
                <td class="' . $this->setColour($recAchvPerNov) . ' text-white"><span class="sw_text">' . $recAchvPerNov . '%</span></td>
                <td class="' . $this->setColour($recAchvPerDec) . ' text-white"><span class="sw_text">' . $recAchvPerDec . '%</span></td>
            </tr>
        ';
        echo $output;
    }

    public function setColour($value)
    {
        if ($value >= 90) {
            return "bg-success";
        } elseif ($value >= 80) {
            return "bg-warning";
        } elseif ($value >= 70) {
            return "bg-primary";
        } else {
            return "bg-danger";
        }
    }

    public function growSetColour($value)
    {
        if ($value >= 15) {
            return "bg-success";
        } elseif ($value >= 10) {
            return "bg-warning";
        } elseif ($value >= 0) {
            return "bg-primary";
        } else {
            return "bg-danger";
        }
    }

    public function productCusWSale()
    {
        $salesYears = DB::table('sales_details')
            ->groupBy(DB::raw('YEAR(invoiceDate)'))
            ->orderByDesc(DB::raw('YEAR(invoiceDate)'))
            ->select(DB::raw('YEAR(invoiceDate) as salesYear'))
            ->get();

        $product = DB::select("SELECT p.id,p.productName FROM sales_details s LEFT JOIN products p ON p.id=s.itemId GROUP BY p.id");

        return view('frontEnd.reports.productCusWSale', [
            'salesYears' => $salesYears,
            'product' => $product
        ]);
    }

    public function productByCustomer(Request $request)
    {
        $productId = $request->get('productId');
        $sYear = $request->get('sYear');
        $sumProQty = 0;
        $sumMonth[] = 0;
        $header = "";
        $footer = "";

        $customers = DB::select("SELECT c.id, c.customerName, SUM(qty) as sumProQty, p.sellingUnit FROM sales_details s LEFT JOIN customers c ON c.id=s.customerId LEFT JOIN products p ON p.id=s.itemId WHERE itemId='$productId' AND YEAR(invoiceDate)='$sYear' GROUP BY c.id, c.customerName, p.sellingUnit");

        if ($customers != null) {
            foreach ($customers as $customer) {
                $customerName = $customer->customerName;
                $sumProQty = $sumProQty + $customer->sumProQty;

                $header .= '
                <tr>
                    <td><b>' . $customerName . '</b></td>
            ';
                for ($month = 1; $month <= 12; $month++) {
                    $sales = DB::select("SELECT SUM(qty) AS sumQty FROM sales_details WHERE customerId='$customer->id' AND itemId='$productId' AND YEAR(invoiceDate)='$sYear' AND MONTH(invoiceDate)='$month'");
                    $header .= '
                    <td style="text-align: center;"><span class="sw_text">' . $sales[0]->sumQty . '</span></td>
                ';
                }
                $header .= '
                    <td style="text-align: center;"><span class="sw_text">' . $customer->sumProQty . '</span></td>
                </tr>
            ';
            }

            for ($month = 1; $month <= 12; $month++) {
                $sumMonth[] = DB::select("SELECT SUM(qty) AS sumQty FROM sales_details WHERE itemId='$productId' AND YEAR(invoiceDate)='$sYear' AND MONTH(invoiceDate)='$month'");
            }
            $footer = '
            <tr>
                <th class="text-right"><b>Total (' . $customers[0]->sellingUnit . '):</b></th>
                <th style="text-align: center;"><span class="sw_text">' . $sumMonth[1][0]->sumQty . '</span></th>
                <th style="text-align: center;"><span class="sw_text">' . $sumMonth[2][0]->sumQty . '</span></th>
                <th style="text-align: center;"><span class="sw_text">' . $sumMonth[3][0]->sumQty . '</span></th>
                <th style="text-align: center;"><span class="sw_text">' . $sumMonth[4][0]->sumQty . '</span></th>
                <th style="text-align: center;"><span class="sw_text">' . $sumMonth[5][0]->sumQty . '</span></th>
                <th style="text-align: center;"><span class="sw_text">' . $sumMonth[6][0]->sumQty . '</span></th>
                <th style="text-align: center;"><span class="sw_text">' . $sumMonth[7][0]->sumQty . '</span></th>
                <th style="text-align: center;"><span class="sw_text">' . $sumMonth[8][0]->sumQty . '</span></th>
                <th style="text-align: center;"><span class="sw_text">' . $sumMonth[9][0]->sumQty . '</span></th>
                <th style="text-align: center;"><span class="sw_text">' . $sumMonth[10][0]->sumQty . '</span></th>
                <th style="text-align: center;"><span class="sw_text">' . $sumMonth[11][0]->sumQty . '</span></th>
                <th style="text-align: center;"><span class="sw_text">' . $sumMonth[12][0]->sumQty . '</span></th>
                <th style="text-align: center;"><span class="sw_text">' . $sumProQty . '</span></th>
            </tr>
        ';
        }
        $output['head'] = $header;
        $output['footer'] = $footer;
        return $output;
    }

    public function ageingSummery()
    {
        $to = Carbon::parse(date('Y-m-d', strtotime(now(date_default_timezone_get()))));
        $dues = array();
        $sumTotal = null;
        $sum30 = null;
        $sum60 = null;
        $sum90 = null;
        $sum120 = null;
        $sum121 = null;
        $customerId=null;
        $customers = DB::select("SELECT c.id, c.customerName, SUM(balanceDue) AS sumDues FROM sales s LEFT JOIN customers c ON c.id=s.customerId WHERE s.paymentStatus='0' GROUP BY s.customerId");
        if ($customers != null) {
            foreach ($customers as $customer) {
                $customerId = $customer->id;
                $customerName = $customer->customerName;
                $sumDues = $customer->sumDues;
                $sumTotal = $sumTotal + $sumDues;
                $value30 = null;
                $value60 = null;
                $value90 = null;
                $value120 = null;
                $value121 = null;
                $salesDue = DB::select("SELECT invoiceDate, balanceDue FROM sales WHERE customerId='$customer->id' AND paymentStatus='0'");
                foreach ($salesDue as $due) {
                    $from = Carbon::parse($due->invoiceDate);
                    $days = $to->diffInDays($from);
                    if ($days <= 30) {
                        $value30 = $value30 + $due->balanceDue;
                        $sum30 = $sum30 + $due->balanceDue;
                    } elseif ($days <= 60) {
                        $value60 = $value60 + $due->balanceDue;
                        $sum60 = $sum60 + $due->balanceDue;
                    } elseif ($days <= 90) {
                        $value90 = $value90 + $due->balanceDue;
                        $sum90 = $sum90 + $due->balanceDue;
                    } elseif ($days <= 120) {
                        $value120 = $value120 + $due->balanceDue;
                        $sum120 = $sum120 + $due->balanceDue;
                    } elseif ($days > 120) {
                        $value121 = $value121 + $due->balanceDue;
                        $sum121 = $sum121 + $due->balanceDue;
                    }
                }
                $dues[] = array(
                    $customerName,
                    $sumDues,
                    $value30,
                    $value60,
                    $value90,
                    $value120,
                    $value121,
                    $customerId
                );
            }
        }
        return view('frontEnd.reports.ageingSummery', [
            'dues' => $dues,
            'sumTotal' => $sumTotal,
            'sum30' => $sum30,
            'sum60' => $sum60,
            'sum90' => $sum90,
            'sum120' => $sum120,
            'sum121' => $sum121
        ]);
    }

    public function ageingDetails($id)
    {
        $customers = Customer::all();
        $salesDue = DB::select("SELECT customerId, invoice, invoiceDate, balanceDue FROM sales WHERE customerId='$id' AND paymentStatus='0'");

        return view('frontEnd.reports.ageingDetails', [
            'customers' => $customers,
            'salesDue'=>$salesDue
        ]);
    }

    public function ageingDetail(Request $request)
    {
        $customerId = $request->get('customerId');
        $to = Carbon::parse($request->get('invDate'));
        $sumTotalDues = null;
        $sumTotal30 = null;
        $sumTotal60 = null;
        $sumTotal90 = null;
        $sumTotal120 = null;
        $sumTotal121 = null;
        $header = "";
        $footer = "";

        $salesDue = DB::select("SELECT invoice, invoiceDate, balanceDue FROM sales WHERE customerId='$customerId' AND paymentStatus='0'");
        if ($salesDue != null) {
            foreach ($salesDue as $due) {
                $sumTotalDues = $sumTotalDues + $due->balanceDue;
                $from = Carbon::parse($due->invoiceDate);
                $days = $to->diffInDays($from);
                $header .= '
                    <tr>
                        <td>' . $due->invoice . '</td>
                        <td>' . $due->invoiceDate . '</td>
                        <td class="text-right"><span class="sw_text">' . $due->balanceDue . '</span></td>
                ';
                if ($days <= 30) {
                    $header .= '<td class="text-right"><span class="sw_text">' . $due->balanceDue . '</span></td>';
                    $sumTotal30 = $sumTotal30 + $due->balanceDue;
                } else {
                    $header .= '<td class="text-right"><span class="sw_text"></span></td>';
                }
                if ($days > 30 and $days <= 60) {
                    $header .= '<td class="text-right"><span class="sw_text">' . $due->balanceDue . '</span></td>';
                    $sumTotal60 = $sumTotal60 + $due->balanceDue;
                } else {
                    $header .= '<td class="text-right"><span class="sw_text"></span></td>';
                }
                if ($days > 60 and $days <= 90) {
                    $header .= '<td class="text-right"><span class="sw_text">' . $due->balanceDue . '</span></td>';
                    $sumTotal90 = $sumTotal90 + $due->balanceDue;
                } else {
                    $header .= '<td class="text-right"><span class="sw_text"></span></td>';
                }
                if ($days > 90 and $days <= 120) {
                    $header .= '<td class="text-right"><span class="sw_text">' . $due->balanceDue . '</span></td>';
                    $sumTotal120 = $sumTotal120 + $due->balanceDue;
                } else {
                    $header .= '<td class="text-right"><span class="sw_text"></span></td>';
                }
                if ($days > 120) {
                    $header .= '<td class="text-right"><span class="sw_text">' . $due->balanceDue . '</span></td>';
                    $sumTotal121 = $sumTotal121 + $due->balanceDue;
                } else {
                    $header .= '<td class="text-right"><span class="sw_text"></span></td>';
                }
                $header .= '
                    </tr>
                ';
            }
            $footer .= '
                <tr>
                    <th class="text-right" colspan="2">Total :</th>
                    <th class="text-right"><span class="sw_text">' . $sumTotalDues . '</span></th>
                    <th class="text-right"><span class="sw_text">' . $sumTotal30 . '</span></th>
                    <th class="text-right"><span class="sw_text">' . $sumTotal60 . '</span></th>
                    <th class="text-right"><span class="sw_text">' . $sumTotal90 . '</span></th>
                    <th class="text-right"><span class="sw_text">' . $sumTotal120 . '</span></th>
                    <th class="text-right"><span class="sw_text">' . $sumTotal121 . '</span></th>
                </tr>
                <tr>
                    <th class="text-right" colspan="2">Ageing Percent</th>
                    <th class="text-right"><span class="sw_text"></span></th>
                    <th class="text-right"><span class="sw_text">' . round($sumTotal30 / $sumTotalDues * 100) . '%</span></th>
                    <th class="text-right"><span class="sw_text">' . round($sumTotal60 / $sumTotalDues * 100) . '%</span></th>
                    <th class="text-right"><span class="sw_text">' . round($sumTotal90 / $sumTotalDues * 100) . '%</span></th>
                    <th class="text-right"><span class="sw_text">' . round($sumTotal120 / $sumTotalDues * 100) . '%</span></th>
                    <th class="text-right"><span class="sw_text">' . round($sumTotal121 / $sumTotalDues * 100) . '%</span></th>
                </tr>
            ';
        }
        $output['header'] = $header;
        $output['footer'] = $footer;
        return $output;
    }
}
