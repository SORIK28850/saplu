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

    public function createCustomer($request)
    {
        return $this->customersRepository->createCustomer($request);
    }

    public function updateCustomer($request)
    {
        return $this->customersRepository->updateCustomer($request);
    }

    public function deleteCustomer($id)
    {
        return $this->customersRepository->deleteCustomer($id);
    }

}