<?php
declare(strict_types=1);

namespace App\Foundation\Auth;

interface UserRegister
{
    /**
     * @param array $data
     *
     * @return Authentication
     */
    public function add(array $data): Authentication;
}
