<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Creditor;
use Illuminate\Http\Request;

class CreditorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $creditors = Creditor::all();
        if(! $creditors->count() > 0 )
        {
            return response()->json([
                'status' => 404,
                'creditors' => 'Nothing Found'
            ], 404);
        }
        return response()->json([
            'status' => 200,
            'creditors' => Creditor::all()
        ], 200);
    }



    /**
     * Display the specified resource.
     */
    public function show(Creditor $creditor)
    {
        //
        if ( ! $creditor)
        {
            return response()->json([
                'status' => 404,
                'creditor' => 'No Such Creditor'
            ], 200);

        }
        $remaining = $this->remaining($creditor);
        return response()->json([
            'status' => 200,
            'creditor' => $creditor,
            'remaining' => $remaining
        ], 200);


    }

    protected function remaining(Creditor $creditor)
    {
        $total = 0;
        foreach($creditor->payments as $payment)
        {
            $total+= $payment->percentage;
        }

        return 100 - $total;
    }

}
