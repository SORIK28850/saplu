<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Customers\CustomersService;

class CustomersController extends Controller
{
    protected $customersService;

    public function __construct(CustomersService $customersService)
    {
        $this->customersService = $customersService;
    }

    public function index()
    {
        return $this->customersService->getCustomers();
    }
}
