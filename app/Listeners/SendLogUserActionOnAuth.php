<?php

namespace App\Listeners;


use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\DB;

class SendLogUserActionOnAuth
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get information from event.
     */
    private function parseEvent($event)
    {
        $table = $event->table;
    }

    private function getUserInfo(): array
    {
        $user = backpack_user();
        $ip = request()->ip();
        $agent = request()->server('HTTP_USER_AGENT');
        $url = request()->url();
        return [
            'user_id' => $user->id,
            'url' => $url,
            'ip' => $ip,
            'agent' => $agent,
        ];
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {

        // check if all logs is on
        if (DB::table('settings')->where('key', 'user_logging_all')->first()->value == '0') {
            return;
        }
        // check if auth logs is on
        if (DB::table('settings')->where('key', 'user_logging_auth')->first()->value == '0') {
            return;
        }
        DB::table('log_user_events')->insert([
            'user_id' => $this->getUserInfo()['user_id'],
            'url' => $this->getUserInfo()['url'],
            'ip' => $this->getUserInfo()['ip'],
            'agent' => $this->getUserInfo()['agent'],
            'data' => '',
            'tags' => $event->user->getTable(),
            'event' => 'user login',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}