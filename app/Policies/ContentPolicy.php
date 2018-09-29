<?php
declare(strict_types=1);

namespace App\Policies;

use stdClass;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Contracts\Auth\Authenticatable;

use function intval;
use function property_exists;

class ContentPolicy
{
    use HandlesAuthorization;

    public function edit(
        Authenticatable $authenticatable,
        stdClass $class
    ): bool {
        if (property_exists($class, 'id')) {
            return intval($authenticatable->getAuthIdentifier()) === intval($class->id);
        }

        return false;
    }
}
