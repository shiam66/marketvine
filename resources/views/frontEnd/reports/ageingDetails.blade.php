@extends('frontEnd.master')

@section('title') Ageing Details @endsection


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
        <h1 class="h4 mb-0 text-gray-800">Ageing Details</h1>
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
                                    <label class="col-sm-4 col-form-label col-form-label-sm text-right">Customer:</label>
                                    <div class="col-sm-8">
                                        <select class="form-control form-control-sm select2" name="customerId" id="customerId">
                                            <option value="">Select Customer</option>
                                            @foreach($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->customerName }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group row" style="margin-bottom: 0px;">
                                    <label class="col-sm-6 col-form-label col-form-label-sm text-right">Receivable As Of:</label>
                                    <div class="col-sm-6">
                                        <input type="date" name="invDate" id="invDate" class="form-control form-control-sm" value="{{ date('Y-m-d', strtotime(now(date_default_timezone_get()))) }}">
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
                                            <th style="text-align: center; width: 12%;">Invoice ID#</th>
                                            <th style="text-align: center; width: 12%;">Invoice Date</th>
                                            <th style="text-align: center; width: 16%;">Total Due</th>
                                            <th style="text-align: center; width: 12%;">0-30 Days</th>
                                            <th style="text-align: center; width: 12%;">31-60 Days</th>
                                            <th style="text-align: center; width: 12%;">61-90 Days</th>
                                            <th style="text-align: center; width: 12%;">91-120 Days</th>
                                            <th style="text-align: center; width: 12%;">120+ Days</th>
                                        </tr>
                                    </thead>

                                    <tbody class="sales_sm_field" id="dataViews">
                                        <tr>
                                            <td>01-115874</td>
                                            <td>28/09/2022</td>
                                            <td class="text-right"><span class="sw_text">152222.00</span></td>
                                            <td class="text-right"><span class="sw_text">0.00</span></td>
                                            <td class="text-right"><span class="sw_text">0.00</span></td>
                                            <td class="text-right"><span class="sw_text">0.00</span></td>
                                            <td class="text-right"><span class="sw_text">0.00</span></td>
                                            <td class="text-right"><span class="sw_text">152222.00</span></td>
                                        </tr>
                                    </tbody>
                                    <tfoot id="footer">
                                        <tr>
                                            <th class="text-right" colspan="2">Total</th>
                                            <th class="text-right"><span class="sw_text">152222.00</span></th>
                                            <th class="text-right"><span class="sw_text">0.00</span></th>
                                            <th class="text-right"><span class="sw_text">0.00</span></th>
                                            <th class="text-right"><span class="sw_text">0.00</span></th>
                                            <th class="text-right"><span class="sw_text">0.00</span></th>
                                            <th class="text-right"><span class="sw_text">152222.00</span></th>
                                        </tr>
                                        <tr>
                                            <th class="text-right" colspan="7">Grand Total</th>
                                            <th class="text-right"><span class="sw_text">258745555.00</span></th>
                                        </tr>
                                        <tr>
                                            <th class="text-right" colspan="2">Ageing Percent</th>
                                            <th class="text-right"><span class="sw_text">0.00%</span></th>
                                            <th class="text-right"><span class="sw_text">0.00%</span></th>
                                            <th class="text-right"><span class="sw_text">0.00%</span></th>
                                            <th class="text-right"><span class="sw_text">0.00%</span></th>
                                            <th class="text-right"><span class="sw_text">0.00%</span></th>
                                            <th class="text-right"><span class="sw_text">100.00%</span></th>
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
            var customerId = 0, invDate = 0;

            $('#customerId').change(function () {
                customerId = $(this).val();
                invDate = $('#invDate').val();
                $.ajax({
                    url: "{{ route('search.ageingDetail') }}",
                    method: "POST",
                    data: {customerId: customerId, invDate:invDate, _token: _token},
                    success: function (result) {
                        // console.log(result);
                        $('#dataViews').html(result.header)
                        $('#footer').html(result.footer)
                    }
                })
            })

            $('#invDate').change(function () {
                customerId = $('#customerId').val();
                invDate = $(this).val();
                $.ajax({
                    url: "{{ route('search.ageingDetail') }}",
                    method: "POST",
                    data: {customerId: customerId, invDate:invDate, _token: _token},
                    success: function (result) {
                        $('#dataViews').html(result.header)
                        $('#footer').html(result.footer)
                    }
                })
            })
        });
    </script>
@endsection
