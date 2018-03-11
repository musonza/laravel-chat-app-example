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
    public function a_user_can_view_all_conversations()
    {
        $this->get('/conversations')
            ->assertSee("/conversations/{$this->conversation->id}");
    }

    /** @test */
    function a_user_can_read_a_single_conversation()
    {
        $this->get("/conversations/{$this->conversation->id}")
            ->assertSee("Conversation {$this->conversation->id}");
    }
}
