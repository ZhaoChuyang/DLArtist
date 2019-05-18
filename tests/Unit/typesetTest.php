<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class typesetTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->json('POST', '/compose', ['article_id'=>253, '_token'=>csrf_token()]);
        $response->assertStatus(200)->assertJsonStructure(['ans', 'image_path']);
    }
}
