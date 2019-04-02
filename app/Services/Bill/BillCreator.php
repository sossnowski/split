<?php

namespace App\Services;

use App\Repositories\BillRepository;
use App\Repositories\BillParticipantRepository;

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
        //partition data on bill and billParticipants
        // $billData = [
        //     'name' => $data['name']
        // ];
        $bill = $this->billRepository->create($data);

        // $billParticipantData = [
        //     'bill_id' => $billId,
        //     'is_confirmed' => 0,
        //     'bill_participant_id_owner' => $data['bill_participant_id_owner'],
        //     'participants' => $data['participants']
        // ];

        return $this->billParticipantRepository->create($data, $bill);
        
    }
}