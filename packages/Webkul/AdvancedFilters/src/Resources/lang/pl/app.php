<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'title' => 'Filtr Zaawansowany',
                'info'  => 'Funkcjonalność filtra zaawansowanego.',

                'general' => [
                    'settings' => [
                        'title'                 => 'Ustawienia Filtra Zaawansowanego',
                        'info'                  => 'Zarządzaj funkcjami modułu filtra zaawansowanego.',
                        'status'                => 'Włącz filtr zaawansowany',
                        'show-feedback-form'    => 'Pokaż formularz opinii',
                        'show-out-of-stock'     => 'Pokaż produkty niedostępne',
                        'show-popular-products' => 'Pokaż sekcję popularnych produktów',
                    ],
                ],
            ],
        ],
    ],

    'shop' => [
        'components' => [
            'products' => [
                'card' => [
                    'add-to-cart'  => 'Dodaj do koszyka',
                    'out-of-stock' => 'Niedostępne',
                ],
            ],
        ],

        'filters' => [
            'category-label'        => 'Kategorie',
            'customer-ratings'      => 'Oceny klientów',
            'stock-availability'    => 'Dostępność w magazynie',
            'out-of-stock'          => 'Niedostępne',
            'exclude-out-of-stock'  => 'Wyklucz produkty niedostępne',
            'special-offers'        => 'Oferty specjalne',
            'on-sale'               => 'W promocji',
            'b1g1'                  => 'Kup 1, drugi gratis',
            'free-shipping'         => 'Darmowa wysyłka',
            'discount-range'        => 'Zakres rabatu',
            'popular-products'      => 'Popularne produkty',
            'trending-now'          => 'Obecnie popularne',
            'top-rated'             => 'Najwyżej oceniane',
            'best-sellers'          => 'Bestsellery',
        ],

        'ratings' => [
            '5' => '★★★★★ (5 gwiazdek)',
            '4' => '★★★★☆ (4+ gwiazdek)',
            '3' => '★★★☆☆ (3+ gwiazdek)',
            '2' => '★★☆☆☆ (2+ gwiazdek)',
            '1' => '★☆☆☆☆ (1 gwiazdka)',
        ],

        'discount_ranges' => [
            '10' => '10% i więcej',
            '20' => '20% i więcej',
            '30' => '30% i więcej',
            '40' => '40% i więcej',
            '50' => '50% i więcej',
        ],

        'feedback' => [
            'title'            => 'Czy znalazłeś to, czego szukałeś?',
            'subtitle'         => 'Pomóż nam ulepszyć Twoje doświadczenie',
            'yes'              => 'Tak',
            'no'               => 'Nie',
            'placeholder-yes'  => 'Co pomogło Ci znaleźć to, czego potrzebowałeś?',
            'placeholder-no'   => 'Czego szukałeś? Jak możemy się poprawić?',
            'submit'           => 'Wyślij opinię',
            'submitting'       => 'Wysyłanie...',
            'thank-you'        => 'Dziękujemy za Twoją opinię!',
            'error'            => 'Wystąpił błąd podczas wysyłania opinii. Spróbuj ponownie.',
        ],
    ],
];
