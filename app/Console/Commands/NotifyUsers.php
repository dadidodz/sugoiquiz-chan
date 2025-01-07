<?php

namespace App\Console\Commands;

use App\Mail\WeeklyNotification;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class NotifyUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:notify-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = User::find(1);
        Mail::to($user->email)->send(new WeeklyNotification($user));
//        $users = User::all();
//
//        foreach ($users as $user) {
//            Mail::to($user->email)->send(new WeeklyNotification($user));
//        }

        $this->info('Les utilisateurs ont été notifiés avec succès.');
    }
}
