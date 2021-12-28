<?php

namespace App\Console\Commands;

use App\Jobs\InstalmentNotificationSender;
use App\Models\User;
use Illuminate\Console\Command;

class InstalmentAlertCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'instalment:notification-send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending instalment alert';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::all();
        InstalmentNotificationSender::dispatch($users)->delay(now()->addMinutes(1));
    }
}
