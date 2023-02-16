<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class Customers extends Model{
    protected $table = 'customers';
    
    protected $allowedFields = [
        'id_customer',
        'id_rates',
        'username',
        'password',
        'kwh_number',
        'name',
        'address',
        'id_rekam',
        'id_update',
        'created_at',
        'updated_at',
    ];
}