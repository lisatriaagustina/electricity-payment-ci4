<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class Payment extends Model{
    protected $table = 'payments';

    protected $primaryKey = 'id_payment';
    
    protected $allowedFields = [
        'id_payment',
        'id_bill',
        'id_customer',
        'pay_date',
        'id_bank',
        'total_pay',
        'picture'
    ];
}