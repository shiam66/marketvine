@extends('frontEnd.master')

@section('title') Purchases Info @endsection

@section('css')
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
    </style>
@endsection

@section('mainContent')

    <?php
        $active ='purchases';
        $mainActive ='';
    ?>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h4 mb-0 text-gray-800">Purchases</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-2">
                    <h6 class="m-0 font-weight-bold text-primary">Purchases New Item</h6>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-sm-4 offset-sm-1">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label col-form-label-sm text-right">Type:</label>
                                    <div class="col-sm-8">
                                        <select class="form-control form-control-sm" name="customer">
                                            <option value="QUOTE">QUOTE</option>
                                            <option value="ORDER">ORDER</option>
                                            <option value="INVOICE">BILL</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label col-form-label-sm text-right">Customer:</label>
                                    <div class="col-sm-8">
                                        <select class="form-control form-control-sm" name="customer">
                                            <option value="A.T. Haque Limited">A.T. Haque Limited</option>
                                            <option value="A.T. Haque Limited">A.T. Haque Limited</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label col-form-label-sm text-right">Ship to:</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control form-control-sm" rows="1.5"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 offset-sm-1">
                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label col-form-label-sm text-right">Invoice #:</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control form-control-sm">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label col-form-label-sm text-right">Date:</label>
                                    <div class="col-sm-7">
                                        <input type="date" class="form-control form-control-sm">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label col-form-label-sm text-right">Customer PO #:</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <table class="table table-sm table-bordered table-striped">
                                    <thead class="bg-info text-white">
                                    <tr>
                                        <th style="text-align: center; width: 15%;">Item Code</th>
                                        <th style="text-align: center; width: 30%;">Item Name</th>
                                        <th style="text-align: center; width: 10%;">Qty</th>
                                        <th style="text-align: center; width: 10%;">Unit</th>
                                        <th style="text-align: center; width: 15%;">Unit Price</th>
                                        <th style="text-align: center; width: 5%;">Disc%</th>
                                        <th style="text-align: center; width: 15%;">Amount</th>
                                    </tr>
                                    </thead>

                                    <tbody class="sales_sm_field">
                                    <tr>
                                        <td><input type="text" name="itemCode" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="itemName" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="qty" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="unit" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="unitPrice" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="discount" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="totalAmount" class="form-control form-control-sm"></td>
                                    </tr>

                                    <tr>
                                        <td><input type="text" name="itemCode" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="itemName" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="qty" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="unit" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="unitPrice" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="discount" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="totalAmount" class="form-control form-control-sm"></td>
                                    </tr>

                                    <tr>
                                        <td><input type="text" name="itemCode" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="itemName" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="qty" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="unit" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="unitPrice" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="discount" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="totalAmount" class="form-control form-control-sm"></td>
                                    </tr>

                                    <tr>
                                        <td><input type="text" name="itemCode" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="itemName" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="qty" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="unit" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="unitPrice" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="discount" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="totalAmount" class="form-control form-control-sm"></td>
                                    </tr>

                                    <tr>
                                        <td><input type="text" name="itemCode" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="itemName" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="qty" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="unit" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="unitPrice" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="discount" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="totalAmount" class="form-control form-control-sm"></td>
                                    </tr>

                                    <tr>
                                        <td><input type="text" name="itemCode" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="itemName" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="qty" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="unit" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="unitPrice" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="discount" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="totalAmount" class="form-control form-control-sm"></td>
                                    </tr>

                                    <tr>
                                        <td><input type="text" name="itemCode" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="itemName" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="qty" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="unit" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="unitPrice" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="discount" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="totalAmount" class="form-control form-control-sm"></td>
                                    </tr>

                                    <tr>
                                        <td><input type="text" name="itemCode" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="itemName" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="qty" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="unit" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="unitPrice" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="discount" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="totalAmount" class="form-control form-control-sm"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4 offset-sm-1">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label col-form-label-sm text-right">Notes:</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control form-control-sm" rows="2"></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label col-form-label-sm text-right">In Word:</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control form-control-sm" rows="2"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 offset-sm-3">
                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label col-form-label-sm text-right">Sales Amount:</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control form-control-sm">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label col-form-label-sm text-right">Vat:</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control form-control-sm">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label col-form-label-sm text-right">Others:</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control form-control-sm">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label col-form-label-sm text-right">Total Amount:</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control form-control-sm">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label col-form-label-sm text-right">Advance:</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control form-control-sm">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label col-form-label-sm text-right">Payment Method:</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control form-control-sm">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label col-form-label-sm text-right">Balance Due:</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <center>
                                    <button type="submit" class="btn btn-primary">Print</button>
                                    <button type="submit" class="btn btn-primary">Reimburse</button>
                                    <button type="submit" class="btn btn-primary">Receive Payment</button>
                                    <button type="submit" class="btn btn-primary">Record</button>
                                    <button type="reset" class="btn btn-danger">Cancel</button>
                                </center>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
