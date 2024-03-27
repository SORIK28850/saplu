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

    public function getById(Request $request)
    {
        return $this->customersService->getCustomerById($request->id);
    }

    public function create(Request $request)
    {
        try {
            $requestData = $request->all();

            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads'), $filename);
                $requestData['photo'] = $filename;
            }

            $requestData['phone'] = intval($requestData['phone']);
            $requestData['familyPhone'] = intval($requestData['familyPhone']);

            $result = $this->customersService->createCustomer($requestData);

            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request)
    {
        

        try {
            $requestData = $request->all();
            
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads'), $filename);
                $requestData['photo'] = $filename;
            }
            $requestData['id'] = intval($requestData['id']);
            $requestData['phone'] = intval($requestData['phone']);
            $requestData['familyPhone'] = intval($requestData['familyPhone']);

            $result = $this->customersService->updateCustomer($requestData);
    
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function delete(Request $request)
    {
        return $this->customersService->deleteCustomer($request->id);
    }
}
