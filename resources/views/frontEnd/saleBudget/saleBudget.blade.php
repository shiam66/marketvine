@extends('frontEnd.master')

@section('title') Sale Budget @endsection

<style>
    .form-control-sm {
        padding: 0px !important;
    }
    .table-sm .form-control{
        font-size: 12px;
        text-align: right;
    }
    .table-sm td{
        padding: 0px !important;
        vertical-align: middle !important;
    }
    .table-sm th {
        padding: 2px !important;
        vertical-align: middle !important;
    }

    .form-control-sm {
        border-radius: 0px !important;
    }
    .table-bordered td{
        vertical-align: middle !important;
        font-size: 12px;
    }
</style>

@section('mainContent')

    <?php
        $active ='sale_budget';
        $mainActive ='';
    ?>

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
                                            {{--                                            <option value="option_select" disabled selected>Select Year</option>--}}
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
                                        <th style="width: 120px;">Budget</th>
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
                                        <th style="width: 80px; text-align: center;">Total</th>
                                    </tr>
                                    </thead>

                                    <tbody id="tableData">
                                    @php
                                        $gpJan = $budget->salesJan - $budget->cogsJan;
                                        $gpFeb = $budget->salesFeb - $budget->cogsFeb;
                                        $gpMar = $budget->salesMar - $budget->cogsMar;
                                        $gpApr = $budget->salesApr - $budget->cogsApr;
                                        $gpMay = $budget->salesMay - $budget->cogsMay;
                                        $gpJun = $budget->salesJun - $budget->cogsJun;
                                        $gpJul = $budget->salesJul - $budget->cogsJul;
                                        $gpAug = $budget->salesAug - $budget->cogsAug;
                                        $gpSep = $budget->salesSep - $budget->cogsSep;
                                        $gpOct = $budget->salesOct - $budget->cogsOct;
                                        $gpNov = $budget->salesNov - $budget->cogsNov;
                                        $gpDec = $budget->salesDec - $budget->cogsDec;

                                        $opJan = $gpJan - $budget->oeJan;
                                        $opFeb = $gpFeb - $budget->oeFeb;
                                        $opMar = $gpMar - $budget->oeMar;
                                        $opApr = $gpApr - $budget->oeApr;
                                        $opMay = $gpMay - $budget->oeMay;
                                        $opJun = $gpJun - $budget->oeJun;
                                        $opJul = $gpJul - $budget->oeJul;
                                        $opAug = $gpAug - $budget->oeAug;
                                        $opSep = $gpSep - $budget->oeSep;
                                        $opOct = $gpOct - $budget->oeOct;
                                        $opNov = $gpNov - $budget->oeNov;
                                        $opDec = $gpDec - $budget->oeDec;
                                        $opTotal=$opJan+$opFeb+$opMar+$opApr+$opMay+$opJun+$opJul+$opAug+$opSep+$opOct+$opNov+$opDec;
                                    @endphp

                                    <tr>
                                        <th>Sales</th>
                                        <td><input type="text" value="{{ $budget->salesJan }}" name="salesJan" class="form-control form-control-sm"></td>
                                        <td><input type="text" value="{{ $budget->salesFeb }}" name="salesFeb" class="form-control form-control-sm"></td>
                                        <td><input type="text" value="{{ $budget->salesMar }}" name="salesMar" class="form-control form-control-sm"></td>
                                        <td><input type="text" value="{{ $budget->salesApr }}" name="salesApr" class="form-control form-control-sm"></td>
                                        <td><input type="text" value="{{ $budget->salesMay }}" name="salesMay" class="form-control form-control-sm"></td>
                                        <td><input type="text" value="{{ $budget->salesJun }}" name="salesJun" class="form-control form-control-sm"></td>
                                        <td><input type="text" value="{{ $budget->salesJul }}" name="salesJul" class="form-control form-control-sm"></td>
                                        <td><input type="text" value="{{ $budget->salesAug }}" name="salesAug" class="form-control form-control-sm"></td>
                                        <td><input type="text" value="{{ $budget->salesSep }}" name="salesSep" class="form-control form-control-sm"></td>
                                        <td><input type="text" value="{{ $budget->salesOct }}" name="salesOct" class="form-control form-control-sm"></td>
                                        <td><input type="text" value="{{ $budget->salesNov }}" name="salesNov" class="form-control form-control-sm"></td>
                                        <td><input type="text" value="{{ $budget->salesDec }}" name="salesDec" class="form-control form-control-sm"></td>
                                        <td class="text-right">{{ $budget->salesTotal }}</td>
                                    </tr>

                                    <tr>
                                        <th>COGS</th>
                                        <td><input type="text" value="{{ $budget->cogsJan }}" name="cogsJan" class="form-control form-control-sm"></td>
                                        <td><input type="text" value="{{ $budget->cogsFeb }}" name="cogsFeb" class="form-control form-control-sm"></td>
                                        <td><input type="text" value="{{ $budget->cogsMar }}" name="cogsMar" class="form-control form-control-sm"></td>
                                        <td><input type="text" value="{{ $budget->cogsApr }}" name="cogsApr" class="form-control form-control-sm"></td>
                                        <td><input type="text" value="{{ $budget->cogsMay }}" name="cogsMay" class="form-control form-control-sm"></td>
                                        <td><input type="text" value="{{ $budget->cogsJun }}" name="cogsJun" class="form-control form-control-sm"></td>
                                        <td><input type="text" value="{{ $budget->cogsJul }}" name="cogsJul" class="form-control form-control-sm"></td>
                                        <td><input type="text" value="{{ $budget->cogsAug }}" name="cogsAug" class="form-control form-control-sm"></td>
                                        <td><input type="text" value="{{ $budget->cogsSep }}" name="cogsSep" class="form-control form-control-sm"></td>
                                        <td><input type="text" value="{{ $budget->cogsOct }}" name="cogsOct" class="form-control form-control-sm"></td>
                                        <td><input type="text" value="{{ $budget->cogsNov }}" name="cogsNov" class="form-control form-control-sm"></td>
                                        <td><input type="text" value="{{ $budget->cogsDec }}" name="cogsDec" class="form-control form-control-sm"></td>
                                        <td class="text-right">{{ $budget->cogsTotal }}</td>
                                    </tr>

                                    <tr>
                                        <th>GP</th>
                                        <td><input type="text" value="{{ $gpJan }}" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" value="{{ $gpFeb }}" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" value="{{ $gpMar }}" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" value="{{ $gpApr }}" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" value="{{ $gpMay }}" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" value="{{ $gpJun }}" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" value="{{ $gpJul }}" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" value="{{ $gpAug }}" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" value="{{ $gpSep }}" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" value="{{ $gpOct }}" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" value="{{ $gpNov }}" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" value="{{ $gpDec }}" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td class="text-right">{{ ($budget->salesTotal - $budget->cogsTotal) }}</td>
                                    </tr>

                                    <tr>
                                        <th>GP %</th>
                                        <td class="bg-warning text-white text-right">{{ round($gpJan / $budget->salesJan * 100) }}%</td>
                                        <td class="bg-warning text-white text-right">{{ round($gpFeb / $budget->salesFeb * 100) }}%</td>
                                        <td class="bg-warning text-white text-right">{{ round($gpMar / $budget->salesMar * 100) }}%</td>
                                        <td class="bg-warning text-white text-right">{{ round($gpApr / $budget->salesApr * 100) }}%</td>
                                        <td class="bg-warning text-white text-right">{{ round($gpMay / $budget->salesMay * 100) }}%</td>
                                        <td class="bg-warning text-white text-right">{{ round($gpJun / $budget->salesJun * 100) }}%</td>
                                        <td class="bg-warning text-white text-right">{{ round($gpJul / $budget->salesJul * 100) }}%</td>
                                        <td class="bg-warning text-white text-right">{{ round($gpAug / $budget->salesAug * 100) }}%</td>
                                        <td class="bg-warning text-white text-right">{{ round($gpSep / $budget->salesSep * 100) }}%</td>
                                        <td class="bg-warning text-white text-right">{{ round($gpOct / $budget->salesOct * 100) }}%</td>
                                        <td class="bg-warning text-white text-right">{{ round($gpNov / $budget->salesNov * 100) }}%</td>
                                        <td class="bg-warning text-white text-right">{{ round($gpDec / $budget->salesDec * 100) }}%</td>
                                        <td class="bg-warning text-white text-right">{{ round(($budget->salesTotal - $budget->cogsTotal) / $budget->salesTotal * 100) }}%</td>
                                    </tr>

                                    <tr>
                                        <th>OE</th>
                                        <td><input type="text" value="{{ $budget->oeJan }}" name="oeJan" class="form-control form-control-sm"></td>
                                        <td><input type="text" value="{{ $budget->oeFeb }}" name="oeFeb" class="form-control form-control-sm"></td>
                                        <td><input type="text" value="{{ $budget->oeMar }}" name="oeMar" class="form-control form-control-sm"></td>
                                        <td><input type="text" value="{{ $budget->oeApr }}" name="oeApr" class="form-control form-control-sm"></td>
                                        <td><input type="text" value="{{ $budget->oeMay }}" name="oeMay" class="form-control form-control-sm"></td>
                                        <td><input type="text" value="{{ $budget->oeJun }}" name="oeJun" class="form-control form-control-sm"></td>
                                        <td><input type="text" value="{{ $budget->oeJul }}" name="oeJul" class="form-control form-control-sm"></td>
                                        <td><input type="text" value="{{ $budget->oeAug }}" name="oeAug" class="form-control form-control-sm"></td>
                                        <td><input type="text" value="{{ $budget->oeSep }}" name="oeSep" class="form-control form-control-sm"></td>
                                        <td><input type="text" value="{{ $budget->oeOct }}" name="oeOct" class="form-control form-control-sm"></td>
                                        <td><input type="text" value="{{ $budget->oeNov }}" name="oeNov" class="form-control form-control-sm"></td>
                                        <td><input type="text" value="{{ $budget->oeDec }}" name="oeDec" class="form-control form-control-sm"></td>
                                        <td class="text-right">{{ $budget->oeTotal }}</td>
                                    </tr>

                                    <tr>
                                        <th>OP</th>
                                        <td><input type="text" value="{{ $opJan }}" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" value="{{ $opFeb }}" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" value="{{ $opMar }}" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" value="{{ $opApr }}" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" value="{{ $opMay }}" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" value="{{ $opJun }}" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" value="{{ $opJul }}" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" value="{{ $opAug }}" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" value="{{ $opSep }}" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" value="{{ $opOct }}" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" value="{{ $opNov }}" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td><input type="text" value="{{ $opDec }}" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                                        <td class="text-right">{{ $opTotal }}</td>
                                    </tr>

                                    <tr>
                                        <th>OP %</th>
                                        <td class="bg-success text-white text-right">{{ round($opJan / $budget->salesJan * 100) }}%</td>
                                        <td class="bg-success text-white text-right">{{ round($opFeb / $budget->salesFeb * 100) }}%</td>
                                        <td class="bg-success text-white text-right">{{ round($opMar / $budget->salesMar * 100) }}%</td>
                                        <td class="bg-success text-white text-right">{{ round($opApr / $budget->salesApr * 100) }}%</td>
                                        <td class="bg-success text-white text-right">{{ round($opMay / $budget->salesMay * 100) }}%</td>
                                        <td class="bg-success text-white text-right">{{ round($opJun / $budget->salesJun * 100) }}%</td>
                                        <td class="bg-success text-white text-right">{{ round($opJul / $budget->salesJul * 100) }}%</td>
                                        <td class="bg-success text-white text-right">{{ round($opAug / $budget->salesAug * 100) }}%</td>
                                        <td class="bg-success text-white text-right">{{ round($opSep / $budget->salesSep * 100) }}%</td>
                                        <td class="bg-success text-white text-right">{{ round($opOct / $budget->salesOct * 100) }}%</td>
                                        <td class="bg-success text-white text-right">{{ round($opNov / $budget->salesNov * 100) }}%</td>
                                        <td class="bg-success text-white text-right">{{ round($opDec / $budget->salesDec * 100) }}%</td>
                                        <td class="bg-success text-white text-right">{{ round($opTotal / $budget->salesTotal * 100) }}%</td>
                                    </tr>

                                    <tr>
                                        <th>Recov Target</th>
                                        <td><input type="text" value="{{ $budget->recJan }}" name="recJan" class="form-control form-control-sm"></td>
                                        <td><input type="text" value="{{ $budget->recFeb }}" name="recFeb" class="form-control form-control-sm"></td>
                                        <td><input type="text" value="{{ $budget->recMar }}" name="recMar" class="form-control form-control-sm"></td>
                                        <td><input type="text" value="{{ $budget->recApr }}" name="recApr" class="form-control form-control-sm"></td>
                                        <td><input type="text" value="{{ $budget->recMay }}" name="recMay" class="form-control form-control-sm"></td>
                                        <td><input type="text" value="{{ $budget->recJun }}" name="recJun" class="form-control form-control-sm"></td>
                                        <td><input type="text" value="{{ $budget->recJul }}" name="recJul" class="form-control form-control-sm"></td>
                                        <td><input type="text" value="{{ $budget->recAug }}" name="recAug" class="form-control form-control-sm"></td>
                                        <td><input type="text" value="{{ $budget->recSep }}" name="recSep" class="form-control form-control-sm"></td>
                                        <td><input type="text" value="{{ $budget->recOct }}" name="recOct" class="form-control form-control-sm"></td>
                                        <td><input type="text" value="{{ $budget->recNov }}" name="recNov" class="form-control form-control-sm"></td>
                                        <td><input type="text" value="{{ $budget->recDec }}" name="recDec" class="form-control form-control-sm"></td>
                                        <td class="text-right">{{ $budget->recTotal }}</td>
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
