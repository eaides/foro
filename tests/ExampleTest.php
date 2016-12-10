<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->visit('/')
            ->see('Laravel');

        $name = 'Ernesto Aides';
        $email = 'admin@auth89.com';
        $user = factory(\App\User::class)->create([
            'name' => $name,
            'email' => $email,
        ]);
        $user->name = 'Ernesto Aides';

        $this->actingAs($user, 'api')
            ->visit('api/user/name')
            ->see($name);

        $this->actingAs($user, 'api')
            ->visit('api/user/name/email')
            ->see($name)
            ->see($email);
    }
}
