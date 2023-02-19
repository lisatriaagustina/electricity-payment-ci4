<?php

namespace App\Controllers;

use App\Models\Bills;

class VerifValidationController extends BaseController
{
    public function index()
    {
        $billModel = new Bills();
        $data = [
            'bills'     => $billModel->join('customers', 'customers.id_customer = bills.id_customer', 'left')->join('uses', 'uses.id_uses = bills.id_uses', 'left')->findAll()
        ];
        // dd($data['bills']);
        return view('verificationValidation/index', $data);
    }
}
