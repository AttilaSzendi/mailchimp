<?php

namespace App\Providers;

use App\Events\UserAddedToNewsletterList;
use App\Events\UserRemovedFromNewsletterList;
use App\Listeners\AddSubscriberToMailchimpList;
use App\Listeners\RemoveSubscriberFromMailchimpList;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UserAddedToNewsletterList::class => [
            AddSubscriberToMailchimpList::class,
        ],

        UserRemovedFromNewsletterList::class => [
            RemoveSubscriberFromMailchimpList::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
