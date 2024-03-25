<?php

namespace App\Repositories\Customers;
use App\Models\Customers;

class CustomersRepository
{
    public function getCustomers()
    {
        return Customers::all();
    }

    public function getCustomerById($id)
    {
        return Customers::find($id);
    }
}