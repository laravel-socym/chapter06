<?php
declare(strict_types=1);

namespace App\Auth;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use Illuminate\Contracts\Cache\Repository as CacheRepository;

use function sprintf;
use function is_null;
use function hash_equals;

class CacheUserProvider extends EloquentUserProvider
{
    /** @var CacheRepository */
    protected $cache;

    protected $cacheKey = "authentication:user:%s";

    protected $lifetime;

    /**
     * CacheUserProvider constructor.
     *
     * @param HasherContract  $hasher
     * @param string          $model
     * @param CacheRepository $cache
     * @param int             $lifetime
     */
    public function __construct(
        HasherContract $hasher,
        string $model,
        CacheRepository $cache,
        int $lifetime = 120
    ) {
        parent::__construct($hasher, $model);
        $this->cache = $cache;
        $this->lifetime = $lifetime;
    }

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed $identifier
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($identifier)
    {
        $cacheKey = sprintf($this->cacheKey, $identifier);
        if ($this->cache->has($cacheKey)) {
            return $this->cache->get($cacheKey);
        }
        $result = parent::retrieveById($identifier);
        if (is_null($result)) {
            return null;
        }
        $this->cache->add($cacheKey, $result, $this->lifetime);
        return $result;
    }

    /**
     * @param mixed  $identifier
     * @param string $token
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByToken($identifier, $token)
    {
        $model = $this->retrieveById($identifier);
        if (!$model) {
            return null;
        }
        $rememberToken = $model->getRememberToken();

        return $rememberToken && hash_equals($rememberToken, $token) ? $model : null;
    }
}
