<?php

namespace Webkul\AdvancedFilters\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
    ];

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $eventTemplates = [
            [
                'event'    => 'bagisto.admin.layout.head',
                'template' => 'advancedfilters::style.index',
            ],
            [
                'event'    => 'bagisto.shop.layout.head.before',
                'template' => 'advancedfilters::style.index',
            ],
        ];

        foreach ($eventTemplates as $eventTemplate) {
            Event::listen(current($eventTemplate), fn ($e) => $e->addTemplate(end($eventTemplate)));
        }
    }
}
