<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Browser\Pages\Conversations;

class CreateConversationsTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreate()
    {
        $user = $this->user;

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->visit('/conversations/create')
                    ->type('title', 'PHP Channel')
                    ->type('description', 'A discussion group about anything PHP')
                    ->press('Start Conversation')
                    ->assertPathIs('/conversations/1');
        });
    }
}
