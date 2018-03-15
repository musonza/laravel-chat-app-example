<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Chat;

class ReadConversationsTest extends TestCase
{
    use DatabaseMigrations;

    protected $conversation;

    public function setUp()
    {
        parent::setUp();
        $this->signIn();
        $participants = [auth()->user()];
        $this->conversation = Chat::createConversation($participants);
    }

    /** @test */
    function guests_may_not_view_conversations()
    {
        auth()->logout();

        $this->withExceptionHandling();

        $this->get('/conversations')
             ->assertRedirect(route('login'));
    }

     /** @test */
    public function a_user_can_view_all_conversations()
    {
        $this->get('/conversations')
            ->assertSee("/conversations/{$this->conversation->id}");
    }

    /** @test */
    function a_user_can_read_a_single_conversation()
    {
        $this->get("/conversations/{$this->conversation->id}")
            ->assertSee("Conversation");
    }

    /** @test */
    function can_not_read_a_conversation_they_are_not_part_of()
    {
        $this->signIn();

        $this->get("/conversations/{$this->conversation->id}")
            ->assertRedirect(route('conversations.index'));
    }
}
