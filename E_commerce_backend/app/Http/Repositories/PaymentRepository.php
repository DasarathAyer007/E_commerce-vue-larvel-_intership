<?php

namespace App\Http\Repositories;
// use App\Http\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Models\Payment;

class PaymentRepository 
{
    public function getAll()
    {
        return Payment::all();
    }

    public function getById($id)
    {
        return Payment::findOrFail($id);
    }

    public function create(array $data)
    {
        return Payment::create($data);
    }

    public function update($id, array $data)
    {
        $Payment = Payment::findOrFail($id);
        $Payment->update($data);
        return $Payment;
    }

    public function delete($id)
    {   
        return Payment::destroy($id);
    }
}
