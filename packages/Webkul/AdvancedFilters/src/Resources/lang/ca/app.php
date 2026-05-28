<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'title' => 'Filtre Avançat',
                'info'  => 'Funcionalitat del filtre avançat.',

                'general' => [
                    'settings' => [
                        'title'                 => 'Configuració del Filtre Avançat',
                        'info'                  => 'Gestiona les funcions del mòdul de filtre avançat.',
                        'status'                => 'Habilitar Filtre Avançat',
                        'show-feedback-form'    => 'Mostrar formulari de comentaris',
                        'show-out-of-stock'     => 'Mostrar productes esgotats',
                        'show-popular-products' => 'Mostrar secció de productes populars',
                    ],
                ],
            ],
        ],
    ],

    'shop' => [
        'components' => [
            'products' => [
                'card' => [
                    'add-to-cart'  => 'Afegir a la cistella',
                    'out-of-stock' => 'Esgotat',
                ],
            ],
        ],

        'filters' => [
            'category-label'        => 'Categories',
            'customer-ratings'      => 'Valoracions dels clients',
            'stock-availability'    => 'Disponibilitat d\'estoc',
            'out-of-stock'          => 'Esgotat',
            'exclude-out-of-stock'  => 'Excloure productes esgotats',
            'special-offers'        => 'Ofertes especials',
            'on-sale'               => 'En venda',
            'b1g1'                  => 'Compra 1 i emporta 1 gratis',
            'free-shipping'         => 'Enviament gratuït',
            'discount-range'        => 'Rang de descompte',
            'popular-products'      => 'Productes populars',
            'trending-now'          => 'Tendències actuals',
            'top-rated'             => 'Millor valorats',
            'best-sellers'          => 'Més venuts',
        ],

        'ratings' => [
            '5' => '★★★★★ (5 estrelles)',
            '4' => '★★★★☆ (4+ estrelles)',
            '3' => '★★★☆☆ (3+ estrelles)',
            '2' => '★★☆☆☆ (2+ estrelles)',
            '1' => '★☆☆☆☆ (1 estrella)',
        ],

        'discount_ranges' => [
            '10' => '10% o més',
            '20' => '20% o més',
            '30' => '30% o més',
            '40' => '40% o més',
            '50' => '50% o més',
        ],

        'feedback' => [
            'title'            => 'Has trobat el que buscaves?',
            'subtitle'         => 'Ajuda\'ns a millorar la teva experiència',
            'yes'              => 'Sí',
            'no'               => 'No',
            'placeholder-yes'  => 'Què t\'ha ajudat a trobar el que necessitaves?',
            'placeholder-no'   => 'Què estaves buscant? Com podem millorar?',
            'submit'           => 'Enviar comentaris',
            'submitting'       => 'Enviant...',
            'thank-you'        => 'Gràcies pels teus comentaris!',
            'error'            => 'Hi ha hagut un error en enviar els comentaris. Torna-ho a provar.',
        ],
    ],
];
