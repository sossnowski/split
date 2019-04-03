<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BillTransactions;

class BillTransactionsController extends Controller
{

    protected $billTransactions;

    /**
     * BillsController constructor.
     * @param BillTransactions $billCreator
     */
    public function __construct(BillTransactions $billTransactions)
    {
        $this->billTransactions = $billTransactions;
    }

    /**
     * @param integer $id
     * @return array $transactions 
     */
    public function calcEqual($id)
    {
        return $this->billTransactions->calcEqual($id);
    }
}
