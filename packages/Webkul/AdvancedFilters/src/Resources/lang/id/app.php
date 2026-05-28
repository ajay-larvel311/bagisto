<?php

return [
    'admin' => [
        'configuration' => [
            'index' => [
                'title' => 'Filter Lanjutan',
                'info'  => 'Fungsionalitas filter lanjutan.',

                'general' => [
                    'settings' => [
                        'title'                 => 'Pengaturan Filter Lanjutan',
                        'info'                  => 'Kelola fitur modul filter lanjutan.',
                        'status'                => 'Aktifkan Filter Lanjutan',
                        'show-feedback-form'    => 'Tampilkan Formulir Umpan Balik',
                        'show-out-of-stock'     => 'Tampilkan Produk Habis',
                        'show-popular-products' => 'Tampilkan Bagian Produk Populer',
                    ],
                ],
            ],
        ],
    ],

    'shop' => [
        'components' => [
            'products' => [
                'card' => [
                    'add-to-cart'  => 'Tambahkan ke Keranjang',
                    'out-of-stock' => 'Habis',
                ],
            ],
        ],

        'filters' => [
            'category-label'        => 'Kategori',
            'customer-ratings'      => 'Rating Pelanggan',
            'stock-availability'    => 'Ketersediaan Stok',
            'out-of-stock'          => 'Habis',
            'exclude-out-of-stock'  => 'Kecualikan Produk Habis',
            'special-offers'        => 'Penawaran Spesial',
            'on-sale'               => 'Sedang Diskon',
            'b1g1'                  => 'Beli 1 Dapat 1 Gratis',
            'free-shipping'         => 'Gratis Ongkir',
            'discount-range'        => 'Rentang Diskon',
            'popular-products'      => 'Produk Populer',
            'trending-now'          => 'Sedang Tren',
            'top-rated'             => 'Terbaik Dinilai',
            'best-sellers'          => 'Terlaris',
        ],

        'ratings' => [
            '5' => '★★★★★ (5 bintang)',
            '4' => '★★★★☆ (4+ bintang)',
            '3' => '★★★☆☆ (3+ bintang)',
            '2' => '★★☆☆☆ (2+ bintang)',
            '1' => '★☆☆☆☆ (1 bintang)',
        ],

        'discount_ranges' => [
            '10' => '10% ke atas',
            '20' => '20% ke atas',
            '30' => '30% ke atas',
            '40' => '40% ke atas',
            '50' => '50% ke atas',
        ],

        'feedback' => [
            'title'            => 'Apakah Anda menemukan apa yang Anda cari?',
            'subtitle'         => 'Bantu kami meningkatkan pengalaman Anda',
            'yes'              => 'Ya',
            'no'               => 'Tidak',
            'placeholder-yes'  => 'Apa yang membantu Anda menemukan apa yang Anda butuhkan?',
            'placeholder-no'   => 'Apa yang Anda cari? Bagaimana kami bisa meningkat?',
            'submit'           => 'Kirim Umpan Balik',
            'submitting'       => 'Mengirim...',
            'thank-you'        => 'Terima kasih atas umpan balik Anda!',
            'error'            => 'Terjadi kesalahan saat mengirim umpan balik. Silakan coba lagi.',
        ],
    ],
];
