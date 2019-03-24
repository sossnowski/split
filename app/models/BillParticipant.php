<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
