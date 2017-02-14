<?php

use App\User;

class UserAuthenticationTest extends FeatureTestCase
{
    protected $name = 'user_full_name';
    protected $email = 'user_name@test.com';
    protected $password = '123456';

    function test_user_can_register() {
        $this->visit('/')
            ->click('Register')
            ->see('Register')
            ->seePageIs('register')
            ->type($this->name,'name')
            ->type($this->email,'email')
            ->type($this->password,'password')
            ->type($this->password,'password_confirmation')
            ->press('Register');

        $this->seeInDatabase('users',[
            'name'          => $this->name,
            'email'         => $this->email,
        ]);

        // check if can login by email
        $this->seeCredentials([
            'email'         => $this->email,
            'password'      => $this->password,
        ]);

        // see name by this ->name
        $this->seePageIs('home')
            ->see('Dashboard')
            ->see('You are logged in!')
            ->see($this->name);

        // see name by User ->name
        $user = User::where([
            'name'  => $this->name,
            'email' => $this->email,
        ])->first();

        $this->seePageIs('home')
            ->see('Dashboard')
            ->see('You are logged in!')
            ->see($user->name);
    }

    function test_users_can_login_by_email()
    {
        $user = $this->getUser();

        $this->visit('/')
            ->click('Login')
            ->see('Login')
            ->seePageIs('login')
            ->type($this->email,'email')
            ->type($this->password,'password')
            ->press('Login');

        $this->seePageIs('home')
            ->see('Dashboard')
            ->see('You are logged in!')
            ->see($user->name);

        $this->seeIsAuthenticated('web');
    }

    function test_users_can_logout() {
        $user = $this->getUser();

        $form = $this->actingAs($user)
            ->visit('home')
            ->getForm();

        $this->SeeIsAuthenticated('web');

        $this->actingAs($user)
            ->visit('home')
            ->makeRequestUsingForm($form)
            ->seePageIs('/');

        $this->dontSeeIsAuthenticated('web');
    }

    /**
     * @return mixed
     */
    protected function getUser()
    {
        return factory(User::class)->create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);
    }
}
