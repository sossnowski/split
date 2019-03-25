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
}
