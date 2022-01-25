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
        $this->app->singleton(
            \App\Repositories\User\UserRepositoryInterface::class,
            \App\Repositories\User\UserRepository::class,
        );

        $this->app->singleton(
            \App\Repositories\Blog\BlogRepositoryInterface::class,
            \App\Repositories\Blog\BlogRepository::class,
        );

        $this->app->singleton(
            \App\Repositories\Blogselect\BlogselectRepositoryInterface::class,
            \App\Repositories\Blogselect\BlogselectRepository::class,
        );

        $this->app->singleton(
            \App\Repositories\Comment\CommentRepositoryInterface::class,
            \App\Repositories\Comment\CommentRepository::class,
        );

        $this->app->singleton(
            \App\Repositories\Star\StarRepositoryInterface::class,
            \App\Repositories\Star\StarRepository::class,
        );

        $this->app->singleton(
            \App\Repositories\Point\PointRepositoryInterface::class,
            \App\Repositories\Point\PointRepository::class,
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
