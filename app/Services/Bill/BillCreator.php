<?php

namespace App\Services;

use App\Repositories\BillRepository;

class BillCreator
{
    protected $billRepository;

    /**
     * BillCreator constructor.
     * @param BillRepository $billRepository
     */
    public function __construct(BillRepository $billRepository)
    {
        $this->billRepository = $billRepository;
    }

    /**
     * @param array $data
     * @return \App\Models\Bill
     */
    public function create(array $data)
    {
        return $this->billRepository->create($data);
    }
}