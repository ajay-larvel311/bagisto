<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'title' => 'Filtro Avanzato',
                'info'  => 'Funzionalità del filtro avanzato.',

                'general' => [
                    'settings' => [
                        'title'                 => 'Impostazioni del Filtro Avanzato',
                        'info'                  => 'Gestisci le funzionalità del modulo filtro avanzato.',
                        'status'                => 'Abilita Filtro Avanzato',
                        'show-feedback-form'    => 'Mostra modulo di feedback',
                        'show-out-of-stock'     => 'Mostra prodotti esauriti',
                        'show-popular-products' => 'Mostra sezione prodotti popolari',
                    ],
                ],
            ],
        ],
    ],

    'shop' => [
        'components' => [
            'products' => [
                'card' => [
                    'add-to-cart'  => 'Aggiungi al carrello',
                    'out-of-stock' => 'Esaurito',
                ],
            ],
        ],

        'filters' => [
            'category-label'        => 'Categorie',
            'customer-ratings'      => 'Valutazioni clienti',
            'stock-availability'    => 'Disponibilità magazzino',
            'out-of-stock'          => 'Esaurito',
            'exclude-out-of-stock'  => 'Escludi prodotti esauriti',
            'special-offers'        => 'Offerte speciali',
            'on-sale'               => 'In sconto',
            'b1g1'                  => 'Compra 1, ricevi 1 gratis',
            'free-shipping'         => 'Spedizione gratuita',
            'discount-range'        => 'Fascia di sconto',
            'popular-products'      => 'Prodotti popolari',
            'trending-now'          => 'In tendenza',
            'top-rated'             => 'Migliori valutazioni',
            'best-sellers'          => 'Più venduti',
        ],

        'ratings' => [
            '5' => '★★★★★ (5 stelle)',
            '4' => '★★★★☆ (4+ stelle)',
            '3' => '★★★☆☆ (3+ stelle)',
            '2' => '★★☆☆☆ (2+ stelle)',
            '1' => '★☆☆☆☆ (1 stella)',
        ],

        'discount_ranges' => [
            '10' => '10% e oltre',
            '20' => '20% e oltre',
            '30' => '30% e oltre',
            '40' => '40% e oltre',
            '50' => '50% e oltre',
        ],

        'feedback' => [
            'title'            => 'Hai trovato quello che cercavi?',
            'subtitle'         => 'Aiutaci a migliorare la tua esperienza',
            'yes'              => 'Sì',
            'no'               => 'No',
            'placeholder-yes'  => 'Cosa ti ha aiutato a trovare ciò di cui avevi bisogno?',
            'placeholder-no'   => 'Cosa stavi cercando? Come possiamo migliorare?',
            'submit'           => 'Invia feedback',
            'submitting'       => 'Invio in corso...',
            'thank-you'        => 'Grazie per il tuo feedback!',
            'error'            => 'Si è verificato un errore durante l\'invio del feedback. Riprova.',
        ],
    ],
];
