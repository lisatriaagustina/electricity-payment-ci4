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
            'customers' => $customerModel->join('rates', 'rates.id_rates = customers.id_rates', 'left')->findAll(),
            'rates'     => $ratesModel->findAll()
        ];
        // dd($data['customers']);
        return view('manageCustomer/index', $data);
    }

    public function updateCustomer($param)
    {
        dd($param);
        $session = session();
        // custom validasi
        if (!$this->validate([
            'username'      => 'required|is_unique[admin.username]|is_unique[customers.username]',
            'password'      => 'required',
            'rates'         => 'required',
            'kwh_number'    => 'required',
            'name'          => 'required',
            'address'       => 'required',
        ])) {
            $session->setFlashdata('err-auth', $this->validator->listErrors());
            return redirect()->to('/manage-customer')->withInput();
        }
    }
}
