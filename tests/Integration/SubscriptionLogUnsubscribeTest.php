<?php

namespace Tests\Integration;

use App\Events\UserAddedToNewsletterList;
use App\Events\UserRemovedFromNewsletterList;
use App\Listeners\AddSubscriberToMailchimpList;
use App\Listeners\RemoveSubscriberFromMailchimpList;
use App\MailchimpLog;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Newsletter\NewsletterFacade;
use Tests\TestCase;

class SubscriptionLogUnsubscribeTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var UserAddedToNewsletterList
     */
    protected $event;

    /**
     * @var AddSubscriberToMailchimpList
     */
    protected $underTest;


    protected function setUp(): void
    {
        parent::setUp();

        $this->email = $this->faker->email;

        NewsletterFacade::subscribe($this->email);

        $user = factory(User::class)->create(['email' => $this->email]);
        $this->event = new UserRemovedFromNewsletterList($user);
        $this->underTest = new RemoveSubscriberFromMailchimpList();
    }

    protected function tearDown(): void
    {
        parent::setUp();

        NewsletterFacade::deletePermanently($this->email);
    }

    /**
     * @test
     */
    public function a_new_log_should_be_created_when_a_user_has_added_to_the_newsletter_subscriptions()
    {
        $this->underTest->handle($this->event);

        $this->assertDatabaseHas('mailchimp_logs', [
            'type_id' => MailchimpLog::UNSUBSCRIBE_TYPE_ID,
            'email' => $this->event->user->email,
            'status' => User::UNSUBSCRIBED,
        ]);
    }
}
