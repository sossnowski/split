<?php

namespace App\Services;

use App\Models\Bill;
use App\Http\Resources\BillResource;
use Response;


class BillDisplayer
{
    /**
     * @return array
     */
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

    public function getBill($id)
    {
        $bill = Bill::with(['billParticipants', 'billTransactions'])->where('id', $id)->get();
//        dd(count($bill));
        return count($bill) !== 0 ? $bill :
            Response::json([
                'success' => false
            ], 404);
    }
    
}
