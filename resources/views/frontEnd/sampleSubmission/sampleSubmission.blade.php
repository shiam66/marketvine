@extends('frontEnd.master')

@section('title') Sample Submission @endsection


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
        $active ='sample_submission';
        $mainActive ='sales';
    ?>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h4 mb-0 text-gray-800">Sample Submission</h1>
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
                                <h6 class="m-0 font-weight-bold text-primary">Sample Submission New Item</h6>
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

                                        </select>
                                        <span class="text-danger">{{  $errors->has('customerId') ? $errors->first('customerId'): '' }}</span>
                                    </div>
                                </div>

                                <div class="form-group row">

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
                                        <th style="text-align: center; width: 10%;">Item Code</th>
                                        <th style="text-align: center; width: 20%;">Item Name</th>
                                        <th style="text-align: center; width: 10%;">Supplier</th>
                                        <th style="text-align: center; width: 10%;">Origin</th>
                                        <th style="text-align: center; width: 5%;">Qty</th>
                                        <th style="text-align: center; width: 5%;">Unit</th>
                                        <th style="text-align: center; width: 10%;">For</th>
                                        <th style="text-align: center; width: 15%;">Remarks</th>
                                        <th style="text-align: center; width: 15%;">Final Result</th>
                                    </tr>
                                    </thead>

                                    <tbody class="sales_sm_field">
                                        <td>
                                            <select class="form-control form-control-sm select2" id="itemCode" name="itemCode">
                                                <option value="">Select Code</option>
                                                <option value="">011</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control form-control-sm select2" id="itemName" name="itemName">
                                                <option value="">Select Item Name</option>
                                                <option value="01">011</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control form-control-sm select2" id="itemCode" name="itemCode">
                                                <option value="">Select Supplier</option>
                                                <option value="">Supplier</option>
                                            </select>
                                        </td>
                                        <td>India</td>
                                        <td>100</td>
                                        <td>gm</td>
                                        <td>
                                            <input type="text" id="totalAmount" name="totalAmount" class="form-control form-control-sm">
                                        </td>
                                        <td>
                                            <input type="text" id="totalAmount" name="totalAmount" class="form-control form-control-sm" readonly>
                                        </td>
                                        <td>
                                            <select class="form-control form-control-sm select2" id="itemCode" name="itemCode" readonly="">
                                                <option value="">Final Result</option>
                                                <option value="">Approve</option>
                                                <option value="">Reject</option>
                                                <option value="">Modified</option>
                                            </select>
                                        </td>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label col-form-label-sm text-right">Additional Notes:</label>
                                    <div class="col-sm-8">
                                        <textarea name="notes" class="form-control form-control-sm" rows="2"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 offset-sm-3">

                            </div>
                        </div>

                        <div class="row" style="padding-top: 15px;">
                            <div class="col-md-12">
                                <center>
                                    <a href="" class="btn btn-sm btn-primary">Print</a>
                                    <button type="submit" class="btn btn-sm btn-primary">Record</button>
                                    <button type="reset" class="btn btn-sm btn-danger">Cancel</button>
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
                        <div class="col-md-6">
                            <h6 class="m-0 font-weight-bold text-primary">Todays Sample Submission Entry</h6>
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
                                    <tr>
                                        <td class="text-center">{{0 }}</td>
                                        <td class="text-left"><span></span></td>
                                        <td class="text-left"><span></span></td>
                                        <td class="text-left"><span></span></td>
                                        <td class="text-right"><span></span></td>
                                        <td class="text-right"><span></span></td>
                                        <td class="text-center"><span>Order</span></td>
                                        <td class="text-center">

                                                <a href="{{ url('/sales-edit/') }}" target="_blank" class="btn btn-primary btn-sm">Edit</a>

                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td class="bg-info"></td>
                                    <td class="bg-info"></td>
                                    <td class="bg-info"></td>
                                    <td class="bg-info"></td>
                                    <td class="bg-info text-white text-right"><span>{{ 0 }}</span></td>
                                    <td class="bg-info text-white text-right"><span>{{ 0 }}</span></td>
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
@endsection
