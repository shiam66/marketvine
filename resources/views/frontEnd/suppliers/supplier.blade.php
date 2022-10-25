@extends('frontEnd.master')

@section('title') Supplier Info @endsection

@section('mainContent')

    <?php
        $active ='supplier';
        $mainActive ='';
    ?>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h4 mb-0 text-gray-800">Supplier Info</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-2">
                    <h6 class="m-0 font-weight-bold text-primary">Add Supplier Info</h6>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Supplier Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="customerName" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Supplier Email</label>
                                    <div class="col-sm-8">
                                        <input type="email" name="email" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Address</label>
                                    <div class="col-sm-8">
                                        <textarea name="address" rows="2" class="form-control"></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Origin</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="origin" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Status</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="status">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-7">
                                <div class="form-group form-row">
                                    <label class="col-sm-2 col-form-label">Contact Person: 1</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="customerName" class="form-control" placeholder="Contact Person">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" name="customerName" class="form-control" placeholder="Designation">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" name="customerName" class="form-control" placeholder="Mobile">
                                    </div>
                                </div>

                                <div class="form-group form-row">
                                    <label class="col-sm-2 col-form-label">Contact Person: 2</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="customerName" class="form-control" placeholder="Contact Person">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" name="customerName" class="form-control" placeholder="Designation">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" name="customerName" class="form-control" placeholder="Mobile">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <center>
                            <button type="submit" class="btn btn-primary">Save Info</button>
                        </center>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Manage Supplier</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Customer Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Status</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>$320,800</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
