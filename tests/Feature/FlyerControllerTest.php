<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FlyerControllerTest extends TestCase
{
    /**
     * check a flyer create form
     *
     * @return void
     */
    public function test_it_shows_form_to_create_a_new_flyer()
    {
        $response = $this->get('flyers/create');

        $response->assertStatus(200);
    }
}
