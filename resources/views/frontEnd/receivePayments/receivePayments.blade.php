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
        <h1 class="h4 mb-0 text-gray-800">Receive Payments</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <form name="frmcontent" action="{{ url('/customer-receive') }}" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="card-header py-2">
                        <div class="row">
{{--                            <div class="col-md-2">--}}
{{--                                <h6 class="m-0 font-weight-bold text-primary">Receive Payments</h6>--}}
{{--                            </div>--}}

                            <div class="col-md-5">
                                <div class="form-group row" style="margin-bottom: 0px;">
                                    <label class="col-sm-4 col-form-label col-form-label-sm text-right">Deposit to Account:</label>
                                    <div class="col-sm-8">
                                        <select class="form-control form-control-sm select2" name="depositTo" id="depositTo">
                                            <option value="1">1-1100 Sahajalal 5878</option>
                                            <option value="2">2-1200 Mercantile 25688</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group row" style="margin-bottom: 0px;">
                                    <label class="col-sm-4 col-form-label col-form-label-sm text-right">Balance:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-sm" readonly value="58,58985.00">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <a href="{{ url('/payments-history') }}" class="btn btn-xs btn-primary">Payment History</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group form-row">
                                    <label class="col-sm-5 col-form-label col-form-label-sm text-right">Customer:</label>
                                    <div class="col-sm-7">
                                        <select class="form-control form-control-sm select2" name="customerId" id="customerId" required>
                                            <option value="">Select Customer</option>
                                            @foreach($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->customerName }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group form-row">
                                    <label class="col-sm-5 col-form-label col-form-label-sm text-right">Payment Method:</label>
                                    <div class="col-sm-7">
                                        <select class="form-control form-control-sm" name="paymentMethod">
                                            <option value="2">Bank</option>
                                            <option value="1">Cash</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label col-form-label-sm text-right">ID #:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="receivedId" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="form-group form-row">
                                    <label class="col-sm-4 col-form-label col-form-label-sm text-right">Memo:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="memo" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label col-form-label-sm text-right">Date:</label>
                                    <div class="col-sm-8">
                                        <input type="date" name="paymentDate" class="form-control form-control-sm" value="{{ date('Y-m-d', strtotime(now(date_default_timezone_get()))) }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label col-form-label-sm text-right">Details:</label>
                                    <div class="col-sm-8">
                                        <textarea name="details" class="form-control form-control-sm" rows="1"></textarea>
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
                                        <th style="text-align: center; width: 12%;">Date</th>
                                        <th style="text-align: center; width: 15%;">Amount</th>
                                        <th style="text-align: center; width: 15%;">Discount</th>
                                        <th style="text-align: center; width: 15%;">Total Due</th>
                                        <th style="text-align: center; width: 15%;">Amount Applied</th>
                                    </tr>
                                    </thead>

                                    <tbody class="sales_sm_field" id="dataViews">
{{--                                    @for($index=1;$index<4;$index++)--}}
{{--                                    <tr>--}}
{{--                                        <td class="form-control form-control-sm text-center" readonly>{{$index}}</td>--}}
{{--                                        <td>--}}
{{--                                            <input type="text" name="invoice[]" class="form-control form-control-sm" value="" readonly>--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            <input type="date" name="salesDate[]" class="form-control form-control-sm" value="" readonly>--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            <input type="text" name="salesAmount[]" class="form-control form-control-sm text-right" value="" readonly>--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            <input type="number" name="discount[]" id="discount[{{ $index }}]" data-index="{{ $index }}" class="receive form-control form-control-sm text-right">--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            <input type="number" name="dueAmount[]" id="dueAmount[{{ $index }}]" data-index="{{ $index }}" class="receive due form-control form-control-sm text-right" value="" readonly>--}}
{{--                                            <input type="hidden" name="due[]" id="due[{{ $index }}]" data-index="{{ $index }}" class="receive form-control form-control-sm text-right" value="" readonly>--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            <input type="number" name="appliedAmount[]" id="appliedAmount[{{ $index }}]" data-index="{{ $index }}" class="receive applied form-control form-control-sm text-right">--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                    @endfor--}}

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="bg-info text-white text-right"><span id="totalDueAmount">0</span></td>
                                        <td class="bg-info text-white text-right"><span id="totalAppliedAmount">0</span></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4 offset-sm-1">

                            </div>

                            <div class="col-sm-4 offset-sm-3">
                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label col-form-label-sm text-right">Finance Charge:</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control form-control-sm" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label col-form-label-sm text-right">Out of Balance:</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="outOfBalance" id="outOfBalance" class="form-control form-control-sm text-right outbalance" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <center>
                                    <button type="submit" class="btn btn-primary">Record</button>
                                    <button type="reset" class="btn btn-danger">Cancel</button>
                                </center>
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
            $(".receive").on('keyup change', calculateSum);

            var _token = $('input[name="_token"]').val();
            var customerId=0;
            $('#customerId').change(function () {
                customerId = $(this).val();
                $.ajax({
                    url: "{{ route('search.duesById') }}",
                    method: "POST",
                    data: {customerId: customerId, _token: _token},
                    success: function (result) {
                        $('#dataViews').html(result)
                        $(".receive").on('keyup change', calculateSum);
                    }
                })
            })
        });

        function calculateSum() {
            console.log(5)

            var $input = $(this);
            var $row = $input.closest('tr');
            var inputDataIndex = $(this).data('index');

            var discount = 0, due = 0, applied = 0, newDew = 0, dueSum = 0, appliedSum = 0;

            discount = parseFloat(document.getElementById("discount[" + inputDataIndex + "]").value);
            if (isNaN(discount)) {
                discount = 0;
            }
            due = parseFloat(document.getElementById("due[" + inputDataIndex + "]").value);
            if (isNaN(due)) {
                due = 0;
            }
            applied = parseFloat(document.getElementById("appliedAmount[" + inputDataIndex + "]").value);
            if (isNaN(applied)) {
                applied = 0;
            }
            newDew = due - discount;
            $row.find(".due").val(newDew);
            if (applied > newDew) {
                $row.find(".applied").css("background-color", "red")
            } else {
                $row.find(".applied").css("background-color", "white")
            }

            $(".due").each(function () {
                if (this.value.length && !isNaN(this.value)) {
                    dueSum += parseFloat(this.value);
                    // $(this).css("background-color", "#FEFFB0");
                    // $(this).css("background-color", "red");
                }
            });
            $("#totalDueAmount").html(dueSum);

            $(".applied").each(function () {
                if (this.value.length && !isNaN(this.value)) {
                    appliedSum += parseFloat(this.value);
                }
            });
            $("#totalAppliedAmount").html(appliedSum);

            if (appliedSum > dueSum) {
                $("#outOfBalance").val(dueSum - appliedSum);
                $("#outOfBalance").css("background-color", "red");
            } else {
                $("#outOfBalance").val(0);
                $("#outOfBalance").css("background-color", "white");
            }
        }

    </script>
@endsection
