<?php

namespace App\Controllers;

use TCPDF;

use App\Models\Payment;

class GenerateReportController extends BaseController
{
    public function index()
    {
        $paymentModel = new Payment();
        $monthNow = date('m');
        $yearNow = date('Y');
        $dataReport = $paymentModel->join('bills', 'bills.id_bill = payments.id_bill', 'left')
            ->join('customers', 'customers.id_customer = payments.id_customer', 'left')
            ->join('bank', 'bank.id_bank = payments.id_bank')
            ->join('uses', 'uses.id_uses = bills.id_uses', 'left')
            ->join('rates', 'rates.id_rates = customers.id_rates', 'left')
            ->where('uses.month', $monthNow)
            ->where('uses.year', $yearNow)
            ->findAll();
        $admin_fee = 10000;
        $data = [
            'data_report' => $dataReport,
            'admin_fee'   => $admin_fee
        ];

        // dd($dataReport);
        return view('generateReport/index', $data);
    }

    public function pdf()
    {
        // collect data
        $paymentModel = new Payment();
        $monthNow = date('m');
        $yearNow = date('Y');

        $dataReport = $paymentModel->join('bills', 'bills.id_bill = payments.id_bill', 'left')
            ->join('customers', 'customers.id_customer = payments.id_customer', 'left')
            ->join('bank', 'bank.id_bank = payments.id_bank')
            ->join('uses', 'uses.id_uses = bills.id_uses', 'left')
            ->join('rates', 'rates.id_rates = customers.id_rates', 'left')
            ->where('uses.month', $monthNow)
            ->where('uses.year', $yearNow)
            ->findAll();
        $admin_fee = 10000;
        $data = [
            'data_report' => $dataReport,
            'admin_fee'   => $admin_fee
        ];

        // load view
        $html = view('generateReport/table_report', $data);

        // Create new TCPDF object
        $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Lisa Agustina');
        $pdf->SetTitle('Payment Report'.date('m Y'));
        $pdf->SetSubject('Payment Report'.date('m Y'));

        // Set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // Add a page
        $pdf->AddPage();

        // Output the HTML as PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Output the PDF to the browser as a download
        $pdf->Output('report.pdf', 'D');
    }
}
