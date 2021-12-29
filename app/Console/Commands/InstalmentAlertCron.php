<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use App\Notifications\InstalmentNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

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
        $users = DB::table('users')->join('users', 'id', 'user_id', 'licenses');
        Notification::send(User::all(), new InstalmentNotification());
    }
}
