<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubscriptionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_users_can_be_retrieved()
    {
        $admin = factory(User::class)->create();

        $this->actingAs($admin);

        factory(User::class,9)->create();

        $response = $this->get(route('api:subscribers'));

        $response->assertOk();

        $response->assertJsonCount(10, 'data');
    }

    /**
     * @test
     */
    public function a_user_can_be_assigned_as_newsletter_subscriber()
    {
        $admin = factory(User::class)->create();

        $this->actingAs($admin);

        $unsubscribedUser = factory(User::class)->create(['newsletter_subscription' => false]);

        $response = $this->patch(route('api:subscribe'), [
            'userId' => $unsubscribedUser->id
        ]);

        $response->assertOk();

        $this->assertDatabaseHas('users', [
            'id' => $unsubscribedUser->id,
            'newsletter_subscription' => true,
        ]);
    }

    /**
     * @test
     */
    public function a_user_can_be_removed_from_newsletter_subscribers()
    {
        $admin = factory(User::class)->create();

        $this->actingAs($admin);

        $subscribedUser = factory(User::class)->create(['newsletter_subscription' => true]);

        $response = $this->patch(route('api:unsubscribe'), [
            'userId' => $subscribedUser->id
        ]);

        $response->assertOk();

        $this->assertDatabaseHas('users', [
            'id' => $subscribedUser->id,
            'newsletter_subscription' => false,
        ]);
    }
}
