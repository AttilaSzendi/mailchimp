<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RemoteSubscriptionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function remotely_created_newsletter_subscription_will_create_new_user_if_not_exists()
    {
        $email = 'tesztelek@gmail.com';

        $response = $this->post(route('api:remote-mailchimp-change'), [
            'type' => 'subscribe',
            'data' => [
                'email' => $email
            ]
        ]);

        $response->assertOk();

        $this->assertDatabaseHas('users', [
            'email' => $email,
            'newsletter_subscription' => true,
        ]);
    }

    /**
     * @test
     */
    public function remotely_removed_newsletter_subscription_will_update_user_and_set_newsletter_subscription_property_to_false()
    {
        $user = factory(User::class)->create(['email' => 'tesztelek@gmail.com', 'newsletter_subscription' => true]);

        $response = $this->post(route('api:remote-mailchimp-change'), [
            'type' => 'unsubscribe',
            'data' => [
                'email' => $user->email
            ]
        ]);

        $response->assertOk();

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'newsletter_subscription' => false,
        ]);
    }
}
