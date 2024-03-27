<?php

namespace App\Services\Customers;
use App\Repositories\Customers\CustomersRepository;

class CustomersService
{
    protected $customersRepository;

    public function __construct(CustomersRepository $customersRepository)
    {
        $this->customersRepository = $customersRepository;
    }

    public function getCustomers()
    {
        return $this->customersRepository->getCustomers();
    }

    public function getCustomerById($id)
    {
        return $this->customersRepository->getCustomerById($id);
    }

    public function createCustomer(array $request)
    {
        return $this->customersRepository->createCustomer($request);
    }

    public function updateCustomer(array $data)
    {
        return $this->customersRepository->updateCustomer($data);
    }

    public function deleteCustomer($id)
    {
        return $this->customersRepository->deleteCustomer($id);
    }

}