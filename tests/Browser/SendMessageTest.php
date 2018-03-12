<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SendMessageTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testSendMessage()
    {
        $user = $this->user;

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->visit('/conversations/create')
                    ->type('title', 'PHP Channel')
                    ->type('description', 'A discussion group about anything PHP')
                    ->press('Start Conversation')
                    ->assertPathIs('/conversations/1')
                    ->assertInputValue('message', '')
                    ->type('message', 'Hello there')
                    ->press('Send');
        });
    }
}
