<?php
declare(strict_types=1);

namespace App\Foundation\Auth;

interface Authenticator
{
    /**
     * @param array $data
     *
     * @return Authentication
     */
    public function retrieveUser(array $data): Authentication;
}
