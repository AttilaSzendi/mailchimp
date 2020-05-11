<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property int id
 * @property string name
 * @property string email
 * @property string password
 * @property boolean newsletter_subscription
 */
class User extends Authenticatable
{
    use Notifiable;

    const SUBSCRIBED = 'subscribed';
    const UNSUBSCRIBED = 'unsubscribed';
    const ALREADY_SUBSCRIBED = 'already-subscribed';
    const ALREADY_UNSUBSCRIBED = 'already-unsubscribed';

    protected $fillable = ['name', 'email', 'password', 'newsletter_subscription'];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
