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
        if($this->billParticipantRepository->create($data, $bill)) {
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