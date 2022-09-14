@extends('frontEnd.master')

@section('title') Products @endsection

@section('mainContent')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h4 mb-0 text-gray-800">Products</h1>
    </div>

    <!-- Content Row -->

    <form name="frmcontent" action="{{ url('/product/create') }}" method="post" enctype="multipart/form-data">
        @csrf
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-2">
                    <h6 class="m-0 font-weight-bold text-primary">Product Info</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            @if($productById!=null)
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Product Number</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="productNumber" value="{{ $productById->productNumber }}" class="form-control" required>
                                        <input type="hidden" name="productId" value="{{ $productById->id }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Product Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="productName" value="{{ $productById->productName }}" class="form-control" required>
                                    </div>
                                </div>
                            @else
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Product Number</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="productNumber" class="form-control" required>
                                        <input type="hidden" name="productId" value="0">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Product Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="productName" class="form-control" required>
                                    </div>
                                </div>
                            @endif

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Status</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="status">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group form-row">
                                <div class="col-sm-6">
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="btn1" disabled>
                                        <label class="form-check-label" for="btn1">I Buy This Item</label>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="btn2" disabled>
                                        <label class="form-check-label" for="btn2">I Sell This Item</label>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="btn3" disabled>
                                        <label class="form-check-label" for="btn3">I Inventory This Item</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Quantity on Hand</label>
                                <div class="col-sm-8">
                                    <input type="text" name="lastCost" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Current Value</label>
                                <div class="col-sm-8">
                                    <input type="text" name="lastSellPrice" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Average Cost</label>
                                <div class="col-sm-8">
                                    <input type="text" name="lastSellPrice" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Asset Account for Item Inventory</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="assetAccount" disabled>
                                        <option value="1">Code - 1-1350</option>
                                        <option value="0">Code - 1-1350</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header py-2">
                    <h6 class="m-0 font-weight-bold text-primary">Buying Details - </h6>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-7 col-form-label">Last Purchase Price:</label>
                        <div class="col-sm-5">
                            <input type="text" name="lastPurchase" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-7 col-form-label">Buying Unit of Measure:</label>
                        <div class="col-sm-5">
                            <input type="text" name="buyingUnit" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-7 col-form-label">Number of Items per Buying Unit:</label>
                        <div class="col-sm-5">
                            <input type="text" name="numOfItemBuyingUnit" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-7 col-form-label">Minimum Restocking Alert:</label>
                        <div class="col-sm-5">
                            <input type="text" name="numOfItemBuyingUnit" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-7 col-form-label">Default Reorder Quantity:</label>
                        <div class="col-sm-5">
                            <input type="text" name="numOfItemBuyingUnit" class="form-control" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($productById!=null)
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header py-2">
                        <h6 class="m-0 font-weight-bold text-primary">Selling Details - </h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-6 col-form-label">Base Selling Price:</label>
                            <div class="col-sm-6">
                                <input type="text" name="sellingPrice" value="{{ $productById->sellingPrice }}" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-6 col-form-label">Selling Unit of Measure:</label>
                            <div class="col-sm-6">
                                <input type="text" name="sellingUnit" value="{{ $productById->sellingUnit }}" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <center>
                                <button type="submit" class="btn btn-primary">Update Info</button>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header py-2">
                        <h6 class="m-0 font-weight-bold text-primary">Selling Details - </h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-6 col-form-label">Base Selling Price:</label>
                            <div class="col-sm-6">
                                <input type="text" name="sellingPrice" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-6 col-form-label">Selling Unit of Measure:</label>
                            <div class="col-sm-6">
                                <input type="text" name="sellingUnit" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <center>
                                <button type="submit" class="btn btn-primary">Save Info</button>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    </form>

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-2">
                    <h6 class="m-0 font-weight-bold text-primary">Manage Product</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Product Number</th>
                                <th>Product Name</th>
                                <th>Selling Price</th>
                                <th>Unit</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>SL</th>
                                <th>Product Number</th>
                                <th>Product Name</th>
                                <th>Selling Price</th>
                                <th>Unit</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($product as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->productNumber}}</td>
                                    <td>{{$item->productName}}</td>
                                    <td>{{$item->sellingPrice}}</td>
                                    <td>{{$item->sellingUnit}}</td>
                                    <td>@if($item->status==1) Active @else Inactive @endif</td>
                                    <td>
                                        <a href="{{ url('/product/'.$item->id) }}" class="btn btn-primary btn-sm">Edit</a>
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
