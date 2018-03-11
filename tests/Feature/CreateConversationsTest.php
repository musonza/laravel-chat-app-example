<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateConversationsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function guests_may_not_create_conversations()
    {
        $this->withExceptionHandling();

        $this->get('/conversations/create')
            ->assertRedirect(route('login'));

        $this->post(route('conversations.store'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    function a_user_can_create_new_conversation()
    {
        $this->signIn();

        $response = $this->post(route('conversations.store'));

        $this->get($response->headers->get('Location'))
            ->assertSee('Conversation');
    }
}
