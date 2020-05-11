<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionRequest;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Database\Eloquent\Model;

class SubscriptionController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::all());
    }

    public function store(SubscriptionRequest $request)
    {
        return $this->saveNewsletterSubscriptionValue($request->get('userId'), true);
    }

    public function destroy(SubscriptionRequest $request)
    {
        return $this->saveNewsletterSubscriptionValue($request->get('userId'), false);
    }

    /**
     * @param int $userId
     * @param bool $value
     * @return User|Model
     */
    private function saveNewsletterSubscriptionValue(int $userId, bool $value): User
    {
        $user = User::query()->find($userId);
        $user->newsletter_subscription = $value;
        $user->save();
        return $user;
    }
}
