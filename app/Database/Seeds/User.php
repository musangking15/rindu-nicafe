<?php

namespace App\Database\Seeds;

use App\Models\UserModel;
use CodeIgniter\Database\Seeder;

class User extends Seeder
{
    protected $user;

    public function __construct()
    {
        $this->user = new UserModel();
    }

    public function run()
    {
        $data = [
            'username' => 'admin1',
            'password' => password_hash('adminrindu1', PASSWORD_DEFAULT)
        ];

        $this->user->insert($data);
    }
}
