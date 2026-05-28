<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'title' => 'Erweiterter Filter',
                'info'  => 'Funktionalität des erweiterten Filters.',

                'general' => [
                    'settings' => [
                        'title'                 => 'Einstellungen für den erweiterten Filter',
                        'info'                  => 'Verwalten Sie die Funktionen des Moduls für erweiterte Filter.',
                        'status'                => 'Erweiterten Filter aktivieren',
                        'show-feedback-form'    => 'Feedback-Formular anzeigen',
                        'show-out-of-stock'     => 'Nicht vorrätige Produkte anzeigen',
                        'show-popular-products' => 'Beliebte Produkte anzeigen',
                    ],
                ],
            ],
        ],
    ],

    'shop' => [
        'components' => [
            'products' => [
                'card' => [
                    'add-to-cart'  => 'In den Warenkorb',
                    'out-of-stock' => 'Nicht vorrätig',
                ],
            ],
        ],

        'filters' => [
            'category-label'        => 'Kategorien',
            'customer-ratings'      => 'Kundenbewertungen',
            'stock-availability'    => 'Verfügbarkeit',
            'out-of-stock'          => 'Nicht vorrätig',
            'exclude-out-of-stock'  => 'Nicht vorrätige Produkte ausschließen',
            'special-offers'        => 'Sonderangebote',
            'on-sale'               => 'Im Angebot',
            'b1g1'                  => '1 kaufen, 1 gratis',
            'free-shipping'         => 'Kostenloser Versand',
            'discount-range'        => 'Rabattbereich',
            'popular-products'      => 'Beliebte Produkte',
            'trending-now'          => 'Aktuell im Trend',
            'top-rated'             => 'Am besten bewertet',
            'best-sellers'          => 'Bestseller',
        ],

        'ratings' => [
            '5' => '★★★★★ (5 Sterne)',
            '4' => '★★★★☆ (4+ Sterne)',
            '3' => '★★★☆☆ (3+ Sterne)',
            '2' => '★★☆☆☆ (2+ Sterne)',
            '1' => '★☆☆☆☆ (1 Stern)',
        ],

        'discount_ranges' => [
            '10' => '10% und mehr',
            '20' => '20% und mehr',
            '30' => '30% und mehr',
            '40' => '40% und mehr',
            '50' => '50% und mehr',
        ],

        'feedback' => [
            'title'            => 'Haben Sie gefunden, wonach Sie gesucht haben?',
            'subtitle'         => 'Helfen Sie uns, Ihre Erfahrung zu verbessern',
            'yes'              => 'Ja',
            'no'               => 'Nein',
            'placeholder-yes'  => 'Was hat Ihnen geholfen, das zu finden, was Sie benötigen?',
            'placeholder-no'   => 'Wonach haben Sie gesucht? Wie können wir uns verbessern?',
            'submit'           => 'Feedback absenden',
            'submitting'       => 'Wird gesendet...',
            'thank-you'        => 'Vielen Dank für Ihr Feedback!',
            'error'            => 'Beim Absenden des Feedbacks ist ein Fehler aufgetreten. Bitte versuchen Sie es erneut.',
        ],
    ],
];
