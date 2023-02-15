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
        'id_rekam',
        'id_update',
        'created_at',
        'updated_at'
    ];
}