@extends('frontEnd.master')

@section('title') Sale Budget @endsection

<style>
    .form-control-sm {
        padding: 0px !important;
    }
</style>

@section('mainContent')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h4 mb-0 text-gray-800">Sale Budget</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-2">
                    <h6 class="m-0 font-weight-bold text-primary">Add Sale Budget</h6>
                </div>
                <div class="card-body">
                    <form name="frmcontent" action="{{ url('/sales-budget/create') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-sm-4 offset-sm-4">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Budget Year</label>
                                <div class="col-sm-8">
                                    <div class="col-sm-8">
                                        <select class="form-control" id="budgetYear" name="budgetYear">
                                            <option value="option_select" disabled selected>Select Year</option>
                                            @foreach($budgetYears as $item)
                                                <option value="{{ $item->budgetYear }}">{{ $item->budgetYear }}</option>
                                            @endforeach
                                            <option value="{{ date('Y') }}">{{ date('Y') }}</option>
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
                                        <th style="width: 150px;">Budget</th>
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

                                    <tbody id="tableData">
                                    <tr>
                                        <td><b>Sales</b></td>
                                        <td><input type="text" name="salesJan" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="salesFeb" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="salesMar" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="salesApr" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="salesMay" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="salesJun" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="salesJul" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="salesAug" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="salesSep" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="salesOct" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="salesNov" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="salesDec" class="form-control form-control-sm"></td>
                                        <td>2500</td>
                                    </tr>

                                    <tr>
                                        <td><b>COGS</b></td>
                                        <td><input type="text" name="cogsJan" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="cogsFeb" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="cogsMar" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="cogsApr" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="cogsMay" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="cogsJun" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="cogsJul" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="cogsAug" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="cogsSep" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="cogsOct" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="cogsNov" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="cogsDec" class="form-control form-control-sm"></td>
                                        <td>2500</td>
                                    </tr>

                                    <tr>
                                        <td><b>GP</b></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td>2500</td>
                                    </tr>

                                    <tr>
                                        <td><b>GP %</b></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td>2500</td>
                                    </tr>

                                    <tr>
                                        <td><b>OE Budget</b></td>
                                        <td><input type="text" name="oeJan" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="oeFeb" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="oeMar" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="oeApr" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="oeMay" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="oeJun" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="oeJul" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="oeAug" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="oeSep" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="oeOct" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="oeNov" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="oeDec" class="form-control form-control-sm"></td>
                                        <td>2500</td>
                                    </tr>

                                    <tr>
                                        <td><b>Operating Per</b></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td>2500</td>
                                    </tr>

                                    <tr>
                                        <td><b>Operating Per %</b></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td>2500</td>
                                    </tr>

                                    <tr>
                                        <td><b>Recov Target</b></td>
                                        <td><input type="text" name="recJan" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="recFeb" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="recMar" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="recApr" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="recMay" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="recJun" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="recJul" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="recAug" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="recSep" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="recOct" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="recNov" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="recDec" class="form-control form-control-sm"></td>
                                        <td>2500</td>
                                    </tr>
                                    </tbody>

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

                        <center>
                            <button type="submit" class="btn btn-primary">Save Info</button>
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function() {

            $('#budgetYear').change(function () {
                var yearId = $(this).val();
                var _token = $('input[name="_token"]').val();
                // console.log(_token);
                console.log(yearId);
                $.ajax({
                    url: "{{ route('search.budgetByYear') }}",
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
