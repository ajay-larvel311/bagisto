<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'title' => 'Geavanceerd Filter',
                'info'  => 'Functionaliteit van het geavanceerde filter.',

                'general' => [
                    'settings' => [
                        'title'                 => 'Instellingen Geavanceerd Filter',
                        'info'                  => 'Beheer de functies van de geavanceerde filtermodule.',
                        'status'                => 'Geavanceerd filter inschakelen',
                        'show-feedback-form'    => 'Feedbackformulier tonen',
                        'show-out-of-stock'     => 'Niet op voorraad tonen',
                        'show-popular-products' => 'Populaire producten sectie tonen',
                    ],
                ],
            ],
        ],
    ],

    'shop' => [
        'components' => [
            'products' => [
                'card' => [
                    'add-to-cart'  => 'Toevoegen aan winkelwagen',
                    'out-of-stock' => 'Niet op voorraad',
                ],
            ],
        ],

        'filters' => [
            'category-label'        => 'Categorieën',
            'customer-ratings'      => 'Klantenbeoordelingen',
            'stock-availability'    => 'Voorraadbeschikbaarheid',
            'out-of-stock'          => 'Niet op voorraad',
            'exclude-out-of-stock'  => 'Niet op voorraad uitsluiten',
            'special-offers'        => 'Speciale aanbiedingen',
            'on-sale'               => 'In de aanbieding',
            'b1g1'                  => 'Koop 1, krijg 1 gratis',
            'free-shipping'         => 'Gratis verzending',
            'discount-range'        => 'Kortingsbereik',
            'popular-products'      => 'Populaire producten',
            'trending-now'          => 'Nu trending',
            'top-rated'             => 'Hoogst beoordeeld',
            'best-sellers'          => 'Bestsellers',
        ],

        'ratings' => [
            '5' => '★★★★★ (5 sterren)',
            '4' => '★★★★☆ (4+ sterren)',
            '3' => '★★★☆☆ (3+ sterren)',
            '2' => '★★☆☆☆ (2+ sterren)',
            '1' => '★☆☆☆☆ (1 ster)',
        ],

        'discount_ranges' => [
            '10' => '10% en hoger',
            '20' => '20% en hoger',
            '30' => '30% en hoger',
            '40' => '40% en hoger',
            '50' => '50% en hoger',
        ],

        'feedback' => [
            'title'            => 'Heeft u gevonden wat u zocht?',
            'subtitle'         => 'Help ons uw ervaring te verbeteren',
            'yes'              => 'Ja',
            'no'               => 'Nee',
            'placeholder-yes'  => 'Wat heeft u geholpen te vinden wat u nodig had?',
            'placeholder-no'   => 'Wat zocht u? Hoe kunnen we verbeteren?',
            'submit'           => 'Feedback verzenden',
            'submitting'       => 'Bezig met verzenden...',
            'thank-you'        => 'Bedankt voor uw feedback!',
            'error'            => 'Er is een fout opgetreden bij het verzenden van de feedback. Probeer het opnieuw.',
        ],
    ],
];
