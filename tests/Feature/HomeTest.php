<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function guest_user_cannot_visit_home_page()
    {
        $response = $this->get(route('home'));

        $response->assertRedirect(route('login'));

        $response->assertStatus(Response::HTTP_FOUND);
    }

    /**
     * @test
     */
    public function the_admin_user_can_visit_home_page()
    {
        $admin = factory(User::class)->create();

        $this->actingAs($admin);

        $response = $this->get(route('home'));

        $response->assertOk();
    }
}
