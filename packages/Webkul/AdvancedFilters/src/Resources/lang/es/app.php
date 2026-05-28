<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'title' => 'Filtro Avanzado',
                'info'  => 'Funcionalidad del filtro avanzado.',

                'general' => [
                    'settings' => [
                        'title'                 => 'Configuración del Filtro Avanzado',
                        'info'                  => 'Gestiona las funciones del módulo de filtro avanzado.',
                        'status'                => 'Habilitar Filtro Avanzado',
                        'show-feedback-form'    => 'Mostrar formulario de comentarios',
                        'show-out-of-stock'     => 'Mostrar productos agotados',
                        'show-popular-products' => 'Mostrar sección de productos populares',
                    ],
                ],
            ],
        ],
    ],

    'shop' => [
        'components' => [
            'products' => [
                'card' => [
                    'add-to-cart'  => 'Añadir al carrito',
                    'out-of-stock' => 'Agotado',
                ],
            ],
        ],

        'filters' => [
            'category-label'        => 'Categorías',
            'customer-ratings'      => 'Valoraciones de clientes',
            'stock-availability'    => 'Disponibilidad de stock',
            'out-of-stock'          => 'Agotado',
            'exclude-out-of-stock'  => 'Excluir productos agotados',
            'special-offers'        => 'Ofertas especiales',
            'on-sale'               => 'En oferta',
            'b1g1'                  => 'Compra 1 y lleva 1 gratis',
            'free-shipping'         => 'Envío gratis',
            'discount-range'        => 'Rango de descuento',
            'popular-products'      => 'Productos populares',
            'trending-now'          => 'Tendencias ahora',
            'top-rated'             => 'Mejor valorados',
            'best-sellers'          => 'Más vendidos',
        ],

        'ratings' => [
            '5' => '★★★★★ (5 estrellas)',
            '4' => '★★★★☆ (4+ estrellas)',
            '3' => '★★★☆☆ (3+ estrellas)',
            '2' => '★★☆☆☆ (2+ estrellas)',
            '1' => '★☆☆☆☆ (1 estrella)',
        ],

        'discount_ranges' => [
            '10' => '10% o más',
            '20' => '20% o más',
            '30' => '30% o más',
            '40' => '40% o más',
            '50' => '50% o más',
        ],

        'feedback' => [
            'title'            => '¿Encontraste lo que buscabas?',
            'subtitle'         => 'Ayúdanos a mejorar tu experiencia',
            'yes'              => 'Sí',
            'no'               => 'No',
            'placeholder-yes'  => '¿Qué te ayudó a encontrar lo que necesitabas?',
            'placeholder-no'   => '¿Qué estabas buscando? ¿Cómo podemos mejorar?',
            'submit'           => 'Enviar comentarios',
            'submitting'       => 'Enviando...',
            'thank-you'        => '¡Gracias por tus comentarios!',
            'error'            => 'Hubo un error al enviar tus comentarios. Por favor, inténtalo de nuevo.',
        ],
    ],
];
