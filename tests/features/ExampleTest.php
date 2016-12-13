<?php

class ExampleTest extends FeatureTestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    function test_basic_example()
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
