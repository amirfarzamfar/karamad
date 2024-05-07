<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class DeleteUnverifiedUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-unverified-user-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove unverified users after 4 minutes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        User::where('phone_number_verified_at', null)
            ->where('created_at', '<', now()->subMinutes(4))
            ->delete();

    }
}
