<?php

use App\Models\EpsilonAccountService;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('sync_remote_account_services', function () {
    try {
        EpsilonAccountService::getSyncRemoteAccountServices();
    } catch (\Exception $e) {
         \Log::error('Error with syncing ACC Services from API: '. $e->getMessage());
         $this->error($e->getMessage());
    }
    $this->info('Sync services opration completed.');
})->purpose('Sync account services from API');
