<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'title' => 'Filtre Avancé',
                'info'  => 'Fonctionnalité du filtre avancé.',

                'general' => [
                    'settings' => [
                        'title'                 => 'Paramètres du Filtre Avancé',
                        'info'                  => 'Gérez les fonctionnalités du module de filtre avancé.',
                        'status'                => 'Activer le filtre avancé',
                        'show-feedback-form'    => 'Afficher le formulaire de retour',
                        'show-out-of-stock'     => 'Afficher les produits en rupture de stock',
                        'show-popular-products' => 'Afficher la section des produits populaires',
                    ],
                ],
            ],
        ],
    ],

    'shop' => [
        'components' => [
            'products' => [
                'card' => [
                    'add-to-cart'  => 'Ajouter au panier',
                    'out-of-stock' => 'Rupture de stock',
                ],
            ],
        ],

        'filters' => [
            'category-label'        => 'Catégories',
            'customer-ratings'      => 'Avis des clients',
            'stock-availability'    => 'Disponibilité du stock',
            'out-of-stock'          => 'Rupture de stock',
            'exclude-out-of-stock'  => 'Exclure les produits en rupture de stock',
            'special-offers'        => 'Offres spéciales',
            'on-sale'               => 'En promotion',
            'b1g1'                  => 'Achetez 1, obtenez 1 gratuit',
            'free-shipping'         => 'Livraison gratuite',
            'discount-range'        => 'Plage de remise',
            'popular-products'      => 'Produits populaires',
            'trending-now'          => 'Tendance actuelle',
            'top-rated'             => 'Les mieux notés',
            'best-sellers'          => 'Meilleures ventes',
        ],

        'ratings' => [
            '5' => '★★★★★ (5 étoiles)',
            '4' => '★★★★☆ (4+ étoiles)',
            '3' => '★★★☆☆ (3+ étoiles)',
            '2' => '★★☆☆☆ (2+ étoiles)',
            '1' => '★☆☆☆☆ (1 étoile)',
        ],

        'discount_ranges' => [
            '10' => '10% et plus',
            '20' => '20% et plus',
            '30' => '30% et plus',
            '40' => '40% et plus',
            '50' => '50% et plus',
        ],

        'feedback' => [
            'title'            => 'Avez-vous trouvé ce que vous cherchiez ?',
            'subtitle'         => 'Aidez-nous à améliorer votre expérience',
            'yes'              => 'Oui',
            'no'               => 'Non',
            'placeholder-yes'  => 'Qu’est-ce qui vous a aidé à trouver ce dont vous aviez besoin ?',
            'placeholder-no'   => 'Que cherchiez-vous ? Comment pouvons-nous nous améliorer ?',
            'submit'           => 'Envoyer les commentaires',
            'submitting'       => 'Envoi en cours...',
            'thank-you'        => 'Merci pour vos commentaires !',
            'error'            => 'Une erreur est survenue lors de l’envoi des commentaires. Veuillez réessayer.',
        ],
    ],
];
