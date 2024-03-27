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

    public function createCustomer($request)
    {
        return Customers::create($request);
    }

    public function updateCustomer(array $request)
    {
        $customer = Customers::find($request['id']);
        $customer->update($request);
        
        return $customer;
    }

    public function deleteCustomer($id)
    {
        return Customers::destroy($id);
    }
    
}