<?php

namespace App\Services;

use App\Repositories\BillRepository;
use App\Repositories\BillParticipantRepository;
use Response;

class BillCreator
{
    protected $billRepository;
    protected $billParticipantRepository;

    /**
     * BillCreator constructor.
     * @param BillRepository $billRepository
     */
    public function __construct(BillRepository $billRepository, BillParticipantRepository $billParticipantRepository)
    {
        $this->billRepository = $billRepository;
        $this->billParticipantRepository = $billParticipantRepository;
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

        if($this->billParticipantRepository->create($billParticipants, $bill)) {
            return Response::json([
                'success' => true
            ], 201);
        }else {
            return Response::json([
                'success' => false
            ], 400);
        }


        
    }
}