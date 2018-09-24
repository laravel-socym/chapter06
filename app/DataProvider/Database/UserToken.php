<?php
declare(strict_types=1);

namespace App\DataProvider\Database;

use App\DataProvider\UserTokenProviderInterface;
use Illuminate\Database\DatabaseManager;

final class UserToken implements UserTokenProviderInterface
{
    /** @var DatabaseManager */
    private $manager;

    private $table = 'user_tokens';

    public function __construct(DatabaseManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param string $token
     *
     * @return \stdClass|null
     */
    public function retrieveUserByToken(string $token)
    {
        return $this->manager->connection()
            ->table($this->table)
            ->join('users', 'users.id', '=', 'user_tokens.user_id')
            ->where('api_token', $token)
            ->first(['user_id', 'api_token', 'name', 'email']);
    }
}
