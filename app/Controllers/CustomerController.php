<?php

namespace App\Controllers;

use App\Models\Customers;
use App\Models\Rates;

class CustomerController extends BaseController
{
    public function index()
    {
        $customerModel = new Customers();
        $ratesModel = new Rates();
        $data = [
            'customers' => $customerModel->findAll(),
            'rates'     => $ratesModel->findAll()
        ];
        return view('manageCustomer/index', $data);
    }

}
