<?php

namespace App\Models;

use CodeIgniter\Model;

class UserToken extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'user_tokens';
    protected $primaryKey       = 'user_token_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'token', 'expire_at'];

    public function findValidToken($token)
    {
        return $this->where('token', $token)
            ->where('expire_at >', date('Y-m-d H:i:s'))
            ->first();
    }
}
