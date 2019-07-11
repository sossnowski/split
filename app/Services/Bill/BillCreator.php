<?php

namespace App\Services;

use App\Repositories\BillParticipantRepository;
use App\Repositories\BillRepository;
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
     * @param \App\Services\BillTransactions $billTransactions
     */
    public function __construct(BillRepository $billRepository, BillParticipantRepository $billParticipantRepository, BillTransactions $billTransactions)
    {
        $this->billRepository = $billRepository;
        $this->billParticipantRepository = $billParticipantRepository;
        $this->billTransactions = $billTransactions;
    }


    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $data['number'] = date('Y').date('m').date('d').date('H').date('i').date('s').rand(101,999);
        $bill = $this->billRepository->create($data);
        $billParticipants = array();

        foreach ($data['participants'] as $participant) {
            foreach ($participant['expenses'] as $expense){
                array_push($billParticipants, [
                    'name' => $participant['name'],
                    'amount' => $expense['amount'],
                    'purpose' => $expense['purpose'],
                    'is_confirmed' => 0,
                ]);
            }
        }

        if($this->billParticipantRepository->create($bill, $billParticipants)) {
            return $this->billTransactions->calcEqual($bill);
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
