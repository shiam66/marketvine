@extends('frontEnd.master')

@section('title') Sales @endsection


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
        $active ='enter_sales';
        $mainActive ='sales';
    ?>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h4 mb-0 text-gray-800">Sales</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <form name="frmcontent" action="{{ url('/sales-record') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header py-2">
                        <div class="row">
                            <div class="col-md-3">
                                <h6 class="m-0 font-weight-bold text-primary">Sales New Item</h6>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label col-form-label-sm text-right">Type:</label>
                                    <div class="col-sm-8">
                                        <select class="form-control form-control-sm" name="type">
                                            <option value="1">INVOICE</option>
                                            <option value="2">ORDER</option>
                                            <option value="0">QUOTE</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label col-form-label-sm text-right">Invoice #:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="invoice" class="form-control form-control-sm">
                                        <span class="text-danger">{{  $errors->has('invoice') ? $errors->first('invoice'): '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group row" style="margin-bottom: 0px;">
                                    <label class="col-sm-4 col-form-label col-form-label-sm text-right">Date:</label>
                                    <div class="col-sm-8">
                                        <input type="date" name="invoiceDate" class="form-control form-control-sm" value="{{ date('Y-m-d', strtotime(now(date_default_timezone_get()))) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label col-form-label-sm text-right">Customer:</label>
                                    <div class="col-sm-8">
                                        <select class="form-control form-control-sm" id="customerId" name="customerId">
                                            <option value="option_select" disabled selected>Select Customer</option>
                                            @foreach($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->customerName }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">{{  $errors->has('customerId') ? $errors->first('customerId'): '' }}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label col-form-label-sm text-right">Customer PO:</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="customerPo" class="form-control form-control-sm">
                                        <span class="text-danger">{{  $errors->has('customerPo') ? $errors->first('customerPo'): '' }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3" id="customerBillTo">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label col-form-label-sm text-right">Bill to:</label>
                                    <div class="col-sm-8">
                                        <textarea name="billTo" class="form-control form-control-sm" rows="1" readonly></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label col-form-label-sm text-right">Bill Con.:</label>
                                    <div class="col-sm-8">
                                        <textarea name="billToContact" class="form-control form-control-sm" rows="1" readonly></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3" id="customerShipTo">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label col-form-label-sm text-right">Ship to:</label>
                                    <div class="col-sm-8">
                                        <textarea name="shipTo" class="form-control form-control-sm" rows="1" readonly></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label col-form-label-sm text-right">Ship Con.:</label>
                                    <div class="col-sm-8">
                                        <textarea name="shipToContact" class="form-control form-control-sm" rows="1" readonly></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <table class="table table-sm table-bordered">
                                    <thead class="bg-info text-white">
                                    <tr>
                                        <th style="text-align: center; width: 15%;">Item Code</th>
                                        <th style="text-align: center; width: 30%;">Item Name</th>
                                        <th style="text-align: center; width: 10%;">Qty</th>
                                        <th style="text-align: center; width: 7%;">Unit</th>
                                        <th style="text-align: center; width: 15%;">Unit Price</th>
                                        <th style="text-align: center; width: 8%;">Disc%</th>
                                        <th style="text-align: center; width: 15%;">Amount</th>
                                    </tr>
                                    </thead>

                                    <tbody class="sales_sm_field">
                                    @for($i=1; $i<11;$i++)
                                        <tr>
                                            <td>
                                                <select class="form-control form-control-sm select2" id="itemCode{{$i}}" name="itemCode{{$i}}">
                                                    <option value="">Select Code</option>
                                                    @foreach($product as $item)
                                                        <option value="{{ $item->id }}">{{ $item->productNumber }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control form-control-sm select2" id="itemName{{$i}}" name="itemName{{$i}}">
                                                    <option value="">Select Item Name</option>
                                                    @foreach($product as $item)
                                                        <option value="{{ $item->id }}">{{ $item->productName }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="number" step="0.01" id="qty{{$i}}" name="qty{{$i}}" class="form-control form-control-sm"></td>
                                            <td><span id="unit{{$i}}"></span></td>
                                            <td><input type="number" step="0.01" id="unitPrice{{$i}}" name="unitPrice{{$i}}" class="form-control form-control-sm"></td>
                                            <td><input type="number" step="0.01" id="discount{{$i}}" name="discount{{$i}}" value="" class="form-control form-control-sm"></td>
                                            <td><input type="text" id="totalAmount{{$i}}" name="totalAmount{{$i}}" class="form-control form-control-sm" readonly></td>
                                            <td><input type="hidden" id="units{{$i}}" name="units{{$i}}" class="form-control form-control-sm"></td>
                                        </tr>
                                    @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4 offset-sm-1">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label col-form-label-sm text-right">Notes:</label>
                                    <div class="col-sm-8">
                                        <textarea name="notes" class="form-control form-control-sm" rows="2"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 offset-sm-3">
                                <div class="form-group row">
                                    <label class="col-sm-6 col-form-label col-form-label-sm text-right">Sales Amount:</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="salesAmount" name="salesAmount" class="form-control form-control-sm" readonly>
                                        <span class="text-danger">{{  $errors->has('salesAmount') ? $errors->first('salesAmount'): '' }}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-6 col-form-label col-form-label-sm text-right">Vat in Total:</label>
                                    <div class="col-sm-6">
                                        <input type="number" step="0.01" id="vat" name="vat" class="form-control form-control-sm">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-6 col-form-label col-form-label-sm text-right">Others:</label>
                                    <div class="col-sm-6">
                                        <input type="number" step="0.01" id="others" name="others" class="form-control form-control-sm">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-6 col-form-label col-form-label-sm text-right">Total Amount:</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="totalAmount" name="totalAmount" class="form-control form-control-sm" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-6 col-form-label col-form-label-sm text-right">Advance:</label>
                                    <div class="col-sm-6">
                                        <input type="number" step="0.01" id="advance" name="advance" class="form-control form-control-sm">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    {{--                                    <label class="col-sm-5 col-form-label col-form-label-sm text-right">Payment Method</label>--}}
                                    <div class="col-sm-6 col-form-label col-form-label-sm text-right">
                                        <select class="form-control form-control-sm" name="payMethod">
                                            <option value="2">Pay Method Bank</option>
                                            <option value="1">Pay Method Cash</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="paymentMethod" class="form-control form-control-sm">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-6 col-form-label col-form-label-sm text-right">Balance Due:</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="balance" name="balance" class="form-control form-control-sm" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <center>
                                    <a href="" class="btn btn-xs btn-primary">Print</a>
                                    <a href="" class="btn btn-xs btn-primary">Reimburse</a>
                                    <a href="{{ url('/receive-payments') }}" class="btn btn-xs btn-primary">Receive Payment</a>
                                    <button type="submit" class="btn btn-primary">Record</button>
                                    <button type="reset" class="btn btn-danger">Cancel</button>
                                </center>
                            </div>
                        </div>
                    </div>
                </form>


            </div>
        </div>

        <div class="col-lg-12">
            <div class="card mb-4">

                <div class="card-header py-2">
                    <div class="row">
                        <div class="col-md-3">
                            <h6 class="m-0 font-weight-bold text-primary">Todays Sales Entry</h6>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <table class="table table-sm table-bordered" id="">
                                <thead class="bg-info text-white">
                                    <tr>
                                        <th style="text-align: center; width: 10%;">Date</th>
                                        <th style="text-align: center; width: 10%;">Invoice</th>
                                        <th style="text-align: center; width: 10%;">Cus PO</th>
                                        <th style="text-align: center; width: 25%;">Customer</th>
                                        <th style="text-align: center; width: 15%;">Amount</th>
                                        <th style="text-align: center; width: 15%;">Amount Due</th>
                                        <th style="text-align: center; width: 10%;">Status</th>
                                        <th style="text-align: center; width: 5%;">Action</th>
                                    </tr>
                                </thead>

                                <tbody class="sales_sm_field">
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
                                <tfoot>
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
            var customerId=0;

            $('#customerId').change(function () {
                customerId = $(this).val();
                // console.log(_token);
                // console.log(inputDataIndex);
                $.ajax({
                    url: "{{ route('search.customerBillTo') }}",
                    method: "POST",
                    data: {customerId: customerId, _token: _token},
                    success: function (result) {
                        $('#customerBillTo').html(result)
                    }
                })
                $.ajax({
                    url: "{{ route('search.customerShipTo') }}",
                    method: "POST",
                    data: {customerId: customerId, _token: _token},
                    success: function (result) {
                        $('#customerShipTo').html(result)
                    }
                })
            })

            $('#itemCode1').change(function () {
                var itemId = $(this).val();
                var qty = $('#qty1').val();
                var dis = $('#discount1').val();
                $.ajax({
                    url: "{{ route('search.itemName') }}",
                    method: "POST",
                    data: {itemId: itemId, _token: _token},
                    success: function (result) {
                        $('#itemName1').html(result)
                    }
                })
                $.ajax({
                    url: "{{ route('search.others') }}",
                    method: "POST",
                    data: {customerId:customerId, itemId: itemId, _token: _token},
                    success: function (result) {
                        var discount = (result.unitPrice * qty) / 100 * dis;
                        $('#unit1').html(result.unit);
                        $('#units1').val(result.unit);
                        $('#unitPrice1').val(result.unitPrice);
                        $('#totalAmount1').val(result.unitPrice * qty - discount);
                        $('#salesAmount').val(salesTotal());
                        $('#totalAmount').val(totalAmount());
                        $('#balance').val(balance());
                    }
                })
            })

            $('#itemCode2').change(function () {
                var itemId = $(this).val();
                var qty = $('#qty2').val();
                var dis = $('#discount2').val();
                $.ajax({
                    url: "{{ route('search.itemName') }}",
                    method: "POST",
                    data: {itemId: itemId, _token: _token},
                    success: function (result) {
                        $('#itemName2').html(result)
                    }
                })
                $.ajax({
                    url: "{{ route('search.others') }}",
                    method: "POST",
                    data: {customerId:customerId, itemId: itemId, _token: _token},
                    success: function (result) {
                        var discount = (result.unitPrice * qty) / 100 * dis;
                        $('#unit2').html(result.unit);
                        $('#units2').val(result.unit);
                        $('#unitPrice2').val(result.unitPrice);
                        $('#totalAmount2').val(result.unitPrice * qty - discount);
                        $('#salesAmount').val(salesTotal());
                        $('#totalAmount').val(totalAmount());
                        $('#balance').val(balance());
                    }
                })
            })

            $('#itemCode3').change(function () {
                var itemId = $(this).val();
                var qty = $('#qty3').val();
                var dis = $('#discount3').val();
                $.ajax({
                    url: "{{ route('search.itemName') }}",
                    method: "POST",
                    data: {itemId: itemId, _token: _token},
                    success: function (result) {
                        $('#itemName3').html(result)
                    }
                })
                $.ajax({
                    url: "{{ route('search.others') }}",
                    method: "POST",
                    data: {customerId:customerId, itemId: itemId, _token: _token},
                    success: function (result) {
                        var discount = (result.unitPrice * qty) / 100 * dis;
                        $('#unit3').html(result.unit);
                        $('#units3').val(result.unit);
                        $('#unitPrice3').val(result.unitPrice);
                        $('#totalAmount3').val(result.unitPrice * qty - discount);
                        $('#salesAmount').val(salesTotal());
                        $('#totalAmount').val(totalAmount());
                        $('#balance').val(balance());
                    }
                })
            })

            $('#itemCode4').change(function () {
                var itemId = $(this).val();
                var qty = $('#qty4').val();
                var dis = $('#discount4').val();
                $.ajax({
                    url: "{{ route('search.itemName') }}",
                    method: "POST",
                    data: {itemId: itemId, _token: _token},
                    success: function (result) {
                        $('#itemName4').html(result)
                    }
                })
                $.ajax({
                    url: "{{ route('search.others') }}",
                    method: "POST",
                    data: {customerId:customerId, itemId: itemId, _token: _token},
                    success: function (result) {
                        var discount = (result.unitPrice * qty) / 100 * dis;
                        $('#unit4').html(result.unit);
                        $('#units4').val(result.unit);
                        $('#unitPrice4').val(result.unitPrice);
                        $('#totalAmount4').val(result.unitPrice * qty - discount);
                        $('#salesAmount').val(salesTotal());
                        $('#totalAmount').val(totalAmount());
                        $('#balance').val(balance());
                    }
                })
            })

            $('#itemCode5').change(function () {
                var itemId = $(this).val();
                var qty = $('#qty5').val();
                var dis = $('#discount5').val();
                $.ajax({
                    url: "{{ route('search.itemName') }}",
                    method: "POST",
                    data: {itemId: itemId, _token: _token},
                    success: function (result) {
                        $('#itemName5').html(result)
                    }
                })
                $.ajax({
                    url: "{{ route('search.others') }}",
                    method: "POST",
                    data: {customerId:customerId, itemId: itemId, _token: _token},
                    success: function (result) {
                        var discount = (result.unitPrice * qty) / 100 * dis;
                        $('#unit5').html(result.unit);
                        $('#units5').val(result.unit);
                        $('#unitPrice5').val(result.unitPrice);
                        $('#totalAmount5').val(result.unitPrice * qty - discount);
                        $('#salesAmount').val(salesTotal());
                        $('#totalAmount').val(totalAmount());
                        $('#balance').val(balance());
                    }
                })
            })

            $('#itemCode6').change(function () {
                var itemId = $(this).val();
                var qty = $('#qty6').val();
                var dis = $('#discount6').val();
                $.ajax({
                    url: "{{ route('search.itemName') }}",
                    method: "POST",
                    data: {itemId: itemId, _token: _token},
                    success: function (result) {
                        $('#itemName6').html(result)
                    }
                })
                $.ajax({
                    url: "{{ route('search.others') }}",
                    method: "POST",
                    data: {customerId:customerId, itemId: itemId, _token: _token},
                    success: function (result) {
                        var discount = (result.unitPrice * qty) / 100 * dis;
                        $('#unit6').html(result.unit);
                        $('#units6').val(result.unit);
                        $('#unitPrice6').val(result.unitPrice);
                        $('#totalAmount6').val(result.unitPrice * qty - discount);
                        $('#salesAmount').val(salesTotal());
                        $('#totalAmount').val(totalAmount());
                        $('#balance').val(balance());
                    }
                })
            })

            $('#itemCode7').change(function () {
                var itemId = $(this).val();
                var qty = $('#qty7').val();
                var dis = $('#discount7').val();
                $.ajax({
                    url: "{{ route('search.itemName') }}",
                    method: "POST",
                    data: {itemId: itemId, _token: _token},
                    success: function (result) {
                        $('#itemName7').html(result)
                    }
                })
                $.ajax({
                    url: "{{ route('search.others') }}",
                    method: "POST",
                    data: {customerId:customerId, itemId: itemId, _token: _token},
                    success: function (result) {
                        var discount = (result.unitPrice * qty) / 100 * dis;
                        $('#unit7').html(result.unit);
                        $('#units7').val(result.unit);
                        $('#unitPrice7').val(result.unitPrice);
                        $('#totalAmount7').val(result.unitPrice * qty - discount);
                        $('#salesAmount').val(salesTotal());
                        $('#totalAmount').val(totalAmount());
                        $('#balance').val(balance());
                    }
                })
            })

            $('#itemCode8').change(function () {
                var itemId = $(this).val();
                var qty = $('#qty8').val();
                var dis = $('#discount8').val();
                $.ajax({
                    url: "{{ route('search.itemName') }}",
                    method: "POST",
                    data: {itemId: itemId, _token: _token},
                    success: function (result) {
                        $('#itemName8').html(result)
                    }
                })
                $.ajax({
                    url: "{{ route('search.others') }}",
                    method: "POST",
                    data: {customerId:customerId, itemId: itemId, _token: _token},
                    success: function (result) {
                        var discount = (result.unitPrice * qty) / 100 * dis;
                        $('#unit8').html(result.unit);
                        $('#units9').val(result.unit);
                        $('#unitPrice8').val(result.unitPrice);
                        $('#totalAmount8').val(result.unitPrice * qty - discount);
                        $('#salesAmount').val(salesTotal());
                        $('#totalAmount').val(totalAmount());
                        $('#balance').val(balance());
                    }
                })
            })

            $('#itemCode9').change(function () {
                var itemId = $(this).val();
                var qty = $('#qty9').val();
                var dis = $('#discount9').val();
                $.ajax({
                    url: "{{ route('search.itemName') }}",
                    method: "POST",
                    data: {itemId: itemId, _token: _token},
                    success: function (result) {
                        $('#itemName9').html(result)
                    }
                })
                $.ajax({
                    url: "{{ route('search.others') }}",
                    method: "POST",
                    data: {customerId:customerId, itemId: itemId, _token: _token},
                    success: function (result) {
                        var discount = (result.unitPrice * qty) / 100 * dis;
                        $('#unit9').html(result.unit);
                        $('#units9').val(result.unit);
                        $('#unitPrice9').val(result.unitPrice);
                        $('#totalAmount9').val(result.unitPrice * qty - discount);
                        $('#salesAmount').val(salesTotal());
                        $('#totalAmount').val(totalAmount());
                        $('#balance').val(balance());
                    }
                })
            })

            $('#itemCode10').change(function () {
                var itemId = $(this).val();
                var qty = $('#qty10').val();
                var dis = $('#discount10').val();
                $.ajax({
                    url: "{{ route('search.itemName') }}",
                    method: "POST",
                    data: {itemId: itemId, _token: _token},
                    success: function (result) {
                        $('#itemName10').html(result)
                    }
                })
                $.ajax({
                    url: "{{ route('search.others') }}",
                    method: "POST",
                    data: {customerId:customerId, itemId: itemId, _token: _token},
                    success: function (result) {
                        var discount = (result.unitPrice * qty) / 100 * dis;
                        $('#unit10').html(result.unit);
                        $('#units10').val(result.unit);
                        $('#unitPrice10').val(result.unitPrice);
                        $('#totalAmount10').val(result.unitPrice * qty - discount);
                        $('#salesAmount').val(salesTotal());
                        $('#totalAmount').val(totalAmount());
                        $('#balance').val(balance());
                    }
                })
            })

            $('#itemName1').change(function () {
                var itemId = $(this).val();
                var qty = $('#qty1').val();
                var dis = $('#discount1').val();
                $.ajax({
                    url: "{{ route('search.itemCode') }}",
                    method: "POST",
                    data: {itemId: itemId, _token: _token},
                    success: function (result) {
                        $('#itemCode1').html(result)
                    }
                })
                $.ajax({
                    url: "{{ route('search.others') }}",
                    method: "POST",
                    data: {customerId:customerId, itemId: itemId, _token: _token},
                    success: function (result) {
                        var discount = (result.unitPrice * qty) / 100 * dis;
                        $('#unit1').html(result.unit);
                        $('#units1').val(result.unit);
                        $('#unitPrice1').val(result.unitPrice);
                        $('#totalAmount1').val(result.unitPrice * qty - discount);
                        $('#salesAmount').val(salesTotal());
                        $('#totalAmount').val(totalAmount());
                        $('#balance').val(balance());
                    }
                })
            })

            $('#itemName2').change(function () {
                var itemId = $(this).val();
                var qty = $('#qty2').val();
                var dis = $('#discount2').val();
                $.ajax({
                    url: "{{ route('search.itemCode') }}",
                    method: "POST",
                    data: {itemId: itemId, _token: _token},
                    success: function (result) {
                        $('#itemCode2').html(result)
                    }
                })
                $.ajax({
                    url: "{{ route('search.others') }}",
                    method: "POST",
                    data: {customerId:customerId, itemId: itemId, _token: _token},
                    success: function (result) {
                        var discount = (result.unitPrice * qty) / 100 * dis;
                        $('#unit2').html(result.unit);
                        $('#units2').val(result.unit);
                        $('#unitPrice2').val(result.unitPrice);
                        $('#totalAmount2').val(result.unitPrice * qty - discount);
                        $('#salesAmount').val(salesTotal());
                        $('#totalAmount').val(totalAmount());
                        $('#balance').val(balance());
                    }
                })
            })

            $('#itemName3').change(function () {
                var itemId = $(this).val();
                var qty = $('#qty3').val();
                var dis = $('#discount3').val();
                $.ajax({
                    url: "{{ route('search.itemCode') }}",
                    method: "POST",
                    data: {itemId: itemId, _token: _token},
                    success: function (result) {
                        $('#itemCode3').html(result)
                    }
                })
                $.ajax({
                    url: "{{ route('search.others') }}",
                    method: "POST",
                    data: {customerId:customerId, itemId: itemId, _token: _token},
                    success: function (result) {
                        var discount = (result.unitPrice * qty) / 100 * dis;
                        $('#unit3').html(result.unit);
                        $('#units3').val(result.unit);
                        $('#unitPrice3').val(result.unitPrice);
                        $('#totalAmount3').val(result.unitPrice * qty - discount);
                        $('#salesAmount').val(salesTotal());
                        $('#totalAmount').val(totalAmount());
                        $('#balance').val(balance());
                    }
                })
            })

            $('#itemName4').change(function () {
                var itemId = $(this).val();
                var qty = $('#qty4').val();
                var dis = $('#discount4').val();
                $.ajax({
                    url: "{{ route('search.itemCode') }}",
                    method: "POST",
                    data: {itemId: itemId, _token: _token},
                    success: function (result) {
                        $('#itemCode4').html(result)
                    }
                })
                $.ajax({
                    url: "{{ route('search.others') }}",
                    method: "POST",
                    data: {customerId:customerId, itemId: itemId, _token: _token},
                    success: function (result) {
                        var discount = (result.unitPrice * qty) / 100 * dis;
                        $('#unit4').html(result.unit);
                        $('#units4').val(result.unit);
                        $('#unitPrice4').val(result.unitPrice);
                        $('#totalAmount4').val(result.unitPrice * qty - discount);
                        $('#salesAmount').val(salesTotal());
                        $('#totalAmount').val(totalAmount());
                        $('#balance').val(balance());
                    }
                })
            })

            $('#itemName5').change(function () {
                var itemId = $(this).val();
                var qty = $('#qty5').val();
                var dis = $('#discount5').val();
                $.ajax({
                    url: "{{ route('search.itemCode') }}",
                    method: "POST",
                    data: {itemId: itemId, _token: _token},
                    success: function (result) {
                        $('#itemCode5').html(result)
                    }
                })
                $.ajax({
                    url: "{{ route('search.others') }}",
                    method: "POST",
                    data: {customerId:customerId, itemId: itemId, _token: _token},
                    success: function (result) {
                        var discount = (result.unitPrice * qty) / 100 * dis;
                        $('#unit5').html(result.unit);
                        $('#units5').val(result.unit);
                        $('#unitPrice5').val(result.unitPrice);
                        $('#totalAmount5').val(result.unitPrice * qty - discount);
                        $('#salesAmount').val(salesTotal());
                        $('#totalAmount').val(totalAmount());
                        $('#balance').val(balance());
                    }
                })
            })

            $('#itemName6').change(function () {
                var itemId = $(this).val();
                var qty = $('#qty6').val();
                var dis = $('#discount6').val();
                $.ajax({
                    url: "{{ route('search.itemCode') }}",
                    method: "POST",
                    data: {itemId: itemId, _token: _token},
                    success: function (result) {
                        $('#itemCode6').html(result)
                    }
                })
                $.ajax({
                    url: "{{ route('search.others') }}",
                    method: "POST",
                    data: {customerId:customerId, itemId: itemId, _token: _token},
                    success: function (result) {
                        var discount = (result.unitPrice * qty) / 100 * dis;
                        $('#unit6').html(result.unit);
                        $('#units6').val(result.unit);
                        $('#unitPrice6').val(result.unitPrice);
                        $('#totalAmount6').val(result.unitPrice * qty - discount);
                        $('#salesAmount').val(salesTotal());
                        $('#totalAmount').val(totalAmount());
                        $('#balance').val(balance());
                    }
                })
            })

            $('#itemName7').change(function () {
                var itemId = $(this).val();
                var qty = $('#qty7').val();
                var dis = $('#discount7').val();
                $.ajax({
                    url: "{{ route('search.itemCode') }}",
                    method: "POST",
                    data: {itemId: itemId, _token: _token},
                    success: function (result) {
                        $('#itemCode7').html(result)
                    }
                })
                $.ajax({
                    url: "{{ route('search.others') }}",
                    method: "POST",
                    data: {customerId:customerId, itemId: itemId, _token: _token},
                    success: function (result) {
                        var discount = (result.unitPrice * qty) / 100 * dis;
                        $('#unit7').html(result.unit);
                        $('#units7').val(result.unit);
                        $('#unitPrice7').val(result.unitPrice);
                        $('#totalAmount7').val(result.unitPrice * qty - discount);
                        $('#salesAmount').val(salesTotal());
                        $('#totalAmount').val(totalAmount());
                        $('#balance').val(balance());
                    }
                })
            })

            $('#itemName8').change(function () {
                var itemId = $(this).val();
                var qty = $('#qty8').val();
                var dis = $('#discount8').val();
                $.ajax({
                    url: "{{ route('search.itemCode') }}",
                    method: "POST",
                    data: {itemId: itemId, _token: _token},
                    success: function (result) {
                        $('#itemCode8').html(result)
                    }
                })
                $.ajax({
                    url: "{{ route('search.others') }}",
                    method: "POST",
                    data: {customerId:customerId, itemId: itemId, _token: _token},
                    success: function (result) {
                        var discount = (result.unitPrice * qty) / 100 * dis;
                        $('#unit8').html(result.unit);
                        $('#units8').val(result.unit);
                        $('#unitPrice8').val(result.unitPrice);
                        $('#totalAmount8').val(result.unitPrice * qty - discount);
                        $('#salesAmount').val(salesTotal());
                        $('#totalAmount').val(totalAmount());
                        $('#balance').val(balance());
                    }
                })
            })

            $('#itemName9').change(function () {
                var itemId = $(this).val();
                var qty = $('#qty9').val();
                var dis = $('#discount9').val();
                $.ajax({
                    url: "{{ route('search.itemCode') }}",
                    method: "POST",
                    data: {itemId: itemId, _token: _token},
                    success: function (result) {
                        $('#itemCode9').html(result)
                    }
                })
                $.ajax({
                    url: "{{ route('search.others') }}",
                    method: "POST",
                    data: {customerId:customerId, itemId: itemId, _token: _token},
                    success: function (result) {
                        var discount = (result.unitPrice * qty) / 100 * dis;
                        $('#unit9').html(result.unit);
                        $('#units9').val(result.unit);
                        $('#unitPrice9').val(result.unitPrice);
                        $('#totalAmount9').val(result.unitPrice * qty - discount);
                        $('#salesAmount').val(salesTotal());
                        $('#totalAmount').val(totalAmount());
                        $('#balance').val(balance());
                    }
                })
            })

            $('#itemName10').change(function () {
                var itemId = $(this).val();
                var qty = $('#qty10').val();
                var dis = $('#discount10').val();
                $.ajax({
                    url: "{{ route('search.itemCode') }}",
                    method: "POST",
                    data: {itemId: itemId, _token: _token},
                    success: function (result) {
                        $('#itemCode10').html(result)
                    }
                })
                $.ajax({
                    url: "{{ route('search.others') }}",
                    method: "POST",
                    data: {customerId:customerId, itemId: itemId, _token: _token},
                    success: function (result) {
                        var discount = (result.unitPrice * qty) / 100 * dis;
                        $('#unit10').html(result.unit);
                        $('#units10').val(result.unit);
                        $('#unitPrice10').val(result.unitPrice);
                        $('#totalAmount10').val(result.unitPrice * qty - discount);
                        $('#salesAmount').val(salesTotal());
                        $('#totalAmount').val(totalAmount());
                        $('#balance').val(balance());
                    }
                })
            })


            $('#qty1').change(function () {
                var qty=$(this).val();
                var price=$('#unitPrice1').val();
                var dis=$('#discount1').val();
                $('#totalAmount1').val(amount(qty,price,dis));
                $('#salesAmount').val(salesTotal());
                $('#totalAmount').val(totalAmount());
                $('#balance').val(balance());
            })

            $('#qty2').change(function () {
                var qty=$(this).val();
                var price=$('#unitPrice2').val();
                var dis=$('#discount2').val();
                $('#totalAmount2').val(amount(qty,price,dis));
                $('#salesAmount').val(salesTotal());
                $('#totalAmount').val(totalAmount());
                $('#balance').val(balance());
            })

            $('#qty3').change(function () {
                var qty=$(this).val();
                var price=$('#unitPrice3').val();
                var dis=$('#discount3').val();
                $('#totalAmount3').val(amount(qty,price,dis));
                $('#salesAmount').val(salesTotal());
                $('#totalAmount').val(totalAmount());
                $('#balance').val(balance());
            })

            $('#qty4').change(function () {
                var qty=$(this).val();
                var price=$('#unitPrice4').val();
                var dis=$('#discount4').val();
                $('#totalAmount4').val(amount(qty,price,dis));
                $('#salesAmount').val(salesTotal());
                $('#totalAmount').val(totalAmount());
                $('#balance').val(balance());
            })

            $('#qty5').change(function () {
                var qty=$(this).val();
                var price=$('#unitPrice5').val();
                var dis=$('#discount5').val();
                $('#totalAmount5').val(amount(qty,price,dis));
                $('#salesAmount').val(salesTotal());
                $('#totalAmount').val(totalAmount());
                $('#balance').val(balance());
            })

            $('#qty6').change(function () {
                var qty=$(this).val();
                var price=$('#unitPrice6').val();
                var dis=$('#discount6').val();
                $('#totalAmount6').val(amount(qty,price,dis));
                $('#salesAmount').val(salesTotal());
                $('#totalAmount').val(totalAmount());
                $('#balance').val(balance());
            })

            $('#qty7').change(function () {
                var qty=$(this).val();
                var price=$('#unitPrice7').val();
                var dis=$('#discount7').val();
                $('#totalAmount7').val(amount(qty,price,dis));
                $('#salesAmount').val(salesTotal());
                $('#totalAmount').val(totalAmount());
                $('#balance').val(balance());
            })

            $('#qty8').change(function () {
                var qty=$(this).val();
                var price=$('#unitPrice8').val();
                var dis=$('#discount8').val();
                $('#totalAmount8').val(amount(qty,price,dis));
                $('#salesAmount').val(salesTotal());
                $('#totalAmount').val(totalAmount());
                $('#balance').val(balance());
            })

            $('#qty9').change(function () {
                var qty=$(this).val();
                var price=$('#unitPrice9').val();
                var dis=$('#discount9').val();
                $('#totalAmount9').val(amount(qty,price,dis));
                $('#salesAmount').val(salesTotal());
                $('#totalAmount').val(totalAmount());
                $('#balance').val(balance());
            })

            $('#qty10').change(function () {
                var qty=$(this).val();
                var price=$('#unitPrice10').val();
                var dis=$('#discount10').val();
                $('#totalAmount10').val(amount(qty,price,dis));
                $('#salesAmount').val(salesTotal());
                $('#totalAmount').val(totalAmount());
                $('#balance').val(balance());
            })

            $('#unitPrice1').change(function () {
                var qty=$('#qty1').val();
                var price=$(this).val();
                var dis=$('#discount1').val();
                $('#totalAmount1').val(amount(qty,price,dis));
                $('#salesAmount').val(salesTotal());
                $('#totalAmount').val(totalAmount());
                $('#balance').val(balance());
            })

            $('#unitPrice2').change(function () {
                var qty=$('#qty2').val();
                var price=$(this).val();
                var dis=$('#discount2').val();
                $('#totalAmount2').val(amount(qty,price,dis));
                $('#salesAmount').val(salesTotal());
                $('#totalAmount').val(totalAmount());
                $('#balance').val(balance());
            })

            $('#unitPrice3').change(function () {
                var qty=$('#qty3').val();
                var price=$(this).val();
                var dis=$('#discount3').val();
                $('#totalAmount3').val(amount(qty,price,dis));
                $('#salesAmount').val(salesTotal());
                $('#totalAmount').val(totalAmount());
                $('#balance').val(balance());
            })

            $('#unitPrice4').change(function () {
                var qty=$('#qty4').val();
                var price=$(this).val();
                var dis=$('#discount4').val();
                $('#totalAmount4').val(amount(qty,price,dis));
                $('#salesAmount').val(salesTotal());
                $('#totalAmount').val(totalAmount());
                $('#balance').val(balance());
            })

            $('#unitPrice5').change(function () {
                var qty=$('#qty5').val();
                var price=$(this).val();
                var dis=$('#discount5').val();
                $('#totalAmount5').val(amount(qty,price,dis));
                $('#salesAmount').val(salesTotal());
                $('#totalAmount').val(totalAmount());
                $('#balance').val(balance());
            })

            $('#unitPrice6').change(function () {
                var qty=$('#qty6').val();
                var price=$(this).val();
                var dis=$('#discount6').val();
                $('#totalAmount6').val(amount(qty,price,dis));
                $('#salesAmount').val(salesTotal());
                $('#totalAmount').val(totalAmount());
                $('#balance').val(balance());
            })

            $('#unitPrice7').change(function () {
                var qty=$('#qty7').val();
                var price=$(this).val();
                var dis=$('#discount7').val();
                $('#totalAmount7').val(amount(qty,price,dis));
                $('#salesAmount').val(salesTotal());
                $('#totalAmount').val(totalAmount());
                $('#balance').val(balance());
            })

            $('#unitPrice8').change(function () {
                var qty=$('#qty8').val();
                var price=$(this).val();
                var dis=$('#discount8').val();
                $('#totalAmount8').val(amount(qty,price,dis));
                $('#salesAmount').val(salesTotal());
                $('#totalAmount').val(totalAmount());
                $('#balance').val(balance());
            })

            $('#unitPrice9').change(function () {
                var qty=$('#qty9').val();
                var price=$(this).val();
                var dis=$('#discount9').val();
                $('#totalAmount9').val(amount(qty,price,dis));
                $('#salesAmount').val(salesTotal());
                $('#totalAmount').val(totalAmount());
                $('#balance').val(balance());
            })

            $('#unitPrice10').change(function () {
                var qty=$('#qty10').val();
                var price=$(this).val();
                var dis=$('#discount10').val();
                $('#totalAmount10').val(amount(qty,price,dis));
                $('#salesAmount').val(salesTotal());
                $('#totalAmount').val(totalAmount());
                $('#balance').val(balance());
            })

            $('#discount1').change(function () {
                var qty=$('#qty1').val();
                var price=$('#unitPrice1').val();
                var dis=$(this).val();
                $('#totalAmount1').val(amount(qty,price,dis));
                $('#salesAmount').val(salesTotal());
                $('#totalAmount').val(totalAmount());
                $('#balance').val(balance());
            })

            $('#discount2').change(function () {
                var qty=$('#qty2').val();
                var price=$('#unitPrice2').val();
                var dis=$(this).val();
                $('#totalAmount2').val(amount(qty,price,dis));
                $('#salesAmount').val(salesTotal());
                $('#totalAmount').val(totalAmount());
                $('#balance').val(balance());
            })

            $('#discount3').change(function () {
                var qty=$('#qty3').val();
                var price=$('#unitPrice3').val();
                var dis=$(this).val();
                $('#totalAmount3').val(amount(qty,price,dis));
                $('#salesAmount').val(salesTotal());
                $('#totalAmount').val(totalAmount());
                $('#balance').val(balance());
            })

            $('#discount4').change(function () {
                var qty=$('#qty4').val();
                var price=$('#unitPrice4').val();
                var dis=$(this).val();
                $('#totalAmount4').val(amount(qty,price,dis));
                $('#salesAmount').val(salesTotal());
                $('#totalAmount').val(totalAmount());
                $('#balance').val(balance());
            })

            $('#discount5').change(function () {
                var qty=$('#qty5').val();
                var price=$('#unitPrice5').val();
                var dis=$(this).val();
                $('#totalAmount5').val(amount(qty,price,dis));
                $('#salesAmount').val(salesTotal());
                $('#totalAmount').val(totalAmount());
                $('#balance').val(balance());
            })

            $('#discount6').change(function () {
                var qty=$('#qty6').val();
                var price=$('#unitPrice6').val();
                var dis=$(this).val();
                $('#totalAmount6').val(amount(qty,price,dis));
                $('#salesAmount').val(salesTotal());
                $('#totalAmount').val(totalAmount());
                $('#balance').val(balance());
            })

            $('#discount7').change(function () {
                var qty=$('#qty7').val();
                var price=$('#unitPrice7').val();
                var dis=$(this).val();
                $('#totalAmount7').val(amount(qty,price,dis));
                $('#salesAmount').val(salesTotal());
                $('#totalAmount').val(totalAmount());
                $('#balance').val(balance());
            })

            $('#discount8').change(function () {
                var qty=$('#qty8').val();
                var price=$('#unitPrice8').val();
                var dis=$(this).val();
                $('#totalAmount8').val(amount(qty,price,dis));
                $('#salesAmount').val(salesTotal());
                $('#totalAmount').val(totalAmount());
                $('#balance').val(balance());
            })

            $('#discount9').change(function () {
                var qty=$('#qty9').val();
                var price=$('#unitPrice9').val();
                var dis=$(this).val();
                $('#totalAmount9').val(amount(qty,price,dis));
                $('#salesAmount').val(salesTotal());
                $('#totalAmount').val(totalAmount());
                $('#balance').val(balance());
            })

            $('#discount10').change(function () {
                var qty=$('#qty10').val();
                var price=$('#unitPrice10').val();
                var dis=$(this).val();
                $('#totalAmount10').val(amount(qty,price,dis));
                $('#salesAmount').val(salesTotal());
                $('#totalAmount').val(totalAmount());
                $('#balance').val(balance());
            })

            $('#vat').change(function () {
                var salesAmount=parseFloat($('#salesAmount').val()); if (isNaN(salesAmount)){salesAmount=0;}
                var vat=parseFloat($(this).val());
                var others=parseFloat($('#others').val()); if (isNaN(others)){others=0;}
                var advance=parseFloat($('#advance').val()); if (isNaN(advance)){advance=0;}
                $('#totalAmount').val(vat+salesAmount+others);
                $('#balance').val(vat+salesAmount+others-advance);
            })

            $('#others').change(function () {
                var salesAmount=parseFloat($('#salesAmount').val()); if (isNaN(salesAmount)){salesAmount=0;}
                var vat=parseFloat($('#vat').val()); if (isNaN(vat)){vat=0;}
                var others=parseFloat($(this).val());
                var advance=parseFloat($('#advance').val()); if (isNaN(advance)){advance=0;}
                $('#totalAmount').val(vat+salesAmount+others);
                $('#balance').val(vat+salesAmount+others-advance);
            })

            $('#advance').change(function () {
                var salesAmount=parseFloat($('#salesAmount').val()); if (isNaN(salesAmount)){salesAmount=0;}
                var vat=parseFloat($('#vat').val()); if (isNaN(vat)){vat=0;}
                var others=parseFloat($('#others').val()); if (isNaN(others)){others=0;}
                var advance=parseFloat($(this).val());
                $('#totalAmount').val(vat+salesAmount+others);
                $('#balance').val(vat+salesAmount+others-advance);
            })

            function amount(qty,price,dis) {
                if(dis>0) {return price * qty - ((price * qty) / 100 * dis);}
                else{return price * qty;}
            }

            function salesTotal() {
                var total=0;
                var total1 = parseFloat($('#totalAmount1').val()); if(isNaN(total1)){total1=0;}
                var total2 = parseFloat($('#totalAmount2').val()); if(isNaN(total2)){total2=0;}
                var total3 = parseFloat($('#totalAmount3').val()); if(isNaN(total3)){total3=0;}
                var total4 = parseFloat($('#totalAmount4').val()); if(isNaN(total4)){total4=0;}
                var total5 = parseFloat($('#totalAmount5').val()); if(isNaN(total5)){total5=0;}
                var total6 = parseFloat($('#totalAmount6').val()); if(isNaN(total6)){total6=0;}
                var total7 = parseFloat($('#totalAmount7').val()); if(isNaN(total7)){total7=0;}
                var total8 = parseFloat($('#totalAmount8').val()); if(isNaN(total8)){total8=0;}
                var total9 = parseFloat($('#totalAmount9').val()); if(isNaN(total9)){total9=0;}
                var total10 = parseFloat($('#totalAmount10').val()); if(isNaN(total10)){total10=0;}
                total = total1 + total2 + total3 + total4 + total5 + total6 + total7 + total8 + total9 + total10;
                return total;
            }

            function totalAmount() {
                var salesAmount=parseFloat($('#salesAmount').val()); if (isNaN(salesAmount)){salesAmount=0;}
                var vat=parseFloat($('#vat').val()); if (isNaN(vat)){vat=0;}
                var others=parseFloat($('#others').val()); if (isNaN(others)){others=0;}
                return salesAmount+vat+others;
            }

            function balance() {
                var totalAmount=parseFloat($('#totalAmount').val()); if (isNaN(totalAmount)){totalAmount=0;}
                var advance=parseFloat($('#advance').val()); if (isNaN(advance)){advance=0;}
                return totalAmount-advance;
            }

        });
    </script>
@endsection
