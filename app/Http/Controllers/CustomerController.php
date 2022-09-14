<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function customerInfo($id)
    {
        $customerById= Customer::find($id);
        $customer = Customer::all();
            return view('frontEnd.customers.customer', [
                'customer' => $customer,
                'customerById' => $customerById
            ]);
    }

    public function createCustomerInfo(Request $request){
        if ($request->customerId==0) {
            $customer = new Customer();
            $customer->customerName = $request->customerName;
            $customer->customerEmail = $request->customerEmail;
            $customer->billTo = $request->billTo;
            $customer->shipTo = $request->shipTo;
            $customer->contact1Name = $request->contact1Name;
            $customer->contact1Designation = $request->contact1Designation;
            $customer->contact1Mobile = $request->contact1Mobile;
            $customer->contact2Name = $request->contact2Name;
            $customer->contact2Designation = $request->contact2Designation;
            $customer->contact2Mobile = $request->contact2Mobile;
//            $customer->contact3Name = $request->contact3Name;
//            $customer->contact3Designation = $request->contact3Designation;
//            $customer->contact3Mobile = $request->contact3Mobile;
//            $customer->contact4Name = $request->contact4Name;
//            $customer->contact4Designation = $request->contact4Designation;
//            $customer->contact4Mobile = $request->contact4Mobile;
//            $customer->contact5Name = $request->contact5Name;
//            $customer->contact5Designation = $request->contact5Designation;
//            $customer->contact5Mobile = $request->contact5Mobile;
            $customer->createdBy = 0;
            $customer->updatedBy = 0;
            $customer->status = $request->status;
            $customer->save();
            return redirect('customerInfo/0')->with('message','Customer Info Add Successfully');
        }else{
            $customer= Customer::find($request->customerId);
            $customer->customerName = $request->customerName;
            $customer->customerEmail = $request->customerEmail;
            $customer->billTo = $request->billTo;
            $customer->shipTo = $request->shipTo;
            $customer->contact1Name = $request->contact1Name;
            $customer->contact1Designation = $request->contact1Designation;
            $customer->contact1Mobile = $request->contact1Mobile;
            $customer->contact2Name = $request->contact2Name;
            $customer->contact2Designation = $request->contact2Designation;
            $customer->contact2Mobile = $request->contact2Mobile;
//            $customer->contact3Name = $request->contact3Name;
//            $customer->contact3Designation = $request->contact3Designation;
//            $customer->contact3Mobile = $request->contact3Mobile;
//            $customer->contact4Name = $request->contact4Name;
//            $customer->contact4Designation = $request->contact4Designation;
//            $customer->contact4Mobile = $request->contact4Mobile;
//            $customer->contact5Name = $request->contact5Name;
//            $customer->contact5Designation = $request->contact5Designation;
//            $customer->contact5Mobile = $request->contact5Mobile;
            $customer->createdBy = 0;
            $customer->updatedBy = 0;
            $customer->status = $request->status;
            $customer->save();
            return redirect('customerInfo/0')->with('updateMessage','Customer Info Update Successfully');
        }
    }
}
