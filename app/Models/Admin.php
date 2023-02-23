<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class Admin extends Model{
    protected $table = 'admin';
    
    protected $allowedFields = [
        'id_admin',
        'id_role',
        'username',
        'password',
        'name',
        'created_at',
        'updated_at'
    ];
}