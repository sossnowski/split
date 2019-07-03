<?php

namespace App\Services;

use App\Models\Bill;
use App\Http\Resources\BillResource;


class BillDisplayer
{
    public function getBills()
    {
        $bills = Bill::with(['billParticipants', 'billTransactions'])->get();
        $billData = array();
        
        foreach ($bills as $bill) {
            array_push($billData,
            [
                'bill' => new BillResource($bill),
            ]);
        }
        return $billData;
    }
    
}