<?php

namespace App\Controllers;

use App\Models\Customers;
use App\Models\Uses;
use App\Models\Bills;
use App\Models\Admin;
class DashboardController extends BaseController
{
    public function index()
    {
        $adminModel = new Admin();
        $customerModel =  new Customers();
        $data = [
            'count_admin'       => $adminModel->countAll(),
            'count_customer'    => $customerModel->where('is_active', '1')->countAllResults(),
            'count_non_active_user'    => $customerModel->where('is_active', '0')->countAllResults()
        ];
        session()->set('menu-active', 'dashboard');
        return view('dashboard', $data);
    }

    public function genUses()
    {
        // mengambil semua data customer
        $customerModel = new Customers();
        $usesModel = new Uses();
        $billModel = new Bills();

        $customers = $customerModel->join('rates', 'customers.id_rates = rates.id_rates', 'left')->where('customers.is_active', '1')->findAll();
        foreach ($customers as $customer) {
            // cek user apakah sudah ada penggunaan bulan dan tahun ini ?
            $monthNow = (string)intval(date('m'));
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
                'final_meter'   => $final_meter
            ];

            // d($usesData);

            // Data tagihan
            $usesModel->save($usesData);
            
            $billData = [
                'id_uses'       => $usesModel->getInsertID(),
                'id_customer'   => $customer['id_customer'],
                // 'amount'        => $customer['ratesperkwh'] * ($final_meter - $initial_meter),
            ];

            $billModel->save($billData);
        }
        session()->setFlashdata('msg-gen-penggunaan', 'Sukses generate penggunaan dan tagihan untuk semua user bulan ini');
        return redirect()->to('/');
    }
}
