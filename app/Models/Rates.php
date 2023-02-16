<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class Rates extends Model{
    protected $table = 'rates';
    
    protected $allowedFields = [
        'id_rates',
        'class',
        'class_code',
        'power',
        'ratesperkwh',
        'id_rekam',
        'id_update',
    ];
}