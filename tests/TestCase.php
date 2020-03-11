<?php

namespace Tests;

use Laravel\Airlock\Airlock;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function signIn($user = null)
    {
        $user = $user ?: factory('App\User')->create();
        Airlock::actingAs(
            $user,
            ['*']
        );
        return $user;
    }
}
