<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Browser\Pages\Conversations;

class ConversationsTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreate()
    {
        $user = factory(\App\User::class)->create([
            'email' => 'tinashe@example.com',
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                    ->type('email', $user->email)
                    ->type('password', 'secret')
                    ->press('Login')
                    ->clickLink('New Conversation')
                    ->assertPathIs('/conversations/create')
                    ->type('title', 'PHP Channel')
                    ->type('description', 'A discussion group about anything PHP')
                    ->press('Start Conversation')
                    ->assertPathIs('/conversations/1');
        });
    }
}
