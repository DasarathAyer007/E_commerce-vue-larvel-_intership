<?php

namespace App\Http\Repositories;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Collection;


class PaymentRepository
{
    public function getAll(): Collection
    {
        return Payment::all();
    }

    public function getById($id): Payment
    {
        return Payment::findOrFail($id);
    }

    public function create(array $data): Payment
    {
        return Payment::create($data);
    }

    public function update($id, array $data): Payment
    {
        $Payment = Payment::findOrFail($id);
        $Payment->update($data);
        return $Payment;
    }

    public function delete($id): bool
    {
        return Payment::destroy($id)>0;
    }
}
