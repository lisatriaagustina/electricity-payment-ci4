<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class Bank extends Model{
    protected $table = 'bank';

    protected $primaryKey = 'id_bank';
    
    protected $allowedFields = [
        'id_bank',
        'bank_name',
        'bank_user',
        'bank_acc_number',
    ];
}