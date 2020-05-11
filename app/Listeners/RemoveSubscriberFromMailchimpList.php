<?php

namespace App\Listeners;

use App\Events\UserRemovedFromNewsletterList;
use App\MailchimpLog;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\Newsletter\NewsletterFacade;

class RemoveSubscriberFromMailchimpList implements ShouldQueue
{
    /**
     * Handle the event.
     * @param UserRemovedFromNewsletterList $event
     * @return void
     */
    public function handle(UserRemovedFromNewsletterList $event)
    {
        $response = NewsletterFacade::unsubscribe($event->user->email);

        MailchimpLog::query()->create([
            'type_id' => MailchimpLog::UNSUBSCRIBE_TYPE_ID,
            'email' => $event->user->email,
            'status' => $response ? User::UNSUBSCRIBED : User::ALREADY_UNSUBSCRIBED
        ]);
    }

    /**
     * Handle a job failure.
     * @param UserRemovedFromNewsletterList $event
     * @return void
     */
    public function failed(UserRemovedFromNewsletterList $event)
    {
        event(new UserRemovedFromNewsletterList($event->user));
    }
}
