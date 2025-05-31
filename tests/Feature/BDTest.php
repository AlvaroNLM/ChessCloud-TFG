<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BDTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testDatabaseEmail()
    {
        // Make call to application...

        $this->assertDatabaseHas('users', [
            'email' => 'alvaronavarrolopez@hotmail.com',
        ]);
    }

    public function testDatabaseName()
    {
        // Make call to application...

        $this->assertDatabaseHas('users', [
            'name' => 'serverslayer',
        ]);
    }

    public function testDatabaseUser()
    {
        // Make call to application...

        $this->assertDatabaseHas('users', [
            'name' => 'serverslayer',
        ]);
    }

}
