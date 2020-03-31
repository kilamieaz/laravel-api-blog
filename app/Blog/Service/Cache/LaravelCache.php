<?php

namespace App\Blog\Service\Cache;

// use Illuminate\Cache\CacheManager;
use Illuminate\Support\Facades\Cache;

class LaravelCache implements CacheInterface
{
    protected $cache;
    // protected $cacheKey;
    protected $seconds;

    public function __construct(Cache $cache, $seconds = null)
    {
        $this->cache = $cache;
        // $this->cacheKey = $cacheKey;
        $this->seconds = $seconds;
    }

    public function get($key)
    {
        return $this->cache::get($key);
        // return $this->cache->section($this->cachekey)->get($key);
    }

    public function put($key, $value, $seconds = null)
    {
        if (is_null($seconds)) {
            $seconds = $this->seconds;
        }

        return $this->cache::put($key, $value, $seconds);
        // return $this->cache->section($this->cachekey)->put($key, $value, $seconds);
    }

    public function has($key)
    {
        return $this->cache::has($key);
        // return $this->cache->section($this->cachekey)->has($key);
    }
}
