<?php
namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReceivedPaymentController extends Controller
{
    public function receivePayments()
    {
        $customers = Customer::where('status', 1)->get();
        return view('frontEnd.receivePayments.receivePayments', [
            'customers' => $customers
        ]);
    }

    public function customerReceive(Request $request)
    {
        for ($i = 0; $i < count($request->invoice); $i++) {
            if ($request->appliedAmount[$i] > 0 and $request->appliedAmount[$i] <= $request->dueAmount[$i]) {
                $payment = new Payment();
                $payment->paymentDate = $request->paymentDate;
                $payment->customerId = $request->customerId;
                $payment->receivedId = $request->receivedId;
                $payment->memo = $request->memo;
                $payment->salesId = $request->salesId[$i];
                $payment->invoice = $request->invoice[$i];
                $payment->invoiceDate = $request->salesDate[$i];
                $payment->dueAmount = $request->due[$i];
                $payment->discountAmount = $request->discount[$i];
                $payment->receivedAmount = $request->appliedAmount[$i];
                $payment->paymentMethod = $request->paymentMethod;
                $payment->details = $request->details;
                $payment->depositTo = $request->depositTo;
                $payment->save();

                $dues = $request->dueAmount[$i] - $request->appliedAmount[$i];
                if ($dues == 0) {
                    $status = 1;
                } else {
                    $status = 0;
                }

                $sales = DB::update('update sales set balanceDue = ?, paymentStatus= ? where id = ?', [$dues, $status, $request->salesId[$i]]);
            }
        }
        return redirect()->back()->with('message', 'Payment has been successfully.');
    }

    public function duesById(Request $request)
    {
        $output = "";
        $index = 1;
        $dueBalance = 0;

        $sales = DB::table('sales')
            ->where('customerId', '=', $request->customerId)
            ->where('paymentStatus', '=', 0)
            ->orderBy('invoiceDate')
            ->get();

        foreach ($sales as $item) {
            $dueBalance = $dueBalance + $item->balanceDue;

            $output .= '
            <tr>
                <td class="form-control form-control-sm text-center" readonly>' . $index . '</td>
                <td>
                    <input type="text" name="invoice[]" class="form-control form-control-sm" value="' . $item->invoice . '" readonly>
                    <input type="hidden" name="salesId[]" value="' . $item->id . '">
                </td>
                <td>
                    <input type="date" name="salesDate[]" class="form-control form-control-sm" value="' . $item->invoiceDate . '" readonly>
                </td>
                <td>
                    <input type="text" name="salesAmount[]" class="form-control form-control-sm text-right" value="' . $item->totalAmount . '" readonly>
                </td>
                <td>
                    <input type="number" step="0.01" name="discount[]" id="discount[' . $index . ']" data-index="' . $index . '" class="receive form-control form-control-sm text-right">
                </td>
                <td>
                    <input type="number" step="0.01" name="dueAmount[]" id="dueAmount[' . $index . ']" data-index="' . $index . '" class="receive due form-control form-control-sm text-right" value="' . $item->balanceDue . '" readonly>
                    <input type="hidden" name="due[]" id="due[' . $index . ']" data-index="' . $index . '" class="receive form-control form-control-sm text-right" value="' . $item->balanceDue . '" readonly>
                </td>
                <td>
                    <input type="number" step="0.01" name="appliedAmount[]" id="appliedAmount[' . $index . ']" data-index="' . $index . '" class="receive applied form-control form-control-sm text-right">
                </td>
            </tr>
        ';
            $index++;
        }

        $output .= '
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="bg-info text-white text-right"><span id="totalDueAmount">' . $dueBalance . '</span></td>
                <td class="bg-info text-white text-right"><span id="totalAppliedAmount">0</span></td>
                <input type="hidden" name="totalAppliedAmount1" id="totalAppliedAmount1" value="0">
            </tr>
        ';

        echo $output;
    }

    public function paymentDelete($id)
    {
        $payment = Payment::find($id);
        $sales = Sales::find($payment->salesId);
        $sales->balanceDue = $sales->balanceDue + $payment->discountAmount + $payment->receivedAmount;
        $sales->paymentStatus = 0;
        $sales->save();

        DB::table('payments')
            ->where('id', $id)
            ->delete();

        $customerById = Customer::find($sales->customerId);
        $customers = Customer::where('status', 1)->get();
        $payments = Payment::where('customerId', $sales->customerId)
            ->orderBy('paymentDate')
            ->get();

        $maxDate = DB::select("SELECT MAX(paymentDate) AS maxDate, MIN(paymentDate) AS minDate FROM payments WHERE customerId='$sales->customerId'");

        return view('frontEnd.reports.paymentHistory', [
            'customers' => $customers,
            'customerById' => $customerById,
            'payments' => $payments,
            'fromDate' => $maxDate[0]->minDate,
            'toDate' => $maxDate[0]->maxDate
        ]);
    }
}
