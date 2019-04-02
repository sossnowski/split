<?php

namespace App\Repositories;

use App\Models\BillParticipant;

class BillParticipantRepository
{
    /**
     * @param array $data
     * @return Bill
     */
    public function create(array $data, $bill)
    {
        foreach ($data['participants'] as $participant) {
            try {
                $saveParticipant = $bill->billParticipants()->create([
                    'name' => $participant['name'],
                    'amount' => $participant['amount'],
                    'is_confirmed' => 0,
                    'bill_participant_id_owner' => $data['bill_participant_id_owner']
                ]);
            } catch (\Throwable $th) {
                return false;
            }
            
        }
        return true;
    }
}