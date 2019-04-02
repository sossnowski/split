<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//test commit 

class BillTransaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bill_id', 'bill_participant_id_from', 'bill_participant_id_to', 'amount'
    ];

    // transaction belongs to one bill
    public function TransactionBill()
    {
        return $this->belongsTo('App\Models\Bill');
    }

    // transaction belongs to one participant
    public function transactionParticipant()
    {
        return $this->belongsTo('App\Models\BillParticipant');
    }
}
