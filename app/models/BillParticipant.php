<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//comment to test new commit once again

class BillParticipant extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bill_id', 'name', 'amount', 'is_confirmed', 'bill_participant_id_owner'
    ];
}
