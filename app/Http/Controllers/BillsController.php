<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBillRequest;
use App\Http\Resources\BillResource;
use App\Repository\BillRepository;
use App\Services\BillCreator;
use App\Services\BillDisplayer;
use Illuminate\Http\Request;
use App\Models\Bill;

class BillsController extends Controller
{
    protected $billCreator;
    protected $billDisplayer;

    /**
     * BillsController constructor.
     * @param BillCreator $billCreator
     */
    public function __construct(BillCreator $billCreator, BillDisplayer $billDisplayer)
    {
        $this->billCreator = $billCreator;
        $this->billDisplayer = $billDisplayer;
    }

    /**
     * @param CreateBillRequest $request
     * @return BillResource
     */
    public function create(CreateBillRequest $request)
    {
        return $bill = $this->billCreator->create($request->post());
    }

    /**
     * @return array
     */
    public function getBills()
    {
        return $this->billDisplayer->getBills();
    }

    public function getBill(Request $request)
    {
        return $this->billDisplayer->getBill($request->id);
    }

    /**
     * @param Request $request
     * @param $id
     * @return 
     */
    public function upadateBill(Request $request, $id)
    {
        return $this->billCreator->updateBill($request, $id);
    }
}
