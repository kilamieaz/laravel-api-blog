<?php

namespace App\Blog\Repositories\Category;

use App\Blog\Service\Cache\CacheInterface;

class CacheDecorator extends AbstractCategoryDecorator
{
    protected $cache;

    public function __construct(CategoryInterface $nextCategory, CacheInterface $cache)
    {
        parent::__construct($nextCategory);
        $this->cache = $cache;
    }

    public function all()
    {
        $key = md5('all');

        if ($this->cache->has($key)) {
            return $this->cache->get($key);
        }

        $category = $this->nextCategory->all();

        $this->cache->put($key, $category);

        return $category;
    }
}
