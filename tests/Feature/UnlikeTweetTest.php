<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Tweet;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UnlikeTweetTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     */

    public function test_unlike_tweet(): void
    {
        $user = User::create([

            'first_name' => 'David',

            'last_name' => 'Wanjohi',

            'email' => 'username@gmail.com',

            'username' => 'David',

            'password' => 'username123'
        ]);

        $tweet = Tweet::create([

            'body' => 'My new tweet',

            'user_id' => $user->id

        ]);

        $response = $this->post('/api/unlike/1/1');

        $response->assertStatus(200);

        $response->assertJson([

            'message' => 'Tweet unlike successful',

        ]);

    }
    
}
