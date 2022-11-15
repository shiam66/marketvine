@extends('frontEnd.master')

@section('title') Customer Info @endsection

@section('mainContent')

    <?php
        $active ='customer';
        $mainActive ='';
    ?>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h4 mb-0 text-gray-800">Customer Info</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-2">
                    <h6 class="m-0 font-weight-bold text-primary">Add/Update Customer Info</h6>
                </div>
                <div class="card-body">
                    <form name="frmcontent" action="{{ url('/customerInfo/create') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if($customerById!=null)
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Customer Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="customerName" value="{{ $customerById->customerName }}" class="form-control" required>
                                            <input type="hidden" name="customerId" value="{{ $customerById->id }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Customer Email</label>
                                        <div class="col-sm-8">
                                            <input type="email" name="customerEmail" value="{{ $customerById->customerEmail }}" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Bill to</label>
                                        <div class="col-sm-8">
                                            <textarea name="billTo" rows="2" class="form-control" required>{{ $customerById->billTo }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Ship to</label>
                                        <div class="col-sm-8">
                                            <textarea name="shipTo" rows="2" class="form-control" required>{{ $customerById->shipTo }}</textarea>
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
                                        <label class="col-sm-2 col-form-label">Bill To Contact:</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="contact1Name" value="{{ $customerById->contact1Name }}" class="form-control" placeholder="Name" required>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" name="contact1Designation" value="{{ $customerById->contact1Designation }}" class="form-control" placeholder="Designation" required>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" name="contact1Mobile" value="{{ $customerById->contact1Mobile }}" class="form-control" placeholder="Mobile" required>
                                        </div>
                                    </div>

                                    <div class="form-group form-row">
                                        <label class="col-sm-2 col-form-label">Ship To Contact:</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="contact2Name" value="{{ $customerById->contact2Name }}" class="form-control" placeholder="Name">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" name="contact2Designation" value="{{ $customerById->contact2Designation }}" class="form-control" placeholder="Designation">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" name="contact2Mobile" value="{{ $customerById->contact2Mobile }}" class="form-control" placeholder="Mobile">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <center>
                                <button type="submit" class="btn btn-primary">Update Info</button>
                            </center>
                        @else
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Customer Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="customerName" class="form-control" required>
                                            <input type="hidden" name="customerId" value="0">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Customer Email</label>
                                        <div class="col-sm-8">
                                            <input type="email" name="customerEmail" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Bill to</label>
                                        <div class="col-sm-8">
                                            <textarea name="billTo" rows="2" class="form-control" required></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Ship to</label>
                                        <div class="col-sm-8">
                                            <textarea name="shipTo" rows="2" class="form-control" required></textarea>
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
                                        <label class="col-sm-2 col-form-label">Bill To Contact:</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="contact1Name" class="form-control" placeholder="Name" required>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" name="contact1Designation" class="form-control" placeholder="Designation" required>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" name="contact1Mobile" class="form-control" placeholder="Mobile" required>
                                        </div>
                                    </div>

                                    <div class="form-group form-row">
                                        <label class="col-sm-2 col-form-label">Ship To Contact:</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="contact2Name" class="form-control" placeholder="Name">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" name="contact2Designation" class="form-control" placeholder="Designation">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" name="contact2Mobile" class="form-control" placeholder="Mobile">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <center>
                                <button type="submit" class="btn btn-primary">Add New Info</button>
                            </center>
                        @endif

                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Manage Customer</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>SL No.</th>
                                <th>Customer Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>SL No.</th>
                                <th>Customer Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        @foreach($customer as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->customerName }}</td>
                                <td>{{ $item->customerEmail }}</td>
                                <td>
                                    @if($item->status==1)
                                    <span class="badge badge-success">Active</span>
                                    @else
                                    <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('/customerInfo/'.$item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>

@endsection
