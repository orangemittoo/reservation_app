<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->addSQLLog();
    }

    private function addSQLLog()
    {
        \DB::listen(function ($query) {
            \Log::debug("Query Time:{$query->time}s] $query->sql");
            if ($query->bindings) {
                \Log::debug("Query Bindings:" . json_encode($query->bindings));
            }
        });
    }
}
