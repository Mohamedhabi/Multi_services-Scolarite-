<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class authTest extends TestCase
{
    /**
     * Unit test for testing login with valid data.
     *
     * @return void
     */
    public function testLogin()
    {
        $response = $this->json('POST', '/api/auth/login', ['email' => 'mohamed@test.com','password'=> '123']);

        $response  
            ->assertStatus(200)->assertSee("name")->assertSee("access_token");
    }
    /**
     * Unit test for testing login with wrong data.
     *
     * @return void
     */
    public function testWrongLogin()
    {
        $response = $this->json('POST', '/api/auth/login', ['email' => 'mohamed@test.com','password'=> '1234']);

        $response
            ->assertStatus(401)->assertSee("Wrong email or password");
    }
    /**
     * Unit test for testing access with a wtong token.
     *
     * @return void
     */
    public function testUnauthorized()
    {
        $response = $this->json('POST', '/api/auth/me', ['token' => 'Wrong token']);

        $response
            ->assertStatus(401);
    }
}
