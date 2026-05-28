<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'title' => '高级过滤器',
                'info'  => '高级过滤器功能。',

                'general' => [
                    'settings' => [
                        'title'                 => '高级过滤器设置',
                        'info'                  => '管理高级过滤器模块的功能。',
                        'status'                => '启用高级过滤器',
                        'show-feedback-form'    => '显示反馈表单',
                        'show-out-of-stock'     => '显示缺货商品',
                        'show-popular-products' => '显示热门商品板块',
                    ],
                ],
            ],
        ],
    ],

    'shop' => [
        'components' => [
            'products' => [
                'card' => [
                    'add-to-cart'  => '加入购物车',
                    'out-of-stock' => '缺货',
                ],
            ],
        ],

        'filters' => [
            'category-label'        => '类别',
            'customer-ratings'      => '客户评分',
            'stock-availability'    => '库存情况',
            'out-of-stock'          => '缺货',
            'exclude-out-of-stock'  => '排除缺货',
            'special-offers'        => '特别优惠',
            'on-sale'               => '促销中',
            'b1g1'                  => '买一送一',
            'free-shipping'         => '免运费',
            'discount-range'        => '折扣范围',
            'popular-products'      => '热门商品',
            'trending-now'          => '当前趋势',
            'top-rated'             => '高评分',
            'best-sellers'          => '畅销商品',
        ],

        'ratings' => [
            '5' => '★★★★★ (5 星)',
            '4' => '★★★★☆ (4+ 星)',
            '3' => '★★★☆☆ (3+ 星)',
            '2' => '★★☆☆☆ (2+ 星)',
            '1' => '★☆☆☆☆ (1 星)',
        ],

        'discount_ranges' => [
            '10' => '10%及以上',
            '20' => '20%及以上',
            '30' => '30%及以上',
            '40' => '40%及以上',
            '50' => '50%及以上',
        ],

        'feedback' => [
            'title'            => '您找到所需的商品了吗？',
            'subtitle'         => '帮助我们提升您的购物体验',
            'yes'              => '是',
            'no'               => '否',
            'placeholder-yes'  => '什么帮助您找到了所需商品？',
            'placeholder-no'   => '您在寻找什么？我们该如何改进？',
            'submit'           => '提交反馈',
            'submitting'       => '提交中...',
            'thank-you'        => '感谢您的反馈！',
            'error'            => '提交反馈时出错，请重试。',
        ],
    ],
];
