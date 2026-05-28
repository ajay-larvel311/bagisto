<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'title' => '高度なフィルター',
                'info'  => '高度なフィルター機能。',

                'general' => [
                    'settings' => [
                        'title'                 => '高度なフィルター設定',
                        'info'                  => '高度なフィルターモジュールの機能を管理します。',
                        'status'                => '高度なフィルターを有効にする',
                        'show-feedback-form'    => 'フィードバックフォームを表示',
                        'show-out-of-stock'     => '在庫切れの商品を表示',
                        'show-popular-products' => '人気商品セクションを表示',
                    ],
                ],
            ],
        ],
    ],

    'shop' => [
        'components' => [
            'products' => [
                'card' => [
                    'add-to-cart'  => 'カートに追加',
                    'out-of-stock' => '在庫切れ',
                ],
            ],
        ],

        'filters' => [
            'category-label'        => 'カテゴリー',
            'customer-ratings'      => 'カスタマーレビュー',
            'stock-availability'    => '在庫状況',
            'out-of-stock'          => '在庫切れ',
            'exclude-out-of-stock'  => '在庫切れを除外',
            'special-offers'        => '特別オファー',
            'on-sale'               => 'セール中',
            'b1g1'                  => '1つ購入で1つ無料',
            'free-shipping'         => '送料無料',
            'discount-range'        => '割引範囲',
            'popular-products'      => '人気商品',
            'trending-now'          => '今のトレンド',
            'top-rated'             => '高評価',
            'best-sellers'          => 'ベストセラー',
        ],

        'ratings' => [
            '5' => '★★★★★ (5つ星)',
            '4' => '★★★★☆ (4+ 星)',
            '3' => '★★★☆☆ (3+ 星)',
            '2' => '★★☆☆☆ (2+ 星)',
            '1' => '★☆☆☆☆ (1 星)',
        ],

        'discount_ranges' => [
            '10' => '10%以上',
            '20' => '20%以上',
            '30' => '30%以上',
            '40' => '40%以上',
            '50' => '50%以上',
        ],

        'feedback' => [
            'title'            => 'お探しのものは見つかりましたか？',
            'subtitle'         => 'ご利用体験向上のためご協力ください',
            'yes'              => 'はい',
            'no'               => 'いいえ',
            'placeholder-yes'  => '必要なものを見つけるのに何が役立ちましたか？',
            'placeholder-no'   => '何を探していましたか？改善のためにどのようにすればよいですか？',
            'submit'           => 'フィードバックを送信',
            'submitting'       => '送信中...',
            'thank-you'        => 'フィードバックありがとうございます！',
            'error'            => 'フィードバック送信中にエラーが発生しました。もう一度お試しください。',
        ],
    ],
];
