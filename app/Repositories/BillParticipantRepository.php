<?php

namespace App\Repositories;

use App\Models\BillParticipant;

class BillParticipantRepository
{
    /**
     * @param array $data
     * @return Bill
     */
    public function create(array $data)
    {
        foreach ($data['participants'] as $participant) {
            $participantData = [
                'bill_id' => $data['bill_id'],
                'name' => $participant['name'],
                'amount' => $participant['amount'],
                'is_confirmed' => $data['is_confirmed'],
                'bill_participant_id_owner' => $data['bill_participant_id_owner']
            ];
            BillParticipant::create($participantData);
        }
        return "done";
    }
}