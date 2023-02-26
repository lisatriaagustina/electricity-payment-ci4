<?php

namespace App\Controllers;

use App\Models\Bills;
use App\Models\Payment;

class VerifValidationController extends BaseController
{
    public function index()
    {
        $billModel = new Bills();
        $adminFee = 10000;
        $data = [
            'bills'     => $billModel->join('customers', 'customers.id_customer = bills.id_customer', 'left')->join('rates', 'customers.id_rates = rates.id_rates', 'left')->join('uses', 'uses.id_uses = bills.id_uses', 'left')->findAll(),
            'admin_fee'     => $adminFee,
        ];
        // dd($data['bills']);
        return view('verificationValidation/index', $data);
    }

    public function viewVerif($param)
    {
        $billModel = new Bills();
        $paymentModel = new Payment();
        $adminFee = 10000;
        $data = [
            'detail_bill'   => $billModel->join('customers', 'customers.id_customer = bills.id_customer', 'left')->join('rates', 'customers.id_rates = rates.id_rates', 'left')->join('uses', 'uses.id_uses = bills.id_uses', 'left')->where('id_bill', $param)->first(),
            'admin_fee'     => $adminFee,
            'detail_payment' => $paymentModel->join('bank', 'bank.id_bank = payments.id_bank')->where('id_bill', $param)->first()
        ];
        // dd($data['detail_bill']);
        return view('detailVerificationValidation/index', $data);
    }

    public function updatePayment($param)
    {
        $billModel = new Bills();
        $billModel->set('status', 'success')->where('id_bill', $param)->update();

        return redirect()->to('/verification-and-validation');
    }

    public function rejectPayment($param)
    {
        $billModel = new Bills();
        $billModel->set('status', 'reject')->where('id_bill', $param)->update();

        return redirect()->to('/verification-and-validation');
    }
}
