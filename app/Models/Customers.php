<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class Customers extends Model{
    protected $table = 'customers';

    protected $primaryKey = 'id_customer';
    
    protected $allowedFields = [
        'id_customer',
        'id_rates',
        'username',
        'password',
        'kwh_number',
        'name',
        'address',
        'created_at',
        'updated_at',
    ];
}