<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'title' => 'Advance Filter',
                'info'  => 'Advance Filter functionality.',

                'general' => [
                    'settings' => [
                        'title'                 => 'Advance Filter Settings',
                        'info'                  => 'Manage features for the advance filter module.',
                        'status'                => 'Enable Advance Filter',
                        'show-feedback-form'    => 'Show Feedback Form',
                        'show-out-of-stock'     => 'Show Out of Stock',
                        'show-popular-products' => 'Show Popular Products Section',
                    ],
                ],
            ],
        ],
    ],

    'shop' => [
        'components' => [
            'products' => [
                'card' => [
                    'add-to-cart'   => 'Add To Cart',
                    'out-of-stock'  => 'Out of Stock',
                ],
            ],
        ],

        'filters' => [
            'category-label'        => 'Categories',
            'customer-ratings'      => 'Customer Ratings',
            'stock-availability'    => 'Stock Availability',
            'out-of-stock'          => 'Out of Stock',
            'exclude-out-of-stock'  => 'Exclude Out of Stock',
            'special-offers'        => 'Special Offers',
            'on-sale'               => 'On Sale',
            'b1g1'                  => 'Buy 1 Get 1',
            'free-shipping'         => 'Free Shipping',
            'discount-range'        => 'Discount Range',
            'popular-products'      => 'Popular Products',
            'trending-now'          => 'Trending Now',
            'top-rated'             => 'Top Rated',
            'best-sellers'          => 'Best Sellers',
        ],

        'ratings' => [
            '5' => '★★★★★ (5 stars)',
            '4' => '★★★★☆ (4+ stars)',
            '3' => '★★★☆☆ (3+ stars)',
            '2' => '★★☆☆☆ (2+ stars)',
            '1' => '★☆☆☆☆ (1+ stars)',
        ],

        'discount_ranges' => [
            '10' => '10% & Up',
            '20' => '20% & Up',
            '30' => '30% & Up',
            '40' => '40% & Up',
            '50' => '50% & Up',
        ],

        'feedback' => [
            'title'            => 'Did you find what you were looking for?',
            'subtitle'         => 'Help us improve your experience',
            'yes'              => 'Yes',
            'no'               => 'No',
            'placeholder-yes'  => 'What helped you find what you needed?',
            'placeholder-no'   => 'What were you looking for? How can we improve?',
            'submit'           => 'Submit Feedback',
            'submitting'       => 'Submitting...',
            'thank-you'        => 'Thank you for your feedback!',
            'error'            => 'There was an error submitting your feedback. Please try again.',
        ],
    ],
];
