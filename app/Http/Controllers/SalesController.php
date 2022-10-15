<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Sales;
use App\Models\SalesBudget;
use App\Models\SalesDetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function sales()
    {
        $date= date('Y-m-d', strtotime(now()));
        $customers = Customer::where('status', 1)->get();
        $product = Product::where('status', 1)->get();
        $sales= DB::select("SELECT s.id, s.invoice, s.invoiceDate, s.customerId, c.customerName, s.customerPo, s.totalAmount, s.balanceDue, s.paymentStatus FROM sales s LEFT JOIN customers c ON c.id=s.customerId WHERE DATE(s.created_at) BETWEEN '$date' AND '$date'");

        return view('frontEnd.sales.sales', [
            'customers' => $customers,
            'product' => $product,
            'sales'=>$sales
        ]);
    }

    public function salesEdit($id)
    {
        $customers = Customer::where('status', 1)->get();
        $product = Product::where('status', 1)->get();
        $sales = DB::select("SELECT s.id, s.invoice, s.invoiceDate, s.salesAmount, s.vat, s.others, s.totalAmount, s.advance, pa.paymentMethod AS payMethod, pa.details AS paymentMethod, s.balanceDue, s.notes, s.customerId, c.customerName, s.customerPo, c.billTo, c.shipTo, c.contact1Name, c.contact2Name FROM sales s LEFT JOIN customers c ON c.id=s.customerId LEFT JOIN payments pa ON pa.salesId=s.id WHERE s.id='$id'");

        $invoice=$sales[0]->invoice;
        $invoiceDate=$sales[0]->invoiceDate;
        $salesDetails=DB::select("SELECT p.id, p.productNumber, p.productName, s.qty, s.unit, s.unitPrice, s.discountPer, s.amount FROM sales_details s LEFT JOIN products p ON p.id=s.itemId WHERE s.invoice='$invoice' AND s.invoiceDate='$invoiceDate'");

        return view('frontEnd.sales.salesEdit', [
            'customers' => $customers,
            'product' => $product,
            'sales'=>$sales,
            'salesDetails'=>$salesDetails
        ]);
    }

    public function salesRecordInsert(Request $request)
    {
        $this->validate($request, [
            'invoice' => 'required',
            'customerId' => 'required',
            'customerPo' => 'required',
            'salesAmount' => 'required',
            'totalAmount' => 'required'
        ]);
        for ($i = 1; $i < 11; $i++) {
            $invoice = $request->invoice;
            $itemCode = "itemCode" . $i;
            $totalAmount = "totalAmount" . $i;
            $qty = "qty" . $i;
            $unit = "units" . $i;
            $unitPrice = "unitPrice" . $i;
            $discountPer = "discount" . $i;
            if ($request->$itemCode > 0 and $request->$totalAmount > 0) {
                $sales = new SalesDetails();
                $sales->type = $request->type;
                $sales->invoice = $request->invoice;
                $sales->invoiceDate = $request->invoiceDate;
                $sales->customerId = $request->customerId;
                $sales->itemId = $request->$itemCode;
                $sales->qty = $request->$qty;
                $sales->unit = $request->$unit;
                $sales->unitPrice = $request->$unitPrice;
                $sales->discountPer = $request->$discountPer;
                $sales->amount = $request->$totalAmount;
                $sales->save();
            }
        }
        $salesDetails = DB::table('sales_details')
            ->groupBy('invoice')
            ->select('invoice')
            ->where('invoice', '=', $invoice)
            ->first();
        if ($salesDetails) {
            $sales = new Sales();
            $sales->type = $request->type;
            $sales->invoice = $request->invoice;
            $sales->invoiceDate = $request->invoiceDate;
            $sales->customerId = $request->customerId;
            $sales->customerPo = $request->customerPo;
            $sales->billTo = $request->billTo;
            $sales->billToContact = $request->billToContact;
            $sales->shipTo = $request->shipTo;
            $sales->shipToContact = $request->shipToContact;
            $sales->salesAmount = $request->salesAmount;
            $sales->vat = $request->vat;
            $sales->others = $request->others;
            $sales->totalAmount = $request->totalAmount;
            $sales->advance = $request->advance;
            $sales->paymentMethod = $request->paymentMethod;
            $sales->balanceDue = $request->balance;
            $sales->notes = $request->notes;
            if ($request->balance > 0) {
                $paymentStatus = 0;
            } else {
                $paymentStatus = 1;
            }
            $sales->paymentStatus = $paymentStatus;
            $sales->save();

            $salesId = Sales::where('invoice', '=', $request->invoice)->first();
            if ($request->advance > 0) {
                $payment = new Payment();
                $payment->paymentDate = $request->invoiceDate;
                $payment->customerId = $request->customerId;
                $payment->receivedId = $request->customerPo;
                $payment->memo = $request->invoice;
                $payment->paymentMethod = $request->payMethod;
                $payment->details = $request->paymentMethod;
                $payment->depositTo = 0;
                $payment->salesId = $salesId->id;
                $payment->invoice = $request->invoice;
                $payment->invoiceDate = $request->invoiceDate;
                $payment->discountAmount = 0;
                $payment->receivedAmount = $request->advance;
                $payment->save();
            }

            return redirect()->back()->with('message', 'Received has been created successfully.');
        }

        return redirect()->back()->with('message', 'Received can not be Possible.');
    }

    public function salesRecordEdit(Request $request)
    {
        $this->validate($request, [
            'invoice' => 'required',
            'customerId' => 'required',
            'salesAmount' => 'required',
            'totalAmount' => 'required'
        ]);

        if ($request->salesAmount > 0) {
            $sales = Sales::find($request->salesId);
            $sInvoice = $sales->invoice;
            $sInvoiceDate = $sales->invoiceDate;
            $sales->type = $request->type;
            $sales->invoice = $request->invoice;
            $sales->invoiceDate = $request->invoiceDate;
            $sales->customerId = $request->customerId;
            $sales->customerPo = $request->customerPo;
            $sales->billTo = $request->billTo;
            $sales->billToContact = $request->billToContact;
            $sales->shipTo = $request->shipTo;
            $sales->shipToContact = $request->shipToContact;
            $sales->salesAmount = $request->salesAmount;
            $sales->vat = $request->vat;
            $sales->others = $request->others;
            $sales->totalAmount = $request->totalAmount;
            $sales->advance = $request->advance;
            $sales->paymentMethod = $request->paymentMethod;
            $sales->balanceDue = $request->balance;
            $sales->notes = $request->notes;
            if ($request->balance > 0) {
                $paymentStatus = 0;
            } else {
                $paymentStatus = 1;
            }
            $sales->paymentStatus = $paymentStatus;
            $sales->save();

            DB::table('sales_details')
                ->where('invoice', $sInvoice)
                ->where('invoiceDate', $sInvoiceDate)
                ->delete();

            for ($i = 1; $i < 11; $i++) {
                $itemCode = "itemCode" . $i;
                $totalAmount = "totalAmount" . $i;
                $qty = "qty" . $i;
                $unit = "units" . $i;
                $unitPrice = "unitPrice" . $i;
                $discountPer = "discount" . $i;
                if ($request->$itemCode > 0 and $request->$totalAmount > 0) {
                    $sales = new SalesDetails();
                    $sales->type = $request->type;
                    $sales->invoice = $request->invoice;
                    $sales->invoiceDate = $request->invoiceDate;
                    $sales->customerId = $request->customerId;
                    $sales->itemId = $request->$itemCode;
                    $sales->qty = $request->$qty;
                    $sales->unit = $request->$unit;
                    $sales->unitPrice = $request->$unitPrice;
                    $sales->discountPer = $request->$discountPer;
                    $sales->amount = $request->$totalAmount;
                    $sales->save();
                }
            }

            $salesDetails = DB::table('sales_details')
                ->groupBy('invoice')
                ->select('invoice')
                ->where('invoice', '=', $request->invoice)
                ->first();

            if ($salesDetails) {
                if ($request->advance > 0) {
                    DB::table('payments')->where('salesId', $request->salesId)->delete();
                    $payment = new Payment();
                    $payment->paymentDate = $request->invoiceDate;
                    $payment->customerId = $request->customerId;
                    $payment->receivedId = $request->customerPo;
                    $payment->memo = $request->invoice;
                    $payment->paymentMethod = $request->payMethod;
                    $payment->details = $request->paymentMethod;
                    $payment->depositTo = 0;
                    $payment->salesId = $request->salesId;
                    $payment->invoice = $request->invoice;
                    $payment->invoiceDate = $request->invoiceDate;
                    $payment->discountAmount = 0;
                    $payment->receivedAmount = $request->advance;
                    $payment->save();
                }
            }
        }

        $customers = Customer::where('status', 1)->get();
        $sales = DB::select("SELECT s.id, s.invoice, s.invoiceDate, s.customerId, c.customerName, s.customerPo, s.totalAmount, s.balanceDue, s.paymentStatus FROM sales s LEFT JOIN customers c ON c.id=s.customerId WHERE s.invoiceDate BETWEEN '$request->invoiceDate' AND '$request->invoiceDate'");

        return view('frontEnd.sales.salesRegister', [
            'customers' => $customers,
            'sales' => $sales
        ]);
    }

    public function customerBillTo(Request $request)
    {
        $customer = Customer::where('id', $request->customerId)->first();
        $output = "";

        $output .= '
            <div class="form-group row">
                <label class="col-sm-4 col-form-label col-form-label-sm text-right">Bill to:</label>
                <div class="col-sm-8">
                    <textarea name="billTo" class="form-control form-control-sm" rows="1" readonly>' . $customer->billTo . '</textarea>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label col-form-label-sm text-right">Bill Con.:</label>
                <div class="col-sm-8">
                    <textarea name="billToContact" class="form-control form-control-sm" rows="1" readonly>' . $customer->contact1Name . '</textarea>
                </div>
            </div>

        ';

        echo $output;
    }

    public function customerShipTo(Request $request)
    {
        $customer = Customer::where('id', $request->customerId)->first();
        $output = "";

        $output .= '
            <div class="form-group row">
                <label class="col-sm-4 col-form-label col-form-label-sm text-right">Ship to:</label>
                <div class="col-sm-8">
                    <textarea name="shipTo" class="form-control form-control-sm" rows="1" readonly>' . $customer->shipTo . '</textarea>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label col-form-label-sm text-right">Ship Con.:</label>
                <div class="col-sm-8">
                    <textarea name="shipToContact" class="form-control form-control-sm" rows="1" readonly>' . $customer->contact2Name . '</textarea>
                </div>
            </div>

        ';

        echo $output;
    }

    public function itemName(Request $request)
    {
        $product = Product::where('status', 1)->get();
        $productById = Product::where('id', $request->itemId)->first();
        $output = "";
        $output .= '
            <option value="' . $productById->id . '">' . $productById->productName . '</option>
        ';
        foreach ($product as $item)
            $output .= '
                <option value="' . $item->id . '">' . $item->productName . '</option>
            ';
        echo $output;
    }

    public function itemCode(Request $request)
    {
        $product = Product::where('status', 1)->get();
        $productById = Product::where('id', $request->itemId)->first();
        $output = "";
        $output .= '
            <option value="' . $productById->id . '">' . $productById->productNumber . '</option>
        ';
        foreach ($product as $item)
            $output .= '
                <option value="' . $item->id . '">' . $item->productNumber . '</option>
            ';
        echo $output;
    }

    public function others(Request $request)
    {
        $productById = Product::where('id', $request->itemId)->first();

        $salesDetails = DB::table('sales_details')
            ->where('customerId', '=', $request->customerId)
            ->where('itemId', '=', $request->itemId)
            ->groupBy('unitPrice')
            ->orderByDesc('unitPrice')
            ->select('unitPrice')
            ->first();

        $output['unit'] = $productById->sellingUnit;
        if ($salesDetails) {
            $output['unitPrice'] = $salesDetails->unitPrice;
        } else {
            $output['unitPrice'] = $productById->sellingPrice;
        }
        return \Response::json($output);
    }

    public function salesRegister()
    {
        $date= date('Y-m-d', strtotime(now()));
        $customers = Customer::where('status', 1)->get();
        $sales= DB::select("SELECT s.id, s.invoice, s.invoiceDate, s.customerId, c.customerName, s.customerPo, s.totalAmount, s.balanceDue, s.paymentStatus FROM sales s LEFT JOIN customers c ON c.id=s.customerId WHERE s.invoiceDate BETWEEN '$date' AND '$date'");

        return view('frontEnd.sales.salesRegister', [
            'customers'=>$customers,
            'sales'=>$sales
        ]);
    }

    public function salesReg(Request $request)
    {
        $header = "";
        $footer = "";
        $totalSalesAmount = null;
        $totalBalanceDue = null;
        if ($request->customerId!=""){
            $sales = DB::select("SELECT s.id, s.invoice, s.invoiceDate, s.customerId, c.customerName, s.customerPo, s.totalAmount, s.balanceDue, s.paymentStatus FROM sales s LEFT JOIN customers c ON c.id=s.customerId WHERE s.customerId='$request->customerId' AND s.invoiceDate BETWEEN '$request->fDate' AND '$request->tDate'");
        }else{
            $sales = DB::select("SELECT s.id, s.invoice, s.invoiceDate, s.customerId, c.customerName, s.customerPo, s.totalAmount, s.balanceDue, s.paymentStatus FROM sales s LEFT JOIN customers c ON c.id=s.customerId WHERE s.invoiceDate BETWEEN '$request->fDate' AND '$request->tDate'");
        }
        foreach ($sales as $sale) {
            $totalSalesAmount = $totalSalesAmount + $sale->totalAmount;
            $totalBalanceDue = $totalBalanceDue + $sale->balanceDue;
            $header .= '
                <tr>
                    <td class="text-center">' . date('d-m-Y', strtotime($sale->invoiceDate)) . '</td>
                    <td class="text-left"><span>' . $sale->invoice . '</span></td>
                    <td class="text-left"><span>' . $sale->customerPo . '</span></td>
                    <td class="text-left"><span>' . $sale->customerName . '</span></td>
                    <td class="text-right"><span>' . $sale->totalAmount . '</span></td>
                    <td class="text-right"><span>' . $sale->balanceDue . '</span></td>
                    <td class="text-center"><span>Order</span></td>
                    <td class="text-center">';
            if ($sale->paymentStatus == 0) {
                $header .= '<a href="/sales-edit/'.$sale->id.'" target="_blank" class="btn btn-primary btn-sm">Edit</a>';
            }
            $header .= '</td>
                </tr>
            ';
        }
        $footer .= '
            <tr>
                <td class="bg-info"></td>
                <td class="bg-info"></td>
                <td class="bg-info"></td>
                <td class="bg-info"></td>
                <td class="bg-info text-white text-right"><span>' . $totalSalesAmount . '</span></td>
                <td class="bg-info text-white text-right"><span>' . $totalBalanceDue . '</span></td>
                <td class="bg-info"></td>
                <td class="bg-info"></td>
            </tr>
        ';

        $output['header'] = $header;
        $output['footer'] = $footer;
        return $output;
    }

}
