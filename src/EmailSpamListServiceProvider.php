<?php

namespace Maksim_N\EmailSpamList;

use Illuminate\Support\ServiceProvider;
use Maksim_N\EmailSpamList\Console\Commands\EmailSpamList;
use Maksim_N\EmailSpamList\Console\Commands\EmailSpam;

class EmailSpamListServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__.'/routes.php';
        $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');
        if ($this->app->runningInConsole()) {
            $this->commands([
                EmailSpam::class,
                EmailSpamList::class,
            ]);
        }
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
