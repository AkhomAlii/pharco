<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Models\Creditor;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentsController extends Controller
{

    protected function remaining(Creditor $creditor)
    {
        $paid = 0;
        foreach($creditor->payments  as $payment){
            $paid += $payment->percentage;
        }

        return 100 - $paid;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaymentRequest $request)
    {
        $creditor = Creditor::find($request->creditor_id);

        if($request->PERCENTAGE > $this->remaining($creditor))
        {
            return response()->json([
                'status' => 419,
                'message' => 'The remaining amount is only:' . $this->remaining($creditor)
            ], 419);
        }

        $seq = DB::table('DUAL')->select('cred_seq.nextval')->get()[0];
        Payment::create([
            'id' => $seq->nextval,
            'creditor_id' => $request->creditor_id,
            'DOCUMENT' => $request->DOCUMENT,
            'DUE_DAYS' => $request->DUE_DAYS,
            'EXPENSE_CODE' => $request->EXPENSE_CODE,
            'CURRENCY' => $request->CURRENCY,
            'EX_RATE' => $request->EX_RATE,
            'AMOUNT_TYPE' => $request->AMOUNT_TYPE,
            'PERCENTAGE' => $request->PERCENTAGE,
            'PAYMENT_METHOD' => $request->PAYMENT_METHOD,
            'NOTES' => $request->NOTES
        ]);


        return response()->json([
            'status' => 200,
            'message' => 'Payment Created Successfully'
        ], 200);

    }



    /**
     * Update the specified resource in storage.
     */
    public function update(PaymentRequest $request, Payment $payment)
    {


        $creditor = Creditor::find($payment->creditor->id);


        if($request->PERCENTAGE > $this->remaining($creditor) + $request->PERCENTAGE)
        {
            return response()->json([
                'status' => 419,
                'message' => 'The remaining amount is only:' . $this->remaining($creditor)
            ], 419);
        }
        $payment->update([
            'DOCUMENT' => $request->DOCUMENT,
            'DUE_DAYS' => $request->DUE_DAYS,
            'EXPENSE_CODE' => $request->EXPENSE_CODE,
            'CURRENCY' => $request->CURRENCY,
            'EX_RATE' => $request->EX_RATE,
            'AMOUNT_TYPE' => $request->AMOUNT_TYPE,
            'PERCENTAGE' => $request->PERCENTAGE,
            'PAYMENT_METHOD' => $request->PAYMENT_METHOD,
            'NOTES' => $request->NOTES
        ]);


        return response()->json([
            'status' => 200,
            'message' => 'Payment Updated Successfully'
        ], 200);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
        if(! $payment)
        {
            return response()->json([
                'status' => 404,
                'message' => 'No Such A Payment'
            ], 404);
        }
        $payment->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Payment Deleted Successfully'
        ], 200);
    }
}
