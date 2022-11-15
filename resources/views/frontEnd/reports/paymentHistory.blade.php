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

    <?php
        $active ='payment_history';
        $mainActive ='reports';
    ?>

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
                            <div class="col-sm-3">
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
                            @php
                                if ($customerById==null){$customerId=0;}else{ $customerId=$customerById->id;}
                                if ($fromDate==null){$fromDate=date('Y-m-d', strtotime(now(date_default_timezone_get())));}
                                if ($toDate==null){$toDate=date('Y-m-d', strtotime(now(date_default_timezone_get())));}
                            @endphp
                            <div class="col-sm-3">
                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label col-form-label-sm text-right">From Date:</label>
                                    <div class="col-sm-7">
                                            <input type="date" name="fromDate" id="fromDate" class="form-control form-control-sm" value="{{ date('Y-m-d', strtotime($fromDate)) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label col-form-label-sm text-right">To Date:</label>
                                    <div class="col-sm-7">
                                            <input type="date" name="toDate" id="toDate" class="form-control form-control-sm" value="{{ date('Y-m-d', strtotime($toDate)) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <center>
                                            <button type="submit" class="d-none d-sm-inline-block btn btn-sm shadow-sm btn-primary">Payment View</button>
                                        </center>
                                    </div>
                                    <div class="col-sm-6" id="payHistoryUrl">
                                        <a href="{{ url('/payment-report/'.$customerId.'/'.$fromDate.'/'.$toDate.'') }}" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
                                            <i class="fas fa-file-pdf fa-sm text-white-50"></i> PDF Report
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <table class="table table-sm table-bordered" id="dataTable">
                                    <thead class="bg-info text-white">
                                    <tr>
                                        <th style="text-align: center; width: 8%;">Pay. ID</th>
                                        <th style="text-align: center; width: 12%;">Pay. Date</th>
                                        <th style="text-align: center; width: 12%;">Invoice</th>
                                        <th style="text-align: center; width: 12%;">Inv. Date</th>
                                        <th style="text-align: center; width: 12%;">Due Amount</th>
                                        <th style="text-align: center; width: 12%;">Disc. Amount</th>
                                        <th style="text-align: center; width: 12%;">Pay. Amount</th>
                                        <th style="text-align: center; width: 12%;">Balance</th>
                                        <th style="text-align: center; width: 8%;">Action</th>
                                    </tr>
                                    </thead>

                                    <tbody class="sales_sm_field">
                                    @if($payments!=null)
                                        @php $totalPay=0; @endphp
                                        @foreach($payments as $payment)
                                            @php $totalPay = $totalPay + $payment->receivedAmount; @endphp
                                            <tr>
                                                <td class="text-center">{{ $payment->id }}</td>
                                                <td class="text-left"><span>{{ date('d-m-Y', strtotime($payment->paymentDate)) }}</span></td>
                                                <td class="text-left"><span>{{ $payment->invoice }}</span></td>
                                                <td class="text-left"><span>{{ date('d-m-Y', strtotime($payment->invoiceDate)) }}</span></td>
                                                <td class="text-right"><span>{{ $payment->dueAmount }}</span></td>
                                                <td class="text-right"><span>{{ $payment->discountAmount }}</span></td>
                                                <td class="text-right"><span>{{ $payment->receivedAmount }}</span></td>
                                                <td class="text-right"><span>{{ $payment->dueAmount - $payment->discountAmount - $payment->receivedAmount }}</span></td>
                                                <td class="text-center">
                                                        <a href="{{ url('/payment-delete/'.$payment->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete this');">Delete</a>
                                                </td>

                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td class="bg-info"></td>
                                        <td class="bg-info"></td>
                                        <td class="bg-info"></td>
                                        <td class="bg-info"></td>
                                        <td class="bg-info"></td>
                                        <td class="bg-info"></td>
                                        <td class="bg-info text-white text-right"><span>{{ $totalPay }}</span></td>
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
            var customerId=0, url="", fDate="", tDate="";

            $('#customerId').change(function () {
                customerId = $(this).val();
                fDate=$('#fromDate').val();
                tDate=$('#toDate').val();
                url = '<a href=/payment-report/' + customerId + '/' + fDate + '/' + tDate + ' target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-file-pdf fa-sm text-white-50"></i> PDF Report</a>';
                $("#payHistoryUrl").html(url);
            })

            $('#fromDate').change(function () {
                customerId = $('#customerId').val();
                fDate=$(this).val();
                tDate=$('#toDate').val();
                url = '<a href=/payment-report/' + customerId + '/' + fDate + '/' + tDate + ' target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-file-pdf fa-sm text-white-50"></i> PDF Report</a>';
                $("#payHistoryUrl").html(url);
            })

            $('#toDate').change(function () {
                customerId = $('#customerId').val();
                fDate=$('#fromDate').val();
                tDate=$(this).val();
                url = '<a href=/payment-report/' + customerId + '/' + fDate + '/' + tDate + ' target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-file-pdf fa-sm text-white-50"></i> PDF Report</a>';
                $("#payHistoryUrl").html(url);
            })

        });
    </script>
@endsection
