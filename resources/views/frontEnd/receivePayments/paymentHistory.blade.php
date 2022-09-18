@extends('frontEnd.master')

@section('title') Receive Payments @endsection


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
        <h1 class="h4 mb-0 text-gray-800">Payment History</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <form name="frmcontent" action="{{ url('/payment-history-view') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group form-row">
                                    <label class="col-sm-4 col-form-label col-form-label-sm text-right">Customer:</label>
                                    <div class="col-sm-8">
                                        <select class="form-control form-control-sm select2" name="customerId" id="customerId" required>
                                            @if($customerById==null)
                                                <option value="">Select Customer</option>
                                            @else
                                                <option value="{{ $customerById->id }}">{{ $customerById->customerName }}</option>
                                            @endif
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
                                        @if($fromDate==null)
                                            <input type="date" name="fromDate" class="form-control form-control-sm" value="{{ date('Y-m-d', strtotime(now(date_default_timezone_get()))) }}">
                                        @else
                                            <input type="date" name="fromDate" class="form-control form-control-sm" value="{{ date('Y-m-d', strtotime($fromDate)) }}">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label col-form-label-sm text-right">To Date:</label>
                                    <div class="col-sm-7">
                                        @if($toDate==null)
                                            <input type="date" name="toDate" class="form-control form-control-sm" value="{{ date('Y-m-d', strtotime(now(date_default_timezone_get()))) }}">
                                        @else
                                            <input type="date" name="toDate" class="form-control form-control-sm" value="{{ date('Y-m-d', strtotime($toDate)) }}">
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <center>
                                            <button type="submit" class="btn btn-primary">Payment View</button>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <table class="table table-sm table-bordered">
                                    <thead class="bg-info text-white">
                                    <tr>
                                        <th style="text-align: center; width: 5%;">SL</th>
                                        <th style="text-align: center; width: 13%;">Invoice</th>
                                        <th style="text-align: center; width: 12%;">Invoice Date</th>
                                        <th style="text-align: center; width: 12%;">Payment Date</th>
                                        <th style="text-align: center; width: 15%;">Discount Amount</th>
                                        <th style="text-align: center; width: 15%;">Payment Amount</th>
                                    </tr>
                                    </thead>

                                    <tbody class="sales_sm_field">
                                    @if($payments!=null)
                                        @php $totalPay=0; @endphp
                                        @foreach($payments as $payment)
                                            @php $totalPay = $totalPay + $payment->receivedAmount; @endphp
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-left"><span>{{ $payment->invoice }}</span></td>
                                                <td class="text-left"><span>{{ date('d-m-Y', strtotime($payment->invoiceDate)) }}</span></td>
                                                <td class="text-left"><span>{{ date('d-m-Y', strtotime($payment->paymentDate)) }}</span></td>
                                                <td class="text-right"><span>{{ $payment->discountAmount }}</span></td>
                                                <td class="text-right"><span>{{ $payment->receivedAmount }}</span></td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td class="bg-info"></td>
                                            <td class="bg-info"></td>
                                            <td class="bg-info"></td>
                                            <td class="bg-info"></td>
                                            <td class="bg-info"></td>
                                            <td class="bg-info text-white text-right"><span>{{ $totalPay }}</span></td>

                                        </tr>
                                    @endif
                                    </tbody>
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
            var customerId=0;

            $('#customerId').change(function () {
                customerId = $(this).val();
                $("#totalReceiveDue").val(customerId);
            })
        });
    </script>
@endsection
