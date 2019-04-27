<?php

namespace App\Services;

use App\Repositories\BillRepository;
use App\Repositories\BillParticipantRepository;
use App\Services\BillTransactions;
use Response;

class BillCreator
{
    protected $billRepository;
    protected $billParticipantRepository;
    protected $billTransactions;

    /**
     * BillCreator constructor.
     * @param BillRepository $billRepository
     * @param BillParticipantRepository $billParticipantRepository
     * @param BillTransactions $billTransactions
     */
    public function __construct(BillRepository $billRepository, BillParticipantRepository $billParticipantRepository, BillTransactions $billTransactions)
    {
        $this->billRepository = $billRepository;
        $this->billParticipantRepository = $billParticipantRepository;
        $this->billTransactions = $billTransactions;
    }

    /**
     * @param array $data
     * @return \App\Models\Bill
     */
    public function create(array $data)
    {
        $bill = $this->billRepository->create($data);
        $billParticipants = array();

        foreach ($data['participants'] as $participant) {
            array_push($billParticipants, [
                'name' => $participant['name'],
                'amount' => $participant['amount'],
                'is_confirmed' => 0,
            ]);
        }

        if($this->billParticipantRepository->create($bill, $billParticipants)) {
            $transactions = $this->billTransactions->calcEqual($bill);
            return Response::json([
                'success' => true,
                'transactions' => $transactions
            ], 201);
        }else {
            return Response::json([
                'success' => false
            ], 400);
        }


        
    }
}