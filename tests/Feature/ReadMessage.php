<?php

namespace Tests\Feature;

use App\Message;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadMessage extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $user = factory(User::class)->make();
        $message = factory(Message::class)->make();

        $response = $this->actingAs($user)->get('/api/list?offset=0&limit=5');
        $response->assertStatus(200);

        $id = $response->json()[0]['_id'];
        $response = $this->actingAs($user)->put('/api/read/' . $id);

        $this->assertEquals($response->json()['status'], Message::STATUS_READ);
    }
}
