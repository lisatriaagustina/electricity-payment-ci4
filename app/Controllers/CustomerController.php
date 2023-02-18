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
        $customerModel = new Customers();
        $session = session();
        // custom validasi
        if (!$this->validate([
            'username'      => 'required|is_unique[admin.username]|is_unique[customers.username]',
            'rates'         => 'required',
            'kwh_number'    => 'required',
            'name'          => 'required',
            'address'       => 'required',
        ])) {
            $session->setFlashdata('err-auth', $this->validator->listErrors());
            return redirect()->to('/manage-customer')->withInput();
        }

        $data = $customerModel->find($param);

        $data['username'] = $this->request->getVar('username');
        $data['name'] = $this->request->getVar('name');
        $data['id_rates'] = $this->request->getVar('rates');
        $data['kwh_number'] = $this->request->getVar('kwh_number');
        $data['address'] = $this->request->getVar('address');
        $data['id_update'] = session()->get('id_user');
        // dd($data);

        $customerModel->update($param, $data);
        return redirect()->to('/manage-customer');
    }
}
