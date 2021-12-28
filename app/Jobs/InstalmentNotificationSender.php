<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\InstalmentNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class InstalmentNotificationSender implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $users;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($users)
    {
        $this->users = $users;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // foreach ($this->users as $user) {
        //     $user->notify((new InstalmentNotification($user))->delay([
        //         'mail' => now()->addMinutes(1),
        //         // 'sms' => now()->addMinutes(10),
        //     ]));
        // }

        //Email
        // Notification::send($this->users, new InstalmentNotification());
            $users = User::all();
    Notification::send($users, new InstalmentNotification());
    }
}
