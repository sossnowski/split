<?php

namespace App\Services;

use App\Models\Bill;
use App\Models\BillParticipant;
use App\Models\BillTransaction;
use App\Http\Resources\BillResource;
use Response;
use DB;


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
        $bill = Bill::with(['billParticipants:bill_id,name,amount,purpose'])
        ->where('number', $id)->first(['name', 'id']);
        if ($bill !== null) {
            $billTransactions = BillTransaction::join('bill_participants AS billParticipantFrom', 'billParticipantFrom.id', '=', 'bill_transactions.bill_participant_id_from')
            ->join('bill_participants as billParticipantTo', 'billParticipantTo.id', '=', 'bill_transactions.bill_participant_id_to')
            ->select(['billParticipantFrom.name as participantFrom', 'billParticipantTo.name as participantTo', 'bill_transactions.amount'])
            ->where('bill_transactions.bill_id', $bill->id)->get();
        } else {
            return Response::json([
                'success' => false
            ], 404);
        }
        // $billParticipants = BillParticipant::with(['billParticipantTransactions'])->where('bill_id', $bill->id)->get();
        
        return [
            "bill" => $bill, 
            "billTransactions" => $billTransactions
        ];
            
    }
    
}
