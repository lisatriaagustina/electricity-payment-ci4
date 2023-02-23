<?php

namespace App\Controllers;

use App\Models\Rates;
use App\Models\Customers;

class RegisterController extends BaseController
{
    public function index()
    {
        $ratesModel = new Rates();
        $rates = $ratesModel->findAll();
        // dd($rates);
        $data = [
            'rates' => $rates
        ];
        return view('auth/register', $data);
    }

    public function addCustomer()
    {
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
            if ($session->get('IS_LOGIN')) {
                session()->setFlashdata('err-add-customer', $this->validator->listErrors());
                return redirect()->to('/manage-customer');
            }
            session()->setFlashdata('err-auth', $this->validator->listErrors());
            return redirect()->to('/register')->withInput();
        }

        // ambil data dari form
        $data = [
            'username'      => $this->request->getVar('username'),
            // password di enkripsi secara default oleh sistem ci4
            'password'      => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
            'id_rates'      => $this->request->getVar('rates'),
            'kwh_number'    => $this->request->getVar('kwh_number'),
            'name'          => $this->request->getVar('name'),
            'address'       => $this->request->getVar('address'),
        ];

        // panggil model / tabel customers dari database dan simpan ke database
        $customersModel = new Customers();
        $customersModel->save($data);

        session()->setFlashdata('msg-add-customer', 'Successfully add new customer account!');

        // jika login admin kembalikan ke manage customer
        if ($session->get('IS_LOGIN')) {
            return redirect()->to('/manage-customer');
        }
        // kembalikan ke halaman login
        return redirect()->to('/login');
    }
}
