<?php

namespace App\Repositories;

use App\Models\Bill;

class BillRepository
{
    /**
     * @param array $data
     * @return Bill
     */
    public function create(array $data)
    {
        return Bill::create($data);
    }
}