<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class Uses extends Model{
    protected $table = 'uses';

    protected $primaryKey = 'id_uses';
    
    protected $allowedFields = [
        'id_uses',
        'id_customer',
        'month',
        'year',
        'initial_meter',
        'final_meter',
        'id_rekam',
        'id_update',
        // 'created_at',
        // 'updated_at',
    ];
}