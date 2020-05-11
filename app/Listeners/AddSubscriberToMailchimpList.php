<?php

namespace App\Listeners;

use App\MailchimpLog;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\Newsletter\NewsletterFacade;

class AddSubscriberToMailchimpList implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $response = NewsletterFacade::subscribe($event->user->email);

        MailchimpLog::query()->create([
            'type_id' => MailchimpLog::SUBSCRIBE_TYPE_ID,
            'email' => $event->user->email,
            'status' => $response ? User::SUBSCRIBED : User::ALREADY_SUBSCRIBED
        ]);
    }
}
