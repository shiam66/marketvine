@extends('frontEnd.master')

@section('title') Sales Register @endsection


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
    </style>

@endsection

@section('mainContent')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h4 mb-0 text-gray-800">Sales Register</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <form name="frmcontent" action="{{ url('/abc') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group form-row">
                                    <label class="col-sm-4 col-form-label col-form-label-sm text-right">Customer:</label>
                                    <div class="col-sm-8">
                                        <select class="form-control form-control-sm select2" name="customerId" id="customerId">
                                            <option value="">All Customer</option>
                                            @foreach($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->customerName }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label col-form-label-sm text-right">From Date:</label>
                                    <div class="col-sm-7">
                                            <input type="date" name="fromDate" id="fromDate" class="form-control form-control-sm" value="{{ date('Y-m-d', strtotime(now(date_default_timezone_get()))) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label col-form-label-sm text-right">To Date:</label>
                                    <div class="col-sm-7">
                                            <input type="date" name="toDate" id="toDate" class="form-control form-control-sm" value="{{ date('Y-m-d', strtotime(now(date_default_timezone_get()))) }}"">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3">
{{--                                <div class="form-group row">--}}
{{--                                    <div class="col-sm-6">--}}
{{--                                        <center>--}}
{{--                                            <button type="submit" class="d-none d-sm-inline-block btn btn-sm shadow-sm btn-primary">View</button>--}}
{{--                                        </center>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-sm-6" id="payHistoryUrl">--}}
{{--                                        <!--<a href="" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">-->--}}
{{--                                        <!--    <i class="fas fa-file-pdf fa-sm text-white-50"></i> PDF Report-->--}}
{{--                                        <!--</a>-->--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <table class="table table-sm table-bordered" id="">
                                    <thead class="bg-info text-white">
                                        <tr>
                                            <th style="text-align: center; width: 10%;">Date</th>
                                            <th style="text-align: center; width: 10%;">Invoice</th>
                                            <th style="text-align: center; width: 10%;">Customer PO</th>
                                            <th style="text-align: center; width: 25%;">Customer</th>
                                            <th style="text-align: center; width: 15%;">Amount</th>
                                            <th style="text-align: center; width: 15%;">Amount Due</th>
                                            <th style="text-align: center; width: 10%;">Status</th>
                                            <th style="text-align: center; width: 5%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="sales_sm_field" id="header">
                                    @php $totalSalesAmount = null; $totalBalanceDue = null; @endphp
                                    @foreach($sales as $sale)
                                        @php
                                            $totalSalesAmount = $totalSalesAmount + $sale->totalAmount;
                                            $totalBalanceDue = $totalBalanceDue + $sale->balanceDue;
                                        @endphp
                                        <tr>
                                            <td class="text-center">{{ date('d-m-Y', strtotime($sale->invoiceDate)) }}</td>
                                            <td class="text-left"><span>{{ $sale->invoice }}</span></td>
                                            <td class="text-left"><span>{{ $sale->customerPo }}</span></td>
                                            <td class="text-left"><span>{{ $sale->customerName }}</span></td>
                                            <td class="text-right"><span>{{ $sale->totalAmount }}</span></td>
                                            <td class="text-right"><span>{{ $sale->balanceDue }}</span></td>
                                            <td class="text-center"><span>Order</span></td>
                                            <td class="text-center">
                                                @if($sale->paymentStatus==0)
                                                    <a href="{{ url('/sales-edit/'.$sale->id) }}" target="_blank" class="btn btn-primary btn-sm">Edit</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot id="footer">
                                        <tr>
                                            <td class="bg-info"></td>
                                            <td class="bg-info"></td>
                                            <td class="bg-info"></td>
                                            <td class="bg-info"></td>
                                            <td class="bg-info text-white text-right"><span>{{ $totalSalesAmount }}</span></td>
                                            <td class="bg-info text-white text-right"><span>{{ $totalBalanceDue }}</span></td>
                                            <td class="bg-info"></td>
                                            <td class="bg-info"></td>
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

        $(document).ready(function() {
            var _token = $('input[name="_token"]').val();
            var customerId=0, url="", fDate="", tDate="";

            $('#customerId').change(function () {
                customerId = $(this).val();
                fDate = $('#fromDate').val();
                tDate = $('#toDate').val();
                $.ajax({
                    url: "{{ route('search.salesReg') }}",
                    method: "POST",
                    data: {customerId: customerId, fDate: fDate, tDate: tDate, _token: _token},
                    success: function (result) {
                        $('#header').html(result.header)
                        $('#footer').html(result.footer)
                    }
                })
            })

            $('#fromDate').change(function () {
                customerId = $('#customerId').val();
                fDate=$(this).val();
                tDate=$('#toDate').val();
                $.ajax({
                    url: "{{ route('search.salesReg') }}",
                    method: "POST",
                    data: {customerId: customerId, fDate: fDate, tDate: tDate, _token: _token},
                    success: function (result) {
                        $('#header').html(result.header)
                        $('#footer').html(result.footer)
                    }
                })
            })

            $('#toDate').change(function () {
                customerId = $('#customerId').val();
                fDate=$('#fromDate').val();
                tDate=$(this).val();
                $.ajax({
                    url: "{{ route('search.salesReg') }}",
                    method: "POST",
                    data: {customerId: customerId, fDate: fDate, tDate: tDate, _token: _token},
                    success: function (result) {
                        $('#header').html(result.header)
                        $('#footer').html(result.footer)
                    }
                })
            })

        });
    </script>
@endsection
