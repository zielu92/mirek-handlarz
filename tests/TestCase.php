<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * @return User
     */
    protected function getAdmin()
    {
        return factory(User::class)->create([
            'is_admin' => true
        ]);
    }
}
