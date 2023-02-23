<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class Bills extends Model{
    protected $table = 'bills';

    protected $primaryKey = 'id_bill';
    
    protected $allowedFields = [
        'id_bill',
        'id_uses',
        'id_customer',
        'status',
        // 'amount',
        'created_at',
        'updated_at',
    ];
}