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
        return  Bill::create([
            'name' => $data['name'],
            'number' => $data['number']
        ]);

    }

    public function deleteBill($id)
    {
        return Bill::destroy($id);
    }
}