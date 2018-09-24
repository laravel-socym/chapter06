<?php
declare(strict_types=1);

namespace App\Foundation\Auth;

interface Authentication
{
    public function getDetails(): array;

    public function isAuthenticated(): bool;
}
