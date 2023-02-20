<?php

namespace App\Controllers;

use App\Models\Bills;

class PayElectricityController extends BaseController
{
    public function index()
    {
        $billModel = new Bills();
        $idUser = session()->get('id_user');
        $data = [
            'detail_bill'   => $billModel->join('customers', 'customers.id_customer = bills.id_customer', 'left')->join('rates', 'customers.id_rates = rates.id_rates', 'left')->join('uses', 'uses.id_uses = bills.id_uses', 'left')->where('bills.id_customer', $idUser)->first()
        ];
        return view('payElectricity/index', $data);
    }
}
