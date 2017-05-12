<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserSignUpTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test that user sign up successfully
     */
    public function testForSuccessfulSignUp()
    {
        Session::start();

        $user = factory('App\User')->create();

        $this->actingAs($user)
            ->call('POST', 'signup', [
                'email'      => 'demola@gmail.com',
                'password'   => bcrypt('london'),
                'first_name' => 'Demola',
                'last_name'  => 'Raimi',
                'role_id'    => 1,
                'avatar'     => 'https://en.gravatar.com/userimage/102347280/b3e9c138c1548147b7ff3f9a2a1d9bb0.png?size=200',
        ]);

        $this->actingAs($user)
           ->visit('/signup')
           ->type('demola@gmail.com', 'email')
           ->type('london', 'password')
           ->type('london', 'password_confirmation')
           ->type('Demola', 'first_name')
           ->type('Raimi', 'last_name')
           ->press('Register')
           ->seePageIs('/')
           ->see('Dashboard');
    }

    /**
     * Test that user cannot sign up successfully due to data existence in the database
     */
    public function testThatUserAlreadyExists()
    {
        Session::start();

        factory('App\User')->create([
            'email'      => 'demola@gmail.com',
            'password'   => bcrypt('london'),
            'first_name' => 'Demola',
            'last_name'  => 'Raimi',
            'role_id'    => 1,
            'avatar'     => 'https://en.gravatar.com/userimage/102347280/b3e9c138c1548147b7ff3f9a2a1d9bb0.png?size=200',
        ]);

        $this->call('POST', 'signup', [
            'email'      => 'demola@gmail.com',
            'password'   => bcrypt('london'),
            'first_name' => 'Demola',
            'last_name'  => 'Raimi',
            'role_id'    => 1,
            'avatar'     => 'https://en.gravatar.com/userimage/102347280/b3e9c138c1548147b7ff3f9a2a1d9bb0.png?size=200',
        ]);

        $this->visit('/signup')
            ->type('demola@gmail.com', 'email')
            ->press('Register')
            ->see('The email has already been taken.');
        
    }
}
