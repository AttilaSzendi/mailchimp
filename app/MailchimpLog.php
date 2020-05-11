<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property int type_id
 * @property string email
 * @property int status
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class MailchimpLog extends Model
{
    const SUBSCRIBE_TYPE_ID = 1;
    const UNSUBSCRIBE_TYPE_ID = 2;

    protected $fillable = ['type_id', 'email', 'status'];
}
