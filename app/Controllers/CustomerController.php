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
        $user = $customerModel->find($param);
        $lastusername = $user['username'];
        $lastKwhNumber = $user['kwh_number'];

        if (!$this->validate([
            'username'      => 'required|is_unique[customers.username,customers.username,'.$lastusername.']|is_unique[admin.username,admin.username,'.$lastusername.']|regex_match[/^\S+$/]',
            'rates'         => 'required',
            'kwh_number'    => 'required|is_unique[customers.kwh_number,customers.kwh_number,'.$lastKwhNumber.']',
            'name'          => 'required',
            'address'       => 'required',
        ])) {
            $session->setFlashdata('err-manage-customer', $this->validator->listErrors());
            return redirect()->to('/manage-customer')->withInput();
        }

        $user = $customerModel->find($param);

        $data = [
            // 'id_customer'   => $param,
            'id_rates'      => $this->request->getVar('rates'),
            'username'      => $this->request->getVar('username'),
            'password'      => $user['password'],
            'kwh_number'    => $this->request->getVar('kwh_number'),
            'name'          => $this->request->getVar('name'),
            'address'       => $this->request->getVar('address')
        ];

        $customerModel->update($param, $data);
        $session->setFlashdata('msg-manage-customer', 'Success update customer');
        return redirect()->to('/manage-customer');
    }
}
