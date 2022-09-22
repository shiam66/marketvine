@extends('frontEnd.master')

@section('title') Ageing Summery @endsection


@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <style>

        .form-group {
            margin-bottom: 5px;
        }
        .card-body {
            padding: 10px 15px;
        }
        .table-sm td, .table-sm th {
            padding: 0px;
        }
        .sales_sm_field .form-control-sm {
            height: 25px;
            padding: 2px 3px;
            font-size: 12px;
            line-height: 1;
            border-radius: 0px;
        }

        .select2-container .select2-selection--single{
            height:26px !important;
        }
        .select2-container--default .select2-selection--single{
            border: 1px solid #ccc !important;
            border-radius: 0px !important;
        }
        .select2-results__option[aria-selected] {
            cursor: pointer;
            font-size: 13px;
        }

        .table-sm .sw_text{
            font-size: 12px;
        }
    </style>

@endsection

@section('mainContent')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h4 mb-0 text-gray-800">Ageing Summery</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <form name="frmcontent" action="{{ url('/customer-receive') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header py-2">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group row" style="margin-bottom: 0px;">
                                    <label class="col-sm-6 col-form-label col-form-label-sm text-right">Receivable As Of:</label>
                                    <div class="col-sm-6">
                                        <input type="date" name="" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4" id="payHistoryUrl">
                                <a href="{{ url('/payments-history/0') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                    <i class="fas fa-eye fa-sm text-white-50"></i> Display
                                </a>

                                <a href="{{ url('/payments-history/0') }}" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
                                    <i class="fas fa-file-pdf fa-sm text-white-50"></i> PDF Report
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <table class="table table-sm table-bordered">
                                    <thead class="bg-info text-white">
                                    <tr>
                                        <th style="text-align: center; width: 20%;">Customer Name</th>
                                        <th style="text-align: center; width: 10%;">Total Due</th>
                                        <th style="text-align: center; width: 14%;">0-30 Days</th>
                                        <th style="text-align: center; width: 14%;">31-60 Days</th>
                                        <th style="text-align: center; width: 14%;">61-90 Days</th>
                                        <th style="text-align: center; width: 14%;">91-120 Days</th>
                                        <th style="text-align: center; width: 14%;">120+ Days</th>
                                    </tr>
                                    </thead>

                                    <tbody class="sales_sm_field" id="dataViews">

                                    <tr>
                                        <td><b>AT. Haque</b></td>
                                        <td class="text-right"><span class="sw_text">152222.00</span></td>
                                        <td class="text-right"><span class="sw_text">0.00</span></td>
                                        <td class="text-right"><span class="sw_text">0.00</span></td>
                                        <td class="text-right"><span class="sw_text">0.00</span></td>
                                        <td class="text-right"><span class="sw_text">0.00</span></td>
                                        <td class="text-right"><span class="sw_text">152222.00</span></td>
                                    </tr>

                                    <tr>
                                        <td><b>Abc customer Name</b></td>
                                        <td class="text-right"><span class="sw_text">152222.00</span></td>
                                        <td class="text-right"><span class="sw_text">0.00</span></td>
                                        <td class="text-right"><span class="sw_text">0.00</span></td>
                                        <td class="text-right"><span class="sw_text">0.00</span></td>
                                        <td class="text-right"><span class="sw_text">0.00</span></td>
                                        <td class="text-right"><span class="sw_text">152222.00</span></td>
                                    </tr>

                                    <tr>
                                        <td><b>AT. Abc Name</b></td>
                                        <td class="text-right"><span class="sw_text">152222.00</span></td>
                                        <td class="text-right"><span class="sw_text">0.00</span></td>
                                        <td class="text-right"><span class="sw_text">0.00</span></td>
                                        <td class="text-right"><span class="sw_text">0.00</span></td>
                                        <td class="text-right"><span class="sw_text">0.00</span></td>
                                        <td class="text-right"><span class="sw_text">152222.00</span></td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="text-right">Total</th>
                                            <th class="text-right"><span class="sw_text">152222.00</span></th>
                                            <th class="text-right"><span class="sw_text">0.00</span></th>
                                            <th class="text-right"><span class="sw_text">0.00</span></th>
                                            <th class="text-right"><span class="sw_text">0.00</span></th>
                                            <th class="text-right"><span class="sw_text">0.00</span></th>
                                            <th class="text-right"><span class="sw_text">152222.00</span></th>
                                        </tr>

                                        <tr>
                                            <th class="text-right"><b>Ageing Percent</b></th>
                                            <th class="text-right"><span class="sw_text"></span></th>
                                            <th class="text-right"><span class="sw_text">0.00%</span></th>
                                            <th class="text-right"><span class="sw_text">0.00%</span></th>
                                            <th class="text-right"><span class="sw_text">0.00%</span></th>
                                            <th class="text-right"><span class="sw_text">0.00%</span></th>
                                            <th class="text-right"><span class="sw_text">100.0%</span></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>
        $('.select2').select2();
    </script>
@endsection
