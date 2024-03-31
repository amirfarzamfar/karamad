<?php

namespace App\Listeners\Auth;

use App\Events\Auth\RegisterEvent;
use IPPanel\Client;

class SendRegisterSMS
{
    /**
     * Handle the event.
     */
    public function handle(RegisterEvent $event): void
    {
        $client = new Client(env("IP_PANEL_TOKEN"));
        $patternValues = [
            "code" => $event->code
        ];
        $client->sendPattern(
            "2zacbeyiurmt5oi",
            "+983000505",
            $event->user->phone_number,
            $patternValues
        );
    }
}
