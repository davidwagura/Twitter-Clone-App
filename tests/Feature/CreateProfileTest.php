<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateProfileTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */

    public function test_create_profile(): void
    {
        $user = User::create([

            'id' => 1,

            'first_name' => 'Kings',

            'last_name' => 'John',

            'email' => 'John@gmail.com',

            'username' => 'John',

            'password' => 'john1234',

        ]);


        $profile = Profile::created([

            'id' => 1,

            'user_id' => $user->id,

            'name' => 'John',

            'bio' => 'consistency'

        ]);
        
        $response = $this->post('/api/profile');

        $response->assertStatus(200);

        $response->assertJson([
           
            'message' => 'Profile created successfully'

        ]);

    }

}
