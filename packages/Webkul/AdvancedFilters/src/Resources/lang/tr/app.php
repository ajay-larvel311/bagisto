<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'title' => 'Gelişmiş Filtre',
                'info'  => 'Gelişmiş filtre işlevselliği.',

                'general' => [
                    'settings' => [
                        'title'                 => 'Gelişmiş Filtre Ayarları',
                        'info'                  => 'Gelişmiş filtre modülünün özelliklerini yönetin.',
                        'status'                => 'Gelişmiş Filtreyi Etkinleştir',
                        'show-feedback-form'    => 'Geri Bildirim Formunu Göster',
                        'show-out-of-stock'     => 'Stokta Olmayan Ürünleri Göster',
                        'show-popular-products' => 'Popüler Ürünler Bölümünü Göster',
                    ],
                ],
            ],
        ],
    ],

    'shop' => [
        'components' => [
            'products' => [
                'card' => [
                    'add-to-cart'  => 'Sepete Ekle',
                    'out-of-stock' => 'Stokta Yok',
                ],
            ],
        ],

        'filters' => [
            'category-label'        => 'Kategoriler',
            'customer-ratings'      => 'Müşteri Puanları',
            'stock-availability'    => 'Stok Durumu',
            'out-of-stock'          => 'Stokta Yok',
            'exclude-out-of-stock'  => 'Stokta Olmayanları Hariç Tut',
            'special-offers'        => 'Özel Teklifler',
            'on-sale'               => 'İndirimde',
            'b1g1'                  => '1 Al, 1 Bedava',
            'free-shipping'         => 'Ücretsiz Kargo',
            'discount-range'        => 'İndirim Aralığı',
            'popular-products'      => 'Popüler Ürünler',
            'trending-now'          => 'Şu Anda Trend',
            'top-rated'             => 'En Yüksek Puanlı',
            'best-sellers'          => 'En Çok Satanlar',
        ],

        'ratings' => [
            '5' => '★★★★★ (5 yıldız)',
            '4' => '★★★★☆ (4+ yıldız)',
            '3' => '★★★☆☆ (3+ yıldız)',
            '2' => '★★☆☆☆ (2+ yıldız)',
            '1' => '★☆☆☆☆ (1 yıldız)',
        ],

        'discount_ranges' => [
            '10' => '%10 ve üzeri',
            '20' => '%20 ve üzeri',
            '30' => '%30 ve üzeri',
            '40' => '%40 ve üzeri',
            '50' => '%50 ve üzeri',
        ],

        'feedback' => [
            'title'            => 'Aradığınızı buldunuz mu?',
            'subtitle'         => 'Deneyiminizi geliştirmemize yardımcı olun',
            'yes'              => 'Evet',
            'no'               => 'Hayır',
            'placeholder-yes'  => 'İhtiyacınız olanı bulmanıza ne yardımcı oldu?',
            'placeholder-no'   => 'Ne arıyordunuz? Nasıl geliştirebiliriz?',
            'submit'           => 'Geri Bildirim Gönder',
            'submitting'       => 'Gönderiliyor...',
            'thank-you'        => 'Geri bildiriminiz için teşekkürler!',
            'error'            => 'Geri bildirim gönderilirken bir hata oluştu. Lütfen tekrar deneyin.',
        ],
    ],
];
