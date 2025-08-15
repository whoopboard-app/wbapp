<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class ClearExpiredVerifyCodes extends Command
{
    protected $signature = 'verify-codes:clear';
    protected $description = 'Clear expired email verification codes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = User::whereNotNull('verify_code_expire_at')
            ->where('verify_code_expire_at', '<', now())
            ->get()
            ->each->clearExpiredVerifyCode();

        $this->info("Expired verification codes cleared. ({$count} users updated)");
    }
}
