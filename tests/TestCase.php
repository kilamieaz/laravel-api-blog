<?php

namespace Tests;

use Laravel\Airlock\Airlock;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    public function assertHasManyUsing($related_model, $relationship, $foreign_key)
    {
        $this->assertInstanceOf(HasMany::class, $relationship);
        $this->assertInstanceOf($related_model, $relationship->getRelated()); // getRelated = 'App\Category'
        $this->assertEquals($foreign_key, $relationship->getForeignKeyName()); // FK = parent_id
        $this->assertTrue(Schema::hasColumns($relationship->getRelated()->getTable(), [$foreign_key]));
    }

    public function assertBelongsToUsing($related_model, $relationship, $foreign_key)
    {
        $this->assertInstanceOf(BelongsTo::class, $relationship);
        $this->assertInstanceOf($related_model, $relationship->getRelated());
        $this->assertEquals($foreign_key, $relationship->getForeignKeyName());
        $this->assertTrue(Schema::hasColumns($relationship->getParent()->getTable(), [$foreign_key]));
    }
}
