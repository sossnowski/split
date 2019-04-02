<?php

namespace App\Repositories;

use App\Models\BillParticipant;

class BillParticipantRepository
{
    /**
     * @param array $data
     * @return Bill
     */
    public function create(array $billParticipants, $bill)
    {
        
        return $bill->billParticipants()->createMany($billParticipants);
    }
}