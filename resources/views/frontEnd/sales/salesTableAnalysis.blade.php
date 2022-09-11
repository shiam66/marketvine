@extends('frontEnd.master')

@section('title') Sales Table Analysis @endsection

<style>
    .form-control-sm {
        padding: 0px !important;
    }
    .table-sm td, .table-sm th {
        padding: 2px !important;
    }
    .table td, .table th {
        vertical-align: middle !important;
    }
    .table td .sw_text{
        text-align: right !important;
        display: block;
    }
    .table-sm .sw_text{
        font-size: 12px;
    }

</style>

@section('mainContent')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h4 mb-0 text-gray-800">Sales Table Analysis</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
{{--                <div class="card-header py-2">--}}
{{--                    <h6 class="m-0 font-weight-bold text-primary">Sales Table</h6>--}}
{{--                </div>--}}
                <div class="card-body">
                    <form name="frmcontent" action="{{ url('/sales-table-analysis') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-sm-4 offset-sm-4">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Sales Year</label>
                                <div class="col-sm-8">
                                    <div class="col-sm-8">
                                        <select class="form-control" id="sYear" name="sYear">
                                            <option value="option_select" disabled selected>Select Year</option>
                                            @foreach($salesYears as $salesYear)
                                                <option value="{{ $salesYear->salesyear }}">{{ $salesYear->salesyear }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <table class="table table-sm table-bordered table-striped">
                                    <thead class="bg-info text-white">
                                    <tr>
                                        <th style="width: 190px;">Sales</th>
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
                                    </tr>
                                    </thead>

                                    <tbody id="tableData">
                                    <tr>
                                        <td><b>This month sales Tar</b></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                    </tr>

                                    <tr>
                                        <td><b>This month sales Achv</b></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                    </tr>

                                    <tr>
                                        <td><b>This moth Achv %</b></td>
                                        <td class="bg-gradient-danger text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-success text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-warning text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-info text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-primary text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-danger text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-success text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-warning text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-info text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-primary text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-danger text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-success text-white"><span class="sw_text">0%</span></td>
                                    </tr>

                                    <tr>
                                        <td><b>Cum. Sales target</b></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                    </tr>

                                    <tr>
                                        <td><b>Cum. Sales achv</b></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                    </tr>

                                    <tr>
                                        <td><b>Cum. Sales achv %</b></td>
                                        <td class="bg-gradient-danger text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-success text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-warning text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-info text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-primary text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-danger text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-success text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-warning text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-info text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-primary text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-danger text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-success text-white"><span class="sw_text">0%</span></td>
                                    </tr>

                                    <tr>
                                        <td><b>Sales SPLY</b></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                    </tr>

                                    <tr>
                                        <td><b>Sales Gr% SPLY</b></td>
                                        <td class="bg-gradient-danger text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-success text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-warning text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-info text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-primary text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-danger text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-success text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-warning text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-info text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-primary text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-danger text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-success text-white"><span class="sw_text">0%</span></td>
                                    </tr>

                                    <tr>
                                        <td><b>Cum. Sales SPLY</b></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                    </tr>

                                    <tr>
                                        <td><b>Cum. Sales SPLY Grw.%</b></td>
                                        <td class="bg-gradient-danger text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-success text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-warning text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-info text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-primary text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-danger text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-success text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-warning text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-info text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-primary text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-danger text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-success text-white"><span class="sw_text">0%</span></td>
                                    </tr>

                                    <tr>
                                        <td><b>Recov Target</b></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                    </tr>

                                    <tr>
                                        <td><b>Recov This Month</b></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                        <td><span class="sw_text"></span></td>
                                    </tr>

                                    <tr>
                                        <td><b>Recovery Acv%</b></td>
                                        <td class="bg-gradient-danger text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-success text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-warning text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-info text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-primary text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-danger text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-success text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-warning text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-info text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-primary text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-danger text-white"><span class="sw_text">0%</span></td>
                                        <td class="bg-gradient-success text-white"><span class="sw_text">0%</span></td>
                                    </tr>
                                    </tbody>
{{--                                    {{ csrf_field() }}--}}

                                    {{--                                    <tfoot>--}}
                                    {{--                                    <tr>--}}
                                    {{--                                        <th>Product Name</th>--}}
                                    {{--                                        <th style="text-align: center;">Jan</th>--}}
                                    {{--                                        <th style="text-align: center;">Feb</th>--}}
                                    {{--                                        <th style="text-align: center;">Mar</th>--}}
                                    {{--                                        <th style="text-align: center;">Apr</th>--}}
                                    {{--                                        <th style="text-align: center;">May</th>--}}
                                    {{--                                        <th style="text-align: center;">Jun</th>--}}
                                    {{--                                        <th style="text-align: center;">Jul</th>--}}
                                    {{--                                        <th style="text-align: center;">Aug</th>--}}
                                    {{--                                        <th style="text-align: center;">Sep</th>--}}
                                    {{--                                        <th style="text-align: center;">Oct</th>--}}
                                    {{--                                        <th style="text-align: center;">Nov</th>--}}
                                    {{--                                        <th style="text-align: center;">Dec</th>--}}
                                    {{--                                        <th style="text-align: center;">Total</th>--}}
                                    {{--                                    </tr>--}}
                                    {{--                                    </tfoot>--}}
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function() {

            $('#sYear').change(function () {
                var yearId = $(this).val();
                var _token = $('input[name="_token"]').val();
                // console.log(_token);
                // console.log(yearId);
                $.ajax({
                    url: "{{ route('search.salesByYear') }}",
                    method: "POST",
                    data: {yearId: yearId, _token: _token},
                    success: function (result) {
                        $('#tableData').html(result)
                    }
                })

            })
        });

    </script>
@endsection
