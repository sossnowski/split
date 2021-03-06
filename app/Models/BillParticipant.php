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
        'bill_id', 'name', 'amount', 'is_confirmed', 'bill_participant_id_owner', 'purpose'
    ];

    // bill participant belongs to one bill
    public function bill()
    {
        return $this->belongsTo('App\Models\Bill');
    }

    // bill participant has many transactions
    public function billParticipantTransactions()
    {
        return $this->hasMany('App\Models\BillTransaction');
    }
}
