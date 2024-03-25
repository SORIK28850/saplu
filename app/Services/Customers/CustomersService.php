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
}