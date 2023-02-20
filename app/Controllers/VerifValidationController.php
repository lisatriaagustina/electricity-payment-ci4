<?php

namespace App\Controllers;

use App\Models\Bills;

class VerifValidationController extends BaseController
{
    public function index()
    {
        $billModel = new Bills();
        $data = [
            'bills'     => $billModel->join('customers', 'customers.id_customer = bills.id_customer', 'left')->join('rates', 'customers.id_rates = rates.id_rates', 'left')->join('uses', 'uses.id_uses = bills.id_uses', 'left')->findAll()
        ];
        // dd($data['bills']);
        return view('verificationValidation/index', $data);
    }

    public function viewVerif($param)
    {
        $billModel = new Bills();
        $data = [
            'detail_bill' => $billModel->join('customers', 'customers.id_customer = bills.id_customer', 'left')->join('rates', 'customers.id_rates = rates.id_rates', 'left')->join('uses', 'uses.id_uses = bills.id_uses', 'left')->where('id_bill', $param)->first()
        ];
        // dd($data['detail_bill']);
        return view('detailVerificationValidation/index', $data);
    }
}
