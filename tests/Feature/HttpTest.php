<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HttpTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function TestCodPartidas()
    {
        $response = $this->get('/partidas');

        $response->assertStatus(200);
    }

    public function testError500()
    {
        $response = $this->get('/partidasssssssssssssss');

        $response->assertStatus(404);
    }
}
