<?php

namespace App\Services;

use App\Repositories\BillRepository;
use App\Repositories\BillParticipantRepository;
use App\Services\BillTransactions;
use Response;
use App\Models\Bill;

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
     * @return Response 
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
            if($this->billTransactions->calcEqual($bill)) {
                return Response::json([
                    'success' => true
                ], 201);
            } else {
                return Response::json([
                    'success' => false
                ], 400);
            }
        }else {
            return Response::json([
                'success' => false
            ], 400);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function updateBill($request, $id)
    {
        if($this->billRepository->deleteBill($id)) {
            return $this->create($request->toArray());
        }
    }
}