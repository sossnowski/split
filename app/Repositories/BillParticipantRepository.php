<?php

namespace App\Repositories;


class BillParticipantRepository
{
    /**
     * @param array $data
     * @return Bill
     */
    public function create($bill, array $billParticipants )
    {
        
        return $bill->billParticipants()->createMany($billParticipants);
    }

    
}