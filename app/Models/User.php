<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'user_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama', 'email', 'password', 'user_level', 'is_active'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function markAsActive($user_id)
    {
        return $this->update($user_id, ['is_active' => 1]);
    }

    public function findUserActiveByEmail($email)
    {
        return $this->select('nama, email, password')
            ->where('email', $email)
            ->where('is_active', 1)
            ->first();
    }

    public function updatePassword($email, $password)
    {
        return $this->where('email', $email)
            ->set(['password' => $password])
            ->update();
    }
}
