<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    // bill has many participants
    public function billParticipants()
    {
        return $this->hasMany('App\Models\BillParticipant');
    }

    // bill has many transactions
    public function billTransactions()
    {
        return $this->hasMany('App\Models\BillTransaction');
    }
}
