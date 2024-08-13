<?php
namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        \App\Events\NewsPosted::class => [
            \App\Listeners\SendNewsNotification::class,
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}
