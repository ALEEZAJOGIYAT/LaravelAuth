<?php

namespace App\Providers;

use App\Providers\LoginHistory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SaveUserLoginHistory
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Providers\LoginHistory  $event
     * @return void
     */
    public function handle(LoginHistory $event)
    {
        //
        $current_Time_Stamp=Carbon::now()->toDateTimeString();
        $userData=$event-> user;
        $saveUserData=DB::table('login_history')->insert(
            ['name'=> $userData->name ,
             'email' => $userData->email,
             'created_at' => $userData->created_at,
             'updated_at' => $userData -> updated_at
             ]
        );
        return $saveUserData;
    }
}
