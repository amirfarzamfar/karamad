<?php

namespace App\Listeners\Auth;

use App\Events\Auth\ResetPasswordEvent;
use IPPanel\Client;

class SendResetPasswordSMS
{
    /**
     * Handle the event.
     */
    public function handle(ResetPasswordEvent $event): void
    {
        $client = new Client(env('IP_PANEL_TOKEN'));
        $patternValues = [
            'code' => $event->code
        ];
        $client->sendPattern(
            'r94ppjgw3uxo3u5',
            '+983000505',
            $event->user->phone_number,
            $patternValues
        );
    }
}
