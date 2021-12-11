<?php

namespace App\Providers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Pagination\Paginator;
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
        //
        Relation::morphMap([
            'question' => Question::class,
            'answer' => Answer::class
        ]);
        
        Paginator::useBootstrap();
    }
}
