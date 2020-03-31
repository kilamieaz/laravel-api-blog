<?php

namespace App\Blog\Service\Cache;

interface CacheInterface
{
    public function get($key);

    public function put($key, $value, $seconds = null);

    public function has($key);
}
