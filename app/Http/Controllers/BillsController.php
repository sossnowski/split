<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBillRequest;
use App\Http\Resources\BillResource;
use App\Services\BillCreator;
use Illuminate\Http\Request;

class BillsController extends Controller
{
    protected $billCreator;

    /**
     * BillsController constructor.
     * @param BillCreator $billCreator
     */
    public function __construct(BillCreator $billCreator)
    {
        $this->billCreator = $billCreator;
    }

    /**
     * @param CreateBillRequest $request
     * @return BillResource
     */
    public function create(CreateBillRequest $request)
    {
        $bill = $this->billCreator->create($request->all());

        return new BillResource($bill); // wywala response z odpowiednimi polami (jak wejdziesz w klase bedziesz mial info co i jak) i w odpowiednim formacie (JSON).
    }
}
