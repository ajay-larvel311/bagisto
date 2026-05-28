<?php

return [
    [
        'key'  => 'general.advancefilter',
        'name' => 'advancedfilters::app.admin.configuration.index.title',
        'info' => 'advancedfilters::app.admin.configuration.index.info',
        'icon' => 'settings/store.svg',
        'sort' => 7,
    ], [
        'key'    => 'general.advancefilter.settings',
        'name'   => 'advancedfilters::app.admin.configuration.index.general.settings.title',
        'info'   => 'advancedfilters::app.admin.configuration.index.general.settings.info',
        'sort'   => 1,
        'fields' => [
            [
                'name'          => 'status',
                'title'         => 'advancedfilters::app.admin.configuration.index.general.settings.status',
                'type'          => 'boolean',
                'default'       => true,
                'channel_based' => true,

            ], [
                'name'          => 'show_feedback_form',
                'title'         => 'advancedfilters::app.admin.configuration.index.general.settings.show-feedback-form',
                'type'          => 'boolean',
                'default'       => false,
                'channel_based' => true,

            ], [
                'name'          => 'show_out_of_stock',
                'title'         => 'advancedfilters::app.admin.configuration.index.general.settings.show-out-of-stock',
                'type'          => 'boolean',
                'default'       => true,
                'channel_based' => true,

            ], [
                'name'          => 'show_popular_products',
                'title'         => 'advancedfilters::app.admin.configuration.index.general.settings.show-popular-products',
                'type'          => 'boolean',
                'default'       => true,
                'channel_based' => true,
            ],
        ],
    ],
];
