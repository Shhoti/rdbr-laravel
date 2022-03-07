<?php

namespace App\Providers;

use App\Models\Candidate;
use App\Observers\CandidateObserver;
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
        Candidate::observe(CandidateObserver::class);

    }
}
