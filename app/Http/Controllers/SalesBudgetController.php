<?php

namespace App\Http\Controllers;

use App\Models\SalesBudget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesBudgetController extends Controller
{
    public function salesBudget()
    {
        $yearId = SalesBudget::Select('budgetYear')->max('budgetYear');
        $budget = SalesBudget::Where('budgetYear', '=', $yearId)->first();

        $budgetYears = DB::table('sales_budgets')
            ->groupBy('budgetYear')
            ->orderByDesc('budgetYear')
            ->select('budgetYear')
            ->get();

        return view('frontEnd.saleBudget.saleBudget', [
            'budgetYears' => $budgetYears,
            'budget' => $budget
        ]);
    }

    public function budgetByYear(Request $request)
    {
        $yearId = $request->get('yearId');
        $output = "";
        $budget = SalesBudget::where('budgetYear', '=', $yearId)->first();

        if($budget!=null) {
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
            $opTotal = $opJan + $opFeb + $opMar + $opApr + $opMay + $opJun + $opJul + $opAug + $opSep + $opOct + $opNov + $opDec;

            $output .= '
            <tr>
                <th>Sales</th>
                <td><input type="text" value="' . $budget->salesJan . '" name="salesJan" class="form-control form-control-sm"></td>
                <td><input type="text" value="' . $budget->salesFeb . '" name="salesFeb" class="form-control form-control-sm"></td>
                <td><input type="text" value="' . $budget->salesMar . '" name="salesMar" class="form-control form-control-sm"></td>
                <td><input type="text" value="' . $budget->salesApr . '" name="salesApr" class="form-control form-control-sm"></td>
                <td><input type="text" value="' . $budget->salesMay . '" name="salesMay" class="form-control form-control-sm"></td>
                <td><input type="text" value="' . $budget->salesJun . '" name="salesJun" class="form-control form-control-sm"></td>
                <td><input type="text" value="' . $budget->salesJul . '" name="salesJul" class="form-control form-control-sm"></td>
                <td><input type="text" value="' . $budget->salesAug . '" name="salesAug" class="form-control form-control-sm"></td>
                <td><input type="text" value="' . $budget->salesSep . '" name="salesSep" class="form-control form-control-sm"></td>
                <td><input type="text" value="' . $budget->salesOct . '" name="salesOct" class="form-control form-control-sm"></td>
                <td><input type="text" value="' . $budget->salesNov . '" name="salesNov" class="form-control form-control-sm"></td>
                <td><input type="text" value="' . $budget->salesDec . '" name="salesDec" class="form-control form-control-sm"></td>
                <td class="text-right">' . $budget->salesTotal . '</td>
            </tr>

            <tr>
                <th>COGS</th>
                <td><input type="text" value="' . $budget->cogsJan . '" name="cogsJan" class="form-control form-control-sm"></td>
                <td><input type="text" value="' . $budget->cogsFeb . '" name="cogsFeb" class="form-control form-control-sm"></td>
                <td><input type="text" value="' . $budget->cogsMar . '" name="cogsMar" class="form-control form-control-sm"></td>
                <td><input type="text" value="' . $budget->cogsApr . '" name="cogsApr" class="form-control form-control-sm"></td>
                <td><input type="text" value="' . $budget->cogsMay . '" name="cogsMay" class="form-control form-control-sm"></td>
                <td><input type="text" value="' . $budget->cogsJun . '" name="cogsJun" class="form-control form-control-sm"></td>
                <td><input type="text" value="' . $budget->cogsJul . '" name="cogsJul" class="form-control form-control-sm"></td>
                <td><input type="text" value="' . $budget->cogsAug . '" name="cogsAug" class="form-control form-control-sm"></td>
                <td><input type="text" value="' . $budget->cogsSep . '" name="cogsSep" class="form-control form-control-sm"></td>
                <td><input type="text" value="' . $budget->cogsOct . '" name="cogsOct" class="form-control form-control-sm"></td>
                <td><input type="text" value="' . $budget->cogsNov . '" name="cogsNov" class="form-control form-control-sm"></td>
                <td><input type="text" value="' . $budget->cogsDec . '" name="cogsDec" class="form-control form-control-sm"></td>
                <td class="text-right">' . $budget->cogsTotal . '</td>
            </tr>

            <tr>
                <th>GP</th>
                <td><input type="text" value="' . $gpJan . '" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td><input type="text" value="' . $gpFeb . '" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td><input type="text" value="' . $gpMar . '" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td><input type="text" value="' . $gpApr . '" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td><input type="text" value="' . $gpMay . '" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td><input type="text" value="' . $gpJun . '" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td><input type="text" value="' . $gpJul . '" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td><input type="text" value="' . $gpAug . '" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td><input type="text" value="' . $gpSep . '" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td><input type="text" value="' . $gpOct . '" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td><input type="text" value="' . $gpNov . '" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td><input type="text" value="' . $gpDec . '" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td class="text-right">' . ($budget->salesTotal - $budget->cogsTotal) . '</td>
            </tr>

            <tr>
                <th>GP %</th>
                <td class="bg-warning text-white text-right">' . round($gpJan / $budget->salesJan * 100) . '%</td>
                <td class="bg-warning text-white text-right">' . round($gpFeb / $budget->salesFeb * 100) . '%</td>
                <td class="bg-warning text-white text-right">' . round($gpMar / $budget->salesMar * 100) . '%</td>
                <td class="bg-warning text-white text-right">' . round($gpApr / $budget->salesApr * 100) . '%</td>
                <td class="bg-warning text-white text-right">' . round($gpMay / $budget->salesMay * 100) . '%</td>
                <td class="bg-warning text-white text-right">' . round($gpJun / $budget->salesJun * 100) . '%</td>
                <td class="bg-warning text-white text-right">' . round($gpJul / $budget->salesJul * 100) . '%</td>
                <td class="bg-warning text-white text-right">' . round($gpAug / $budget->salesAug * 100) . '%</td>
                <td class="bg-warning text-white text-right">' . round($gpSep / $budget->salesSep * 100) . '%</td>
                <td class="bg-warning text-white text-right">' . round($gpOct / $budget->salesOct * 100) . '%</td>
                <td class="bg-warning text-white text-right">' . round($gpNov / $budget->salesNov * 100) . '%</td>
                <td class="bg-warning text-white text-right">' . round($gpDec / $budget->salesDec * 100) . '%</td>
                <td class="bg-warning text-white text-right">' . round(($budget->salesTotal - $budget->cogsTotal) / $budget->salesTotal * 100) . '%</td>
            </tr>

            <tr>
                <th>OE</th>
                <td><input type="text" value="' . $budget->oeJan . '" name="oeJan" class="form-control form-control-sm"></td>
                <td><input type="text" value="' . $budget->oeFeb . '" name="oeFeb" class="form-control form-control-sm"></td>
                <td><input type="text" value="' . $budget->oeMar . '" name="oeMar" class="form-control form-control-sm"></td>
                <td><input type="text" value="' . $budget->oeApr . '" name="oeApr" class="form-control form-control-sm"></td>
                <td><input type="text" value="' . $budget->oeMay . '" name="oeMay" class="form-control form-control-sm"></td>
                <td><input type="text" value="' . $budget->oeJun . '" name="oeJun" class="form-control form-control-sm"></td>
                <td><input type="text" value="' . $budget->oeJul . '" name="oeJul" class="form-control form-control-sm"></td>
                <td><input type="text" value="' . $budget->oeAug . '" name="oeAug" class="form-control form-control-sm"></td>
                <td><input type="text" value="' . $budget->oeSep . '" name="oeSep" class="form-control form-control-sm"></td>
                <td><input type="text" value="' . $budget->oeOct . '" name="oeOct" class="form-control form-control-sm"></td>
                <td><input type="text" value="' . $budget->oeNov . '" name="oeNov" class="form-control form-control-sm"></td>
                <td><input type="text" value="' . $budget->oeDec . '" name="oeDec" class="form-control form-control-sm"></td>
                <td class="text-right">' . $budget->oeTotal . '</td>
            </tr>

            <tr>
                <th>OP</th>
                <td><input type="text" value="' . $opJan . '" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td><input type="text" value="' . $opFeb . '" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td><input type="text" value="' . $opMar . '" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td><input type="text" value="' . $opApr . '" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td><input type="text" value="' . $opMay . '" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td><input type="text" value="' . $opJun . '" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td><input type="text" value="' . $opJul . '" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td><input type="text" value="' . $opAug . '" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td><input type="text" value="' . $opSep . '" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td><input type="text" value="' . $opOct . '" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td><input type="text" value="' . $opNov . '" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td><input type="text" value="' . $opDec . '" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td class="text-right">' . $opTotal . '</td>
            </tr>

            <tr>
                <th>OP %</th>
                <td class="bg-success text-white text-right">' . round($opJan / $budget->salesJan * 100) . '%</td>
                <td class="bg-success text-white text-right">' . round($opFeb / $budget->salesFeb * 100) . '%</td>
                <td class="bg-success text-white text-right">' . round($opMar / $budget->salesMar * 100) . '%</td>
                <td class="bg-success text-white text-right">' . round($opApr / $budget->salesApr * 100) . '%</td>
                <td class="bg-success text-white text-right">' . round($opMay / $budget->salesMay * 100) . '%</td>
                <td class="bg-success text-white text-right">' . round($opJun / $budget->salesJun * 100) . '%</td>
                <td class="bg-success text-white text-right">' . round($opJul / $budget->salesJul * 100) . '%</td>
                <td class="bg-success text-white text-right">' . round($opAug / $budget->salesAug * 100) . '%</td>
                <td class="bg-success text-white text-right">' . round($opSep / $budget->salesSep * 100) . '%</td>
                <td class="bg-success text-white text-right">' . round($opOct / $budget->salesOct * 100) . '%</td>
                <td class="bg-success text-white text-right">' . round($opNov / $budget->salesNov * 100) . '%</td>
                <td class="bg-success text-white text-right">' . round($opDec / $budget->salesDec * 100) . '%</td>
                <td class="bg-success text-white text-right">' . round($opTotal / $budget->salesTotal * 100) . '%</td>
            </tr>

            <tr>
                <th>Recov Target</th>
                <td><input type="text" value="' . $budget->recJan . '" name="recJan" class="form-control form-control-sm"></td>
                <td><input type="text" value="' . $budget->recFeb . '" name="recFeb" class="form-control form-control-sm"></td>
                <td><input type="text" value="' . $budget->recMar . '" name="recMar" class="form-control form-control-sm"></td>
                <td><input type="text" value="' . $budget->recApr . '" name="recApr" class="form-control form-control-sm"></td>
                <td><input type="text" value="' . $budget->recMay . '" name="recMay" class="form-control form-control-sm"></td>
                <td><input type="text" value="' . $budget->recJun . '" name="recJun" class="form-control form-control-sm"></td>
                <td><input type="text" value="' . $budget->recJul . '" name="recJul" class="form-control form-control-sm"></td>
                <td><input type="text" value="' . $budget->recAug . '" name="recAug" class="form-control form-control-sm"></td>
                <td><input type="text" value="' . $budget->recSep . '" name="recSep" class="form-control form-control-sm"></td>
                <td><input type="text" value="' . $budget->recOct . '" name="recOct" class="form-control form-control-sm"></td>
                <td><input type="text" value="' . $budget->recNov . '" name="recNov" class="form-control form-control-sm"></td>
                <td><input type="text" value="' . $budget->recDec . '" name="recDec" class="form-control form-control-sm"></td>
                <td class="text-right">' . $budget->recTotal . '</td>
            </tr>

        ';
        }
        else{
            $output .= '
            <tr>
                <th>Sales</th>
                <td><input type="text" value="1" name="salesJan" class="form-control form-control-sm"></td>
                <td><input type="text" value="1" name="salesFeb" class="form-control form-control-sm"></td>
                <td><input type="text" value="1" name="salesMar" class="form-control form-control-sm"></td>
                <td><input type="text" value="1" name="salesApr" class="form-control form-control-sm"></td>
                <td><input type="text" value="1" name="salesMay" class="form-control form-control-sm"></td>
                <td><input type="text" value="1" name="salesJun" class="form-control form-control-sm"></td>
                <td><input type="text" value="1" name="salesJul" class="form-control form-control-sm"></td>
                <td><input type="text" value="1" name="salesAug" class="form-control form-control-sm"></td>
                <td><input type="text" value="1" name="salesSep" class="form-control form-control-sm"></td>
                <td><input type="text" value="1" name="salesOct" class="form-control form-control-sm"></td>
                <td><input type="text" value="1" name="salesNov" class="form-control form-control-sm"></td>
                <td><input type="text" value="1" name="salesDec" class="form-control form-control-sm"></td>
                <td class="text-right"></td>
            </tr>

            <tr>
                <th>COGS</th>
                <td><input type="text" value="1" name="cogsJan" class="form-control form-control-sm"></td>
                <td><input type="text" value="1" name="cogsFeb" class="form-control form-control-sm"></td>
                <td><input type="text" value="1" name="cogsMar" class="form-control form-control-sm"></td>
                <td><input type="text" value="1" name="cogsApr" class="form-control form-control-sm"></td>
                <td><input type="text" value="1" name="cogsMay" class="form-control form-control-sm"></td>
                <td><input type="text" value="1" name="cogsJun" class="form-control form-control-sm"></td>
                <td><input type="text" value="1" name="cogsJul" class="form-control form-control-sm"></td>
                <td><input type="text" value="1" name="cogsAug" class="form-control form-control-sm"></td>
                <td><input type="text" value="1" name="cogsSep" class="form-control form-control-sm"></td>
                <td><input type="text" value="1" name="cogsOct" class="form-control form-control-sm"></td>
                <td><input type="text" value="1" name="cogsNov" class="form-control form-control-sm"></td>
                <td><input type="text" value="1" name="cogsDec" class="form-control form-control-sm"></td>
                <td class="text-right"></td>
            </tr>

            <tr>
                <th>GP</th>
                <td><input type="text" value="1" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td><input type="text" value="1" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td><input type="text" value="1" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td><input type="text" value="1" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td><input type="text" value="1" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td><input type="text" value="1" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td><input type="text" value="1" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td><input type="text" value="1" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td><input type="text" value="1" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td><input type="text" value="1" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td><input type="text" value="1" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td><input type="text" value="1" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td class="text-right"></td>
            </tr>

            <tr>
                <th>GP %</th>
                <td class="bg-warning text-white text-right">%</td>
                <td class="bg-warning text-white text-right">%</td>
                <td class="bg-warning text-white text-right">%</td>
                <td class="bg-warning text-white text-right">%</td>
                <td class="bg-warning text-white text-right">%</td>
                <td class="bg-warning text-white text-right">%</td>
                <td class="bg-warning text-white text-right">%</td>
                <td class="bg-warning text-white text-right">%</td>
                <td class="bg-warning text-white text-right">%</td>
                <td class="bg-warning text-white text-right">%</td>
                <td class="bg-warning text-white text-right">%</td>
                <td class="bg-warning text-white text-right">%</td>
                <td class="bg-warning text-white text-right">%</td>
            </tr>

            <tr>
                <th>OE</th>
                <td><input type="text" value="1" name="oeJan" class="form-control form-control-sm"></td>
                <td><input type="text" value="1" name="oeFeb" class="form-control form-control-sm"></td>
                <td><input type="text" value="1" name="oeMar" class="form-control form-control-sm"></td>
                <td><input type="text" value="1" name="oeApr" class="form-control form-control-sm"></td>
                <td><input type="text" value="1" name="oeMay" class="form-control form-control-sm"></td>
                <td><input type="text" value="1" name="oeJun" class="form-control form-control-sm"></td>
                <td><input type="text" value="1" name="oeJul" class="form-control form-control-sm"></td>
                <td><input type="text" value="1" name="oeAug" class="form-control form-control-sm"></td>
                <td><input type="text" value="1" name="oeSep" class="form-control form-control-sm"></td>
                <td><input type="text" value="1" name="oeOct" class="form-control form-control-sm"></td>
                <td><input type="text" value="1" name="oeNov" class="form-control form-control-sm"></td>
                <td><input type="text" value="1" name="oeDec" class="form-control form-control-sm"></td>
                <td class="text-right"></td>
            </tr>

            <tr>
                <th>OP</th>
                <td><input type="text" value="1" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td><input type="text" value="1" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td><input type="text" value="1" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td><input type="text" value="1" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td><input type="text" value="1" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td><input type="text" value="1" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td><input type="text" value="1" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td><input type="text" value="1" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td><input type="text" value="1" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td><input type="text" value="1" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td><input type="text" value="1" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td><input type="text" value="1" name="saleBudget1" class="form-control form-control-sm" readonly></td>
                <td class="text-right"></td>
            </tr>

            <tr>
                <th>OP %</th>
                <td class="bg-success text-white text-right">%</td>
                <td class="bg-success text-white text-right">%</td>
                <td class="bg-success text-white text-right">%</td>
                <td class="bg-success text-white text-right">%</td>
                <td class="bg-success text-white text-right">%</td>
                <td class="bg-success text-white text-right">%</td>
                <td class="bg-success text-white text-right">%</td>
                <td class="bg-success text-white text-right">%</td>
                <td class="bg-success text-white text-right">%</td>
                <td class="bg-success text-white text-right">%</td>
                <td class="bg-success text-white text-right">%</td>
                <td class="bg-success text-white text-right">%</td>
                <td class="bg-success text-white text-right">%</td>
            </tr>

            <tr>
                <th>Recov Target</th>
                <td><input type="text" value="1" name="recJan" class="form-control form-control-sm"></td>
                <td><input type="text" value="1" name="recFeb" class="form-control form-control-sm"></td>
                <td><input type="text" value="1" name="recMar" class="form-control form-control-sm"></td>
                <td><input type="text" value="1" name="recApr" class="form-control form-control-sm"></td>
                <td><input type="text" value="1" name="recMay" class="form-control form-control-sm"></td>
                <td><input type="text" value="1" name="recJun" class="form-control form-control-sm"></td>
                <td><input type="text" value="1" name="recJul" class="form-control form-control-sm"></td>
                <td><input type="text" value="1" name="recAug" class="form-control form-control-sm"></td>
                <td><input type="text" value="1" name="recSep" class="form-control form-control-sm"></td>
                <td><input type="text" value="1" name="recOct" class="form-control form-control-sm"></td>
                <td><input type="text" value="1" name="recNov" class="form-control form-control-sm"></td>
                <td><input type="text" value="1" name="recDec" class="form-control form-control-sm"></td>
                <td class="text-right"></td>
            </tr>

        ';
        }
        echo $output;
    }

    public function createSalesBudget(Request $request)
    {
        $yearId = $request->budgetYear;
        $budget = SalesBudget::where('budgetYear', '=', $yearId)->first();

        if (!$budget) {
            $salesBudget = new SalesBudget();
            $salesBudget->budgetYear = $request->budgetYear;
            $salesBudget->salesJan = $request->salesJan;
            $salesBudget->salesFeb = $request->salesFeb;
            $salesBudget->salesMar = $request->salesMar;
            $salesBudget->salesApr = $request->salesApr;
            $salesBudget->salesMay = $request->salesMay;
            $salesBudget->salesJun = $request->salesJun;
            $salesBudget->salesJul = $request->salesJul;
            $salesBudget->salesAug = $request->salesAug;
            $salesBudget->salesSep = $request->salesSep;
            $salesBudget->salesOct = $request->salesOct;
            $salesBudget->salesNov = $request->salesNov;
            $salesBudget->salesDec = $request->salesDec;
            $salesBudget->salesTotal = ($request->salesJan + $request->salesFeb + $request->salesMar + $request->salesApr + $request->salesMay + $request->salesJun + $request->salesJul + $request->salesAug + $request->salesSep + $request->salesOct + $request->salesNov + $request->salesDec);
            $salesBudget->cogsJan = $request->cogsJan;
            $salesBudget->cogsFeb = $request->cogsFeb;
            $salesBudget->cogsMar = $request->cogsMar;
            $salesBudget->cogsApr = $request->cogsApr;
            $salesBudget->cogsMay = $request->cogsMay;
            $salesBudget->cogsJun = $request->cogsJun;
            $salesBudget->cogsJul = $request->cogsJul;
            $salesBudget->cogsAug = $request->cogsAug;
            $salesBudget->cogsSep = $request->cogsSep;
            $salesBudget->cogsOct = $request->cogsOct;
            $salesBudget->cogsNov = $request->cogsNov;
            $salesBudget->cogsDec = $request->cogsDec;
            $salesBudget->cogsTotal = ($request->cogsJan + $request->cogsFeb + $request->cogsMar + $request->cogsApr + $request->cogsMay + $request->cogsJun + $request->cogsJul + $request->cogsAug + $request->cogsSep + $request->cogsOct + $request->cogsNov + $request->cogsDec);
            $salesBudget->oeJan = $request->oeJan;
            $salesBudget->oeFeb = $request->oeFeb;
            $salesBudget->oeMar = $request->oeMar;
            $salesBudget->oeApr = $request->oeApr;
            $salesBudget->oeMay = $request->oeMay;
            $salesBudget->oeJun = $request->oeJun;
            $salesBudget->oeJul = $request->oeJul;
            $salesBudget->oeAug = $request->oeAug;
            $salesBudget->oeSep = $request->oeSep;
            $salesBudget->oeOct = $request->oeOct;
            $salesBudget->oeNov = $request->oeNov;
            $salesBudget->oeDec = $request->oeDec;
            $salesBudget->oeTotal = ($request->oeJan + $request->oeFeb + $request->oeMar + $request->oeApr + $request->oeMay + $request->oeJun + $request->oeJul + $request->oeAug + $request->oeSep + $request->oeOct + $request->oeNov + $request->oeDec);
            $salesBudget->recJan = $request->recJan;
            $salesBudget->recFeb = $request->recFeb;
            $salesBudget->recMar = $request->recMar;
            $salesBudget->recApr = $request->recApr;
            $salesBudget->recMay = $request->recMay;
            $salesBudget->recJun = $request->recJun;
            $salesBudget->recJul = $request->recJul;
            $salesBudget->recAug = $request->recAug;
            $salesBudget->recSep = $request->recSep;
            $salesBudget->recOct = $request->recOct;
            $salesBudget->recNov = $request->recNov;
            $salesBudget->recDec = $request->recDec;
            $salesBudget->recTotal = ($request->recJan + $request->recFeb + $request->recMar + $request->recApr + $request->recMay + $request->recJun + $request->recJul + $request->recAug + $request->recSep + $request->recOct + $request->recNov + $request->recDec);
            $salesBudget->createdBy = 0;
            $salesBudget->save();
        } else {
            $budget->salesJan = $request->salesJan;
            $budget->salesFeb = $request->salesFeb;
            $budget->salesMar = $request->salesMar;
            $budget->salesApr = $request->salesApr;
            $budget->salesMay = $request->salesMay;
            $budget->salesJun = $request->salesJun;
            $budget->salesJul = $request->salesJul;
            $budget->salesAug = $request->salesAug;
            $budget->salesSep = $request->salesSep;
            $budget->salesOct = $request->salesOct;
            $budget->salesNov = $request->salesNov;
            $budget->salesDec = $request->salesDec;
            $budget->salesTotal = ($request->salesJan + $request->salesFeb + $request->salesMar + $request->salesApr + $request->salesMay + $request->salesJun + $request->salesJul + $request->salesAug + $request->salesSep + $request->salesOct + $request->salesNov + $request->salesDec);
            $budget->cogsJan = $request->cogsJan;
            $budget->cogsFeb = $request->cogsFeb;
            $budget->cogsMar = $request->cogsMar;
            $budget->cogsApr = $request->cogsApr;
            $budget->cogsMay = $request->cogsMay;
            $budget->cogsJun = $request->cogsJun;
            $budget->cogsJul = $request->cogsJul;
            $budget->cogsAug = $request->cogsAug;
            $budget->cogsSep = $request->cogsSep;
            $budget->cogsOct = $request->cogsOct;
            $budget->cogsNov = $request->cogsNov;
            $budget->cogsDec = $request->cogsDec;
            $budget->cogsTotal = ($request->cogsJan + $request->cogsFeb + $request->cogsMar + $request->cogsApr + $request->cogsMay + $request->cogsJun + $request->cogsJul + $request->cogsAug + $request->cogsSep + $request->cogsOct + $request->cogsNov + $request->cogsDec);
            $budget->oeJan = $request->oeJan;
            $budget->oeFeb = $request->oeFeb;
            $budget->oeMar = $request->oeMar;
            $budget->oeApr = $request->oeApr;
            $budget->oeMay = $request->oeMay;
            $budget->oeJun = $request->oeJun;
            $budget->oeJul = $request->oeJul;
            $budget->oeAug = $request->oeAug;
            $budget->oeSep = $request->oeSep;
            $budget->oeOct = $request->oeOct;
            $budget->oeNov = $request->oeNov;
            $budget->oeDec = $request->oeDec;
            $budget->oeTotal = ($request->oeJan + $request->oeFeb + $request->oeMar + $request->oeApr + $request->oeMay + $request->oeJun + $request->oeJul + $request->oeAug + $request->oeSep + $request->oeOct + $request->oeNov + $request->oeDec);
            $budget->recJan = $request->recJan;
            $budget->recFeb = $request->recFeb;
            $budget->recMar = $request->recMar;
            $budget->recApr = $request->recApr;
            $budget->recMay = $request->recMay;
            $budget->recJun = $request->recJun;
            $budget->recJul = $request->recJul;
            $budget->recAug = $request->recAug;
            $budget->recSep = $request->recSep;
            $budget->recOct = $request->recOct;
            $budget->recNov = $request->recNov;
            $budget->recDec = $request->recDec;
            $budget->recTotal = ($request->recJan + $request->recFeb + $request->recMar + $request->recApr + $request->recMay + $request->recJun + $request->recJul + $request->recAug + $request->recSep + $request->recOct + $request->recNov + $request->recDec);
            $budget->updatedBy = 0;
            $budget->save();
        }

        return redirect()->back()->with('message', 'Customer has been created successfully.');
    }
}
