<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testLogin()
    {
        $user = factory(User::class)->create([
            'email' => 'tinashe@example.com',
        ]);

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                    ->type('email', $user->email)
                    ->type('password', 'secret')
                    ->press('Login')
                    ->assertPathIs('/home')
                    ->assertSeeLink('New Conversation');
        });
    }

    public function testRegister()
    {
        $this->browse(function ($browser) {
            $browser->visit('/register')
                    ->type('name', 'Tinashe Musonza')
                    ->type('email', 'tinashe@example.com')
                    ->type('password', 'secret')
                    ->type('password_confirmation', 'secret')
                    ->press('Register')
                    ->assertPathIs('/home');
        });
    }
}
