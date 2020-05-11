<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RemoteSubscriptionController extends Controller
{
    public function store(Request $request)
    {
        $email = $request->get('data')['email'];

        $request->get('type') === "subscribe"
            ? $this->subscribe($email)
            : $this->unsubscribe($email);
    }

    protected function subscribe(string $email)
    {
        $user = User::query()->firstOrNew(['email' => $email]);
        $user->name = $email;
        $user->newsletter_subscription = true;
        $user->password = bcrypt(Str::random());
        $user->save();
    }

    protected function unsubscribe(string $email)
    {
        $user = User::query()->where('email', $email)->firstOrFail();
        $user->newsletter_subscription = false;
        $user->save();
    }
}
