<?php

namespace App\Controllers;

use App\Models\Customers;
use App\Models\Uses;
use App\Models\Bills;

class DashboardController extends BaseController
{
    public function index()
    {
        return view('dashboard');
        // echo "tes";
    }

    public function genUses()
    {
        // mengambil semua data customer
        $customerModel = new Customers();
        $usesModel = new Uses();
        $billModel = new Bills();
        $session = session();

        $customers = $customerModel->join('rates', 'customers.id_rates = rates.id_rates', 'left')->findAll();
        foreach ($customers as $customer) {
            // cek user apakah sudah ada penggunaan bulan dan tahun ini ?
            $monthNow = date('m');
            $yearNow = date('Y');
            $customerUses = $usesModel->where('id_customer', $customer['id_customer'])->where('month', $monthNow)->where('year', $yearNow)->first();

            // Jika sudah ada penggunaan, maka tidak perlu insert ke tabel penggunaan
            if ($customerUses) {
                continue;
            }

            $initial_meter = 0;
            $final_meter = $initial_meter + 40;

            // cek meter terakhir user
            $lastFinalMeter = $usesModel->where('id_customer', $customer['id_customer'])->orderBy('created_at', 'DESC')->first();
            if ($lastFinalMeter) {
                $initial_meter = $lastFinalMeter['final_meter'];
            }

            // Data penggunaan
            $usesData = [
                'id_customer'   => $customer['id_customer'],
                'month'         => $monthNow,
                'year'          => $yearNow,
                'initial_meter' => $initial_meter,
                'final_meter'   => $final_meter,
                'id_rekam'      => $session->get('id_user'),
                'id_update'     => $session->get('id_user')
            ];

            // d($usesData);

            // Data tagihan
            $usesModel->save($usesData);
            
            $billData = [
                'id_uses'       => $usesModel->getInsertID(),
                'id_customer'   => $customer['id_customer'],
                'amount'        => $customer['ratesperkwh'] * ($final_meter - $initial_meter),
                'id_rekam'      => $session->get('id_user'),
                'id_update'     => $session->get('id_user')
            ];

            $billModel->save($billData);
            
        }
        return redirect()->to('/');
    }
}
