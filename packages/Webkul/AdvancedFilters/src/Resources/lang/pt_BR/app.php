<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'title' => 'Filtro Avançado',
                'info'  => 'Funcionalidade do filtro avançado.',

                'general' => [
                    'settings' => [
                        'title'                 => 'Configurações do Filtro Avançado',
                        'info'                  => 'Gerencie os recursos do módulo de filtro avançado.',
                        'status'                => 'Ativar Filtro Avançado',
                        'show-feedback-form'    => 'Exibir formulário de feedback',
                        'show-out-of-stock'     => 'Exibir produtos esgotados',
                        'show-popular-products' => 'Exibir seção de produtos populares',
                    ],
                ],
            ],
        ],
    ],

    'shop' => [
        'components' => [
            'products' => [
                'card' => [
                    'add-to-cart'  => 'Adicionar ao carrinho',
                    'out-of-stock' => 'Esgotado',
                ],
            ],
        ],

        'filters' => [
            'category-label'        => 'Categorias',
            'customer-ratings'      => 'Avaliações de clientes',
            'stock-availability'    => 'Disponibilidade em estoque',
            'out-of-stock'          => 'Esgotado',
            'exclude-out-of-stock'  => 'Excluir produtos esgotados',
            'special-offers'        => 'Ofertas especiais',
            'on-sale'               => 'Em promoção',
            'b1g1'                  => 'Compre 1, leve 1 grátis',
            'free-shipping'         => 'Frete grátis',
            'discount-range'        => 'Faixa de desconto',
            'popular-products'      => 'Produtos populares',
            'trending-now'          => 'Tendência agora',
            'top-rated'             => 'Mais bem avaliados',
            'best-sellers'          => 'Mais vendidos',
        ],

        'ratings' => [
            '5' => '★★★★★ (5 estrelas)',
            '4' => '★★★★☆ (4+ estrelas)',
            '3' => '★★★☆☆ (3+ estrelas)',
            '2' => '★★☆☆☆ (2+ estrelas)',
            '1' => '★☆☆☆☆ (1 estrela)',
        ],

        'discount_ranges' => [
            '10' => '10% ou mais',
            '20' => '20% ou mais',
            '30' => '30% ou mais',
            '40' => '40% ou mais',
            '50' => '50% ou mais',
        ],

        'feedback' => [
            'title'            => 'Você encontrou o que estava procurando?',
            'subtitle'         => 'Ajude-nos a melhorar sua experiência',
            'yes'              => 'Sim',
            'no'               => 'Não',
            'placeholder-yes'  => 'O que ajudou você a encontrar o que precisava?',
            'placeholder-no'   => 'O que você estava procurando? Como podemos melhorar?',
            'submit'           => 'Enviar feedback',
            'submitting'       => 'Enviando...',
            'thank-you'        => 'Obrigado pelo seu feedback!',
            'error'            => 'Ocorreu um erro ao enviar o feedback. Por favor, tente novamente.',
        ],
    ],
];
