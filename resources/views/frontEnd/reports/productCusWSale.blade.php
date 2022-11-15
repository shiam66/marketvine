@extends('frontEnd.master')

@section('title') Product Customer Wise Sale Volume @endsection


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

    <?php
    $active ='sales_prd';
    $mainActive ='reports';
    ?>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h4 mb-0 text-gray-800">Product Customer Wise Sale Volume</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <form name="frmcontent" action="{{ url('/') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header py-2">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group row" style="margin-bottom: 0px;">
                                    <label class="col-sm-3 col-form-label col-form-label-sm text-right">Product:</label>
                                    <div class="col-sm-9">
                                        <select class="form-control form-control-sm select2" name="productId" id="productId">
                                            <option value="" disabled selected>Select Product</option>
                                            @foreach($product as $item)
                                                <option value="{{ $item->id }}">{{ $item->productName }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group row" style="margin-bottom: 0px;">
                                    <label class="col-sm-5 col-form-label col-form-label-sm">Sales Year</label>
                                    <div class="col-sm-7">
                                        <select class="form-control form-control-sm" id="sYear" name="sYear">
                                            @foreach($salesYears as $item)
                                            <option value="{{ $item->salesYear }}">{{ $item->salesYear }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4" id="payHistoryUrl">
{{--                                <a href="{{ url('/payments-history/0') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">--}}
{{--                                    <i class="fas fa-download fa-sm text-white-50"></i> Show--}}
{{--                                </a>--}}

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
                                        <th style="width: 250px;">Customer Name</th>
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
                                        <th style="text-align: center;">Total</th>
                                    </tr>
                                    </thead>

                                    <tbody class="sales_sm_field" id="dataViews">
                                    </tbody>

                                    <tfoot class="bg-info text-white" id="footer">
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
            var productId = 0, sYear = 0;

            $('#productId').change(function () {
                productId = $(this).val();
                sYear = $('#sYear').val();
                $.ajax({
                    url: "{{ route('search.productByCustomer') }}",
                    method: "POST",
                    data: {productId: productId, sYear:sYear, _token: _token},
                    success: function (result) {
                        $('#dataViews').html(result.head)
                        $('#footer').html(result.footer)
                    }
                })
            })

            $('#sYear').change(function () {
                productId = $('#productId').val();
                sYear = $(this).val();
                $.ajax({
                    url: "{{ route('search.productByCustomer') }}",
                    method: "POST",
                    data: {productId: productId, sYear:sYear, _token: _token},
                    success: function (result) {
                        $('#dataViews').html(result.head)
                        $('#footer').html(result.footer)
                    }
                })
            })
        });

    </script>
@endsection
