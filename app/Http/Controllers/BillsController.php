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
        
        //return new BillResource($bill); // wywala response z odpowiednimi polami (jak wejdziesz w klase bedziesz mial info co i jak) i w odpowiednim formacie (JSON).
    }

    public function getBills()
    {
        return $this->billDisplayer->getBills();


        // return new BillResource(Bill::get()); // wywala response z odpowiednimi polami (jak wejdziesz w klase bedziesz mial info co i jak) i w odpowiednim formacie (JSON).
    }
}
