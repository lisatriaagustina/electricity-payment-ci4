<?php

namespace App\Controllers;

use App\Models\Bills;
use App\Models\Bank;
use App\Models\Payment;

class PayElectricityController extends BaseController
{
    public function index()
    {
        $billModel = new Bills();
        $bankModel = new Bank();
        $paymentModel = new Payment();
        $adminFee = 10000;
        $banks = $bankModel->findAll();
        $idUser = session()->get('id_user');
        $data = [
            'detail_bill'   => $billModel->join('customers', 'customers.id_customer = bills.id_customer', 'left')->join('rates', 'customers.id_rates = rates.id_rates', 'left')->join('uses', 'uses.id_uses = bills.id_uses', 'left')->where('bills.id_customer', $idUser)->first(),
            'banks'         => $banks,
            'admin_fee'     => $adminFee,
            'detail_payment'=> $paymentModel->join('bank', 'bank.id_bank = payments.id_bank')->where('id_customer', session()->get('id_user'))->first()
        ];
        return view('payElectricity/index', $data);
    }

    public function pay()
    {
        $paymentModel = new Payment();
        $billModel = new Bills();
        
        $imgPay = $this->request->getFile('payPhoto');
        $newFileName = $imgPay->getRandomName();
        $imgPay->move(ROOTPATH . 'public/images/proofPayment', $newFileName);
        
        $data = [
            'id_bill'       => $this->request->getVar('id_bill'),
            'id_customer'   => session()->get('id_user'),
            'id_bank'       => $this->request->getVar('bank'),
            'total_pay'     => $this->request->getVar('totalPay'),
            'picture'       => '/images/proofPayment/'.$newFileName,
        ];

        $oldPaymentData = $paymentModel->where('id_bill', $this->request->getVar('id_bill'))->first();

        if($oldPaymentData){
            $paymentModel->update($oldPaymentData['id_payment'], $data);
            unlink('.'.$oldPaymentData['picture']);
        }else{
            $paymentModel->save($data);
        }

        $billModel->set('status', 'process')->where('id_bill', $this->request->getVar('id_bill'))->update();

        session()->setFlashdata('msg-pay', 'Payment successful, please wait for admin confirmation.');

        return redirect()->to('/pay-electricity');
    }
}
