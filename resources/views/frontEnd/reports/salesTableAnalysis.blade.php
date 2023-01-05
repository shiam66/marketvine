@extends('frontEnd.master')

@section('title') Sales Table Analysis @endsection

<style>
    .form-control-sm {
        padding: 0px !important;
    }
    .table-sm td, .table-sm th {
        padding: 2px !important;
    }
    .table td, .table th {
        vertical-align: middle !important;
    }
    .table td .sw_text{
        text-align: right !important;
        display: block;
    }
    .table-sm .sw_text{
        font-size: 12px;
    }

</style>

@php
    function setColour($value)
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

    function growSetColour($value)
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
@endphp

@section('mainContent')

    <?php
        $active ='sales_analysis';
        $mainActive ='reports';
    ?>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h4 mb-0 text-gray-800">Sales Table Analysis</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form name="frmcontent" action="{{ url('/sales-table-analysis') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-sm-4 offset-sm-4">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Sales Year</label>
                                <div class="col-sm-8">
                                    <div class="col-sm-8">
                                        <select class="form-control" id="sYear" name="sYear">
                                            @foreach($salesYears as $salesYear)
                                                <option value="{{ $salesYear->salesyear }}">{{ $salesYear->salesyear }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @php
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
                        @endphp

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <table class="table table-sm table-bordered table-striped">
                                    <thead class="bg-info text-white">
                                    <tr>
                                        <th style="width: 190px;">Sales</th>
                                        <th style="text-align: center;">Jan</th>
                                        <th style="text-align: center;">Feb</th>
                                        <th style="text-align: center;">Mar</th>
                                        <th style="text-align: center;">Apr</th>
                                        <th style="text-align: center;">May</th>
                                        <th style="text-align: center;">Jun</th>
                                        <th style="text-align: center;">Jul</th>
                                        <th style="text-align: center;">Aug</th>
                                        <th style="text-align: center;">Sep</th>
                                        <th style="text-align: center;">Oct</th>
                                        <th style="text-align: center;">Nov</th>
                                        <th style="text-align: center;">Dec</th>
                                    </tr>
                                    </thead>

                                    <tbody id="tableData">
                                    <tr>
                                        <td><b>This month sales Tar</b></td>
                                        <td><span class="sw_text">{{ number_format($salesTarJan) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($salesTarFeb) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($salesTarMar) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($salesTarApr) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($salesTarMay) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($salesTarJun) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($salesTarJul) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($salesTarAug) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($salesTarSep) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($salesTarOct) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($salesTarNov) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($salesTarDec) }}</span></td>
                                    </tr>

                                    <tr>
                                        <td><b>This month sales Achv</b></td>
                                        <td><span class="sw_text">{{ number_format($salesAchvJan) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($salesAchvFeb) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($salesAchvMar) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($salesAchvApr) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($salesAchvMay) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($salesAchvJun) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($salesAchvJul) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($salesAchvAug) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($salesAchvSep) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($salesAchvOct) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($salesAchvNov) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($salesAchvDec) }}</span></td>
                                    </tr>

                                    <tr>
                                        <td><b>This moth Achv %</b></td>
                                        <td class="{{ setColour($salesAchvPerJan) }} text-white"><span class="sw_text">{{ $salesAchvPerJan }}%</span></td>
                                        <td class="{{ setColour($salesAchvPerFeb) }} text-white"><span class="sw_text">{{ $salesAchvPerFeb }}%</span></td>
                                        <td class="{{ setColour($salesAchvPerMar) }} text-white"><span class="sw_text">{{ $salesAchvPerMar }}%</span></td>
                                        <td class="{{ setColour($salesAchvPerApr) }} text-white"><span class="sw_text">{{ $salesAchvPerApr }}%</span></td>
                                        <td class="{{ setColour($salesAchvPerMay) }} text-white"><span class="sw_text">{{ $salesAchvPerMay }}%</span></td>
                                        <td class="{{ setColour($salesAchvPerJun) }} text-white"><span class="sw_text">{{ $salesAchvPerJun }}%</span></td>
                                        <td class="{{ setColour($salesAchvPerJul) }} text-white"><span class="sw_text">{{ $salesAchvPerJul }}%</span></td>
                                        <td class="{{ setColour($salesAchvPerAug) }} text-white"><span class="sw_text">{{ $salesAchvPerAug }}%</span></td>
                                        <td class="{{ setColour($salesAchvPerSep) }} text-white"><span class="sw_text">{{ $salesAchvPerSep }}%</span></td>
                                        <td class="{{ setColour($salesAchvPerOct) }} text-white"><span class="sw_text">{{ $salesAchvPerOct }}%</span></td>
                                        <td class="{{ setColour($salesAchvPerNov) }} text-white"><span class="sw_text">{{ $salesAchvPerNov }}%</span></td>
                                        <td class="{{ setColour($salesAchvPerDec) }} text-white"><span class="sw_text">{{ $salesAchvPerDec }}%</span></td>
                                    </tr>

                                    <tr>
                                        <td><b>Cum. Sales target</b></td>
                                        <td><span class="sw_text">{{ number_format($cumSalesTarJan) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($cumSalesTarFeb) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($cumSalesTarMar) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($cumSalesTarApr) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($cumSalesTarMay) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($cumSalesTarJun) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($cumSalesTarJul) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($cumSalesTarAug) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($cumSalesTarSep) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($cumSalesTarOct) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($cumSalesTarNov) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($cumSalesTarDec) }}</span></td>
                                    </tr>

                                    <tr>
                                        <td><b>Cum. Sales achv</b></td>
                                        <td><span class="sw_text">{{ number_format($cumSalesAchvJan) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($cumSalesAchvFeb) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($cumSalesAchvMar) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($cumSalesAchvApr) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($cumSalesAchvMay) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($cumSalesAchvJun) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($cumSalesAchvJul) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($cumSalesAchvAug) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($cumSalesAchvSep) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($cumSalesAchvOct) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($cumSalesAchvNov) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($cumSalesAchvDec) }}</span></td>
                                    </tr>

                                    <tr>
                                        <td><b>Cum. Sales achv %</b></td>
                                        <td class="{{ setColour($cumSalesAchvPerJan) }} text-white"><span class="sw_text">{{ $cumSalesAchvPerJan }}%</span></td>
                                        <td class="{{ setColour($cumSalesAchvPerFeb) }} text-white"><span class="sw_text">{{ $cumSalesAchvPerFeb }}%</span></td>
                                        <td class="{{ setColour($cumSalesAchvPerMar) }} text-white"><span class="sw_text">{{ $cumSalesAchvPerMar }}%</span></td>
                                        <td class="{{ setColour($cumSalesAchvPerApr) }} text-white"><span class="sw_text">{{ $cumSalesAchvPerApr }}%</span></td>
                                        <td class="{{ setColour($cumSalesAchvPerMay) }} text-white"><span class="sw_text">{{ $cumSalesAchvPerMay }}%</span></td>
                                        <td class="{{ setColour($cumSalesAchvPerJun) }} text-white"><span class="sw_text">{{ $cumSalesAchvPerJun }}%</span></td>
                                        <td class="{{ setColour($cumSalesAchvPerJul) }} text-white"><span class="sw_text">{{ $cumSalesAchvPerJul }}%</span></td>
                                        <td class="{{ setColour($cumSalesAchvPerAug) }} text-white"><span class="sw_text">{{ $cumSalesAchvPerAug }}%</span></td>
                                        <td class="{{ setColour($cumSalesAchvPerSep) }} text-white"><span class="sw_text">{{ $cumSalesAchvPerSep }}%</span></td>
                                        <td class="{{ setColour($cumSalesAchvPerOct) }} text-white"><span class="sw_text">{{ $cumSalesAchvPerOct }}%</span></td>
                                        <td class="{{ setColour($cumSalesAchvPerNov) }} text-white"><span class="sw_text">{{ $cumSalesAchvPerNov }}%</span></td>
                                        <td class="{{ setColour($cumSalesAchvPerDec) }} text-white"><span class="sw_text">{{ $cumSalesAchvPerDec }}%</span></td>
                                    </tr>

                                    <tr>
                                        <td><b>Sales SPLY</b></td>
                                        <td><span class="sw_text">{{ number_format($lastSalesAchvJan) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($lastSalesAchvFeb) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($lastSalesAchvMar) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($lastSalesAchvApr) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($lastSalesAchvMay) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($lastSalesAchvJun) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($lastSalesAchvJul) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($lastSalesAchvAug) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($lastSalesAchvSep) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($lastSalesAchvOct) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($lastSalesAchvNov) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($lastSalesAchvDec) }}</span></td>
                                    </tr>

                                    <tr>
                                        <td><b>Sales Gr% SPLY</b></td>
                                        <td class="{{ growSetColour($splyPerJan) }} text-white"><span class="sw_text">{{ $splyPerJan }}%</span></td>
                                        <td class="{{ growSetColour($splyPerFeb) }} text-white"><span class="sw_text">{{ $splyPerFeb }}%</span></td>
                                        <td class="{{ growSetColour($splyPerMar) }} text-white"><span class="sw_text">{{ $splyPerMar }}%</span></td>
                                        <td class="{{ growSetColour($splyPerApr) }} text-white"><span class="sw_text">{{ $splyPerApr }}%</span></td>
                                        <td class="{{ growSetColour($splyPerMay) }} text-white"><span class="sw_text">{{ $splyPerMay }}%</span></td>
                                        <td class="{{ growSetColour($splyPerJun) }} text-white"><span class="sw_text">{{ $splyPerJun }}%</span></td>
                                        <td class="{{ growSetColour($splyPerJul) }} text-white"><span class="sw_text">{{ $splyPerJul }}%</span></td>
                                        <td class="{{ growSetColour($splyPerAug) }} text-white"><span class="sw_text">{{ $splyPerAug }}%</span></td>
                                        <td class="{{ growSetColour($splyPerSep) }} text-white"><span class="sw_text">{{ $splyPerSep }}%</span></td>
                                        <td class="{{ growSetColour($splyPerOct) }} text-white"><span class="sw_text">{{ $splyPerOct }}%</span></td>
                                        <td class="{{ growSetColour($splyPerNov) }} text-white"><span class="sw_text">{{ $splyPerNov }}%</span></td>
                                        <td class="{{ growSetColour($splyPerDec) }} text-white"><span class="sw_text">{{ $splyPerDec }}%</span></td>
                                    </tr>

                                    <tr>
                                        <td><b>Cum. Sales SPLY</b></td>
                                        <td><span class="sw_text">{{ number_format($cumSalesSplyJan) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($cumSalesSplyFeb) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($cumSalesSplyMar) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($cumSalesSplyApr) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($cumSalesSplyMay) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($cumSalesSplyJun) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($cumSalesSplyJul) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($cumSalesSplyAug) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($cumSalesSplySep) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($cumSalesSplyOct) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($cumSalesSplyNov) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($cumSalesSplyDec) }}</span></td>
                                    </tr>

                                    <tr>
                                        <td><b>Cum. Sales SPLY Grw.%</b></td>
                                        <td class="{{ growSetColour($cumSalesSplyPerJan) }} text-white"><span class="sw_text">{{ $cumSalesSplyPerJan }}%</span></td>
                                        <td class="{{ growSetColour($cumSalesSplyPerFeb) }} text-white"><span class="sw_text">{{ $cumSalesSplyPerFeb }}%</span></td>
                                        <td class="{{ growSetColour($cumSalesSplyPerMar) }} text-white"><span class="sw_text">{{ $cumSalesSplyPerMar }}%</span></td>
                                        <td class="{{ growSetColour($cumSalesSplyPerApr) }} text-white"><span class="sw_text">{{ $cumSalesSplyPerApr }}%</span></td>
                                        <td class="{{ growSetColour($cumSalesSplyPerMay) }} text-white"><span class="sw_text">{{ $cumSalesSplyPerMay }}%</span></td>
                                        <td class="{{ growSetColour($cumSalesSplyPerJun) }} text-white"><span class="sw_text">{{ $cumSalesSplyPerJun }}%</span></td>
                                        <td class="{{ growSetColour($cumSalesSplyPerJul) }} text-white"><span class="sw_text">{{ $cumSalesSplyPerJul }}%</span></td>
                                        <td class="{{ growSetColour($cumSalesSplyPerAug) }} text-white"><span class="sw_text">{{ $cumSalesSplyPerAug }}%</span></td>
                                        <td class="{{ growSetColour($cumSalesSplyPerSep) }} text-white"><span class="sw_text">{{ $cumSalesSplyPerSep }}%</span></td>
                                        <td class="{{ growSetColour($cumSalesSplyPerOct) }} text-white"><span class="sw_text">{{ $cumSalesSplyPerOct }}%</span></td>
                                        <td class="{{ growSetColour($cumSalesSplyPerNov) }} text-white"><span class="sw_text">{{ $cumSalesSplyPerNov }}%</span></td>
                                        <td class="{{ growSetColour($cumSalesSplyPerDec) }} text-white"><span class="sw_text">{{ $cumSalesSplyPerDec }}%</span></td>
                                    </tr>

                                    <tr>
                                        <td><b>Recov Target</b></td>
                                        <td><span class="sw_text">{{ number_format($recTarJan) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($recTarFeb) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($recTarMar) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($recTarApr) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($recTarMay) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($recTarJun) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($recTarJul) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($recTarAug) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($recTarSep) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($recTarOct) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($recTarNov) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($recTarDec) }}</span></td>
                                    </tr>

                                    <tr>
                                        <td><b>Recov This Month</b></td>
                                        <td><span class="sw_text">{{ number_format($paymentJan) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($paymentFeb) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($paymentMar) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($paymentApr) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($paymentMay) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($paymentJun) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($paymentJul) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($paymentAug) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($paymentSep) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($paymentOct) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($paymentNov) }}</span></td>
                                        <td><span class="sw_text">{{ number_format($paymentDec) }}</span></td>
                                    </tr>

                                    <tr>
                                        <td><b>Recovery Acv%</b></td>
                                        <td class="{{ setColour($recAchvPerJan) }} text-white"><span class="sw_text">{{ $recAchvPerJan }}%</span></td>
                                        <td class="{{ setColour($recAchvPerFeb) }} text-white"><span class="sw_text">{{ $recAchvPerFeb }}%</span></td>
                                        <td class="{{ setColour($recAchvPerMar) }} text-white"><span class="sw_text">{{ $recAchvPerMar }}%</span></td>
                                        <td class="{{ setColour($recAchvPerApr) }} text-white"><span class="sw_text">{{ $recAchvPerApr }}%</span></td>
                                        <td class="{{ setColour($recAchvPerMay) }} text-white"><span class="sw_text">{{ $recAchvPerMay }}%</span></td>
                                        <td class="{{ setColour($recAchvPerJun) }} text-white"><span class="sw_text">{{ $recAchvPerJun }}%</span></td>
                                        <td class="{{ setColour($recAchvPerJul) }} text-white"><span class="sw_text">{{ $recAchvPerJul }}%</span></td>
                                        <td class="{{ setColour($recAchvPerAug) }} text-white"><span class="sw_text">{{ $recAchvPerAug }}%</span></td>
                                        <td class="{{ setColour($recAchvPerSep) }} text-white"><span class="sw_text">{{ $recAchvPerSep }}%</span></td>
                                        <td class="{{ setColour($recAchvPerOct) }} text-white"><span class="sw_text">{{ $recAchvPerOct }}%</span></td>
                                        <td class="{{ setColour($recAchvPerNov) }} text-white"><span class="sw_text">{{ $recAchvPerNov }}%</span></td>
                                        <td class="{{ setColour($recAchvPerDec) }} text-white"><span class="sw_text">{{ $recAchvPerDec }}%</span></td>
                                    </tr>
                                    </tbody>
{{--                                    {{ csrf_field() }}--}}

                                    {{--                                    <tfoot>--}}
                                    {{--                                    <tr>--}}
                                    {{--                                        <th>Product Name</th>--}}
                                    {{--                                        <th style="text-align: center;">Jan</th>--}}
                                    {{--                                        <th style="text-align: center;">Feb</th>--}}
                                    {{--                                        <th style="text-align: center;">Mar</th>--}}
                                    {{--                                        <th style="text-align: center;">Apr</th>--}}
                                    {{--                                        <th style="text-align: center;">May</th>--}}
                                    {{--                                        <th style="text-align: center;">Jun</th>--}}
                                    {{--                                        <th style="text-align: center;">Jul</th>--}}
                                    {{--                                        <th style="text-align: center;">Aug</th>--}}
                                    {{--                                        <th style="text-align: center;">Sep</th>--}}
                                    {{--                                        <th style="text-align: center;">Oct</th>--}}
                                    {{--                                        <th style="text-align: center;">Nov</th>--}}
                                    {{--                                        <th style="text-align: center;">Dec</th>--}}
                                    {{--                                        <th style="text-align: center;">Total</th>--}}
                                    {{--                                    </tr>--}}
                                    {{--                                    </tfoot>--}}
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function() {

            $('#sYear').change(function () {
                var yearId = $(this).val();
                var _token = $('input[name="_token"]').val();
                // console.log(_token);
                // console.log(yearId);
                $.ajax({
                    url: "{{ route('search.salesByYear') }}",
                    method: "POST",
                    data: {yearId: yearId, _token: _token},
                    success: function (result) {
                        $('#tableData').html(result)
                    }
                })

            })
        });

    </script>
@endsection
