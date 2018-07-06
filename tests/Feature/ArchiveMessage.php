<?php

namespace Tests\Feature;

use App\Message;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArchiveMessage extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $user = factory(User::class)->make();
        $message = factory(Message::class)->create();

        var_dump($message);
        $response = $this->actingAs($user)->put('/api/archive/' . $message->_id);
        $response->assertStatus(200);

        $response = $this->actingAs($user)->get('/api/listArchived?offset=0&limit=100');
        $find = array_filter($response->json(), function($entity) use ($message) {
            return $entity['_id'] === $message->_id;
        });

        $this->assertNotEmpty($find);
        $message->delete();
    }
}
