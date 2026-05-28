<?php

namespace Webkul\AdvancedFilters\Repositories;

use Illuminate\Support\Facades\DB;
use Webkul\Attribute\Enums\AttributeTypeEnum;
use Webkul\Product\Repositories\ProductRepository as BaseProductRepository;

class ProductRepository extends BaseProductRepository
{
    /**
     * Search From Database
     */
    public function searchFromDatabase(array $params = [])
    {
        $params['url_key'] ??= null;

        if (! empty($params['query'])) {
            $params['name'] = $params['query'];
        }
        $sortOptions = parent::getSortOptions($params);

        $query = $this->with([
            'attribute_family',
            'images',
            'videos',
            'attribute_values',
            'price_indices',
            'inventory_indices',
            'reviews',
            'variants',
            'variants.attribute_family',
            'variants.attribute_values',
            'variants.price_indices',
            'variants.inventory_indices',
        ])->scopeQuery(function ($query) use ($params) {
            $prefix = DB::getTablePrefix();
            $qb = $query->distinct()
                ->select('products.*')
                ->leftJoin('products as variants', DB::raw('COALESCE('.$prefix.'variants.parent_id, '.$prefix.'variants.id)'), '=', 'products.id')
                ->leftJoin('product_price_indices', function ($join) {
                    $customerGroup = $this->customerRepository->getCurrentGroup();
                    $join->on('products.id', '=', 'product_price_indices.product_id')
                        ->where('product_price_indices.customer_group_id', $customerGroup->id);
                });

            if (! empty($params['category'])) {
                $categoryIds = is_array($params['category'])
                    ? $params['category']
                    : explode(',', $params['category']);

                $qb->leftJoin('product_categories as pc', 'pc.product_id', '=', 'products.id')
                    ->whereIn('pc.category_id', $categoryIds)
                    ->groupBy('products.id');
            }

            if (! empty($params['channel_id'])) {
                $channelIds = is_array($params['channel_id'])
                    ? $params['channel_id']
                    : explode(',', $params['channel_id']);

                $qb->leftJoin('product_channels', 'products.id', '=', 'product_channels.product_id')
                    ->whereIn('product_channels.channel_id', $channelIds);
            }

            if (! empty($params['ratings'])) {
                $ratings = is_array($params['ratings'])
                    ? $params['ratings']
                    : explode(',', $params['ratings']);

                $qb->whereHas('reviews', function ($q) use ($ratings) {
                    $q->where(function ($subQ) use ($ratings) {
                        foreach ($ratings as $rating) {
                            $subQ->orWhere('rating', '>=', (int) $rating);
                        }
                    });
                });
            }

            if (! empty($params['availability'])) {
                $availabilityOptions = is_array($params['availability'])
                    ? $params['availability']
                    : explode(',', $params['availability']);

                $qb->where(function ($subQuery) use ($availabilityOptions) {
                    foreach ($availabilityOptions as $option) {
                        switch ($option) {
                            case 'out_of_stock':
                                $subQuery->orWhereHas('inventories', function ($q) {
                                    $q->where('qty', '<=', 0);
                                });
                                break;

                            case 'exclude_out_of_stock':
                                $subQuery->orWhereHas('inventories', function ($q) {
                                    $q->where('qty', '>', 0);
                                });
                                break;
                        }
                    }
                });
            }

            if (! empty($params['offers'])) {
                $offers = is_array($params['offers']) ? $params['offers'] : explode(',', str_replace(' ', '', $params['offers']));
                $qb->where(function ($subQuery) use ($offers, $prefix) {
                    foreach ($offers as $offer) {
                        $subQuery->orWhere(function ($q) use ($offer, $prefix) {
                            switch ($offer) {
                                case 'on_sale':
                                    $q->whereColumn("{$prefix}product_price_indices.min_price", '<', "{$prefix}product_price_indices.regular_min_price");
                                    break;
                                case 'b1g1':
                                    $q->whereRaw("JSON_EXTRACT({$prefix}products.additional, '$.b1g1') = 1");
                                    break;
                            }
                        });
                    }
                });
            }

            if (! empty($params['discount'])) {
                $discounts = is_array($params['discount']) ? $params['discount'] : explode(',', str_replace(' ', '', $params['discount']));
                $qb->where(function ($subQuery) use ($discounts, $prefix) {
                    foreach ($discounts as $discountPercent) {
                        $subQuery->orWhere(function ($q) use ($discountPercent, $prefix) {
                            $q->whereColumn("{$prefix}product_price_indices.min_price", '<', "{$prefix}product_price_indices.regular_min_price")
                                ->whereRaw("(({$prefix}product_price_indices.regular_min_price - {$prefix}product_price_indices.min_price) / {$prefix}product_price_indices.regular_min_price) * 100 >= ?", [(int) $discountPercent]);
                        });
                    }
                });
            }

            if (! empty($params['popular'])) {
                $popularOptions = is_array($params['popular'])
                    ? $params['popular']
                    : explode(',', $params['popular']);
                foreach ($popularOptions as $option) {
                    switch ($option) {
                        case 'trending':
                        case 'top_5':
                            $qb->leftJoin('order_items as oi_trending', 'products.id', '=', 'oi_trending.product_id')
                                ->leftJoin('orders as o_trending', function ($join) {
                                    $join->on('oi_trending.order_id', '=', 'o_trending.id')
                                        ->where('o_trending.status', 'completed')
                                        ->where('o_trending.created_at', '>=', now()->subDays(30));
                                })
                                ->groupBy('products.id')
                                ->orderByRaw('COUNT(oi_trending.id) DESC')
                                ->limit(5);
                            break;
                        case 'top_rated':
                            $qb->whereHas('reviews')
                                ->withAvg('reviews', 'rating')
                                ->orderBy('reviews_avg_rating', 'desc');
                            break;
                        case 'best_sellers':
                            $qb->leftJoin('order_items as oi_bestseller', 'products.id', '=', 'oi_bestseller.product_id')
                                ->leftJoin('orders as o_bestseller', function ($join) {
                                    $join->on('oi_bestseller.order_id', '=', 'o_bestseller.id')
                                        ->where('o_bestseller.status', 'completed');
                                })
                                ->groupBy('products.id')
                                ->orderByRaw('COUNT(oi_bestseller.id) DESC');
                            break;
                    }
                }
            }

            if (! empty($params['type'])) {
                $qb->where('products.type', $params['type']);
                if (
                    $params['type'] === 'simple'
                    && ! empty($params['exclude_customizable_products'])
                ) {
                    $qb->leftJoin('product_customizable_options', 'products.id', '=', 'product_customizable_options.product_id')
                        ->whereNull('product_customizable_options.id');
                }
            }

            if (! empty($params['price'])) {
                $priceRange = explode(',', $params['price']);
                if (count($priceRange) >= 2) {
                    $qb->whereBetween('product_price_indices.min_price', [
                        core()->convertToBasePrice(current($priceRange)),
                        core()->convertToBasePrice(end($priceRange)),
                    ]);
                }
            }

            $filterableAttributes = $this->attributeRepository->getProductDefaultAttributes(array_keys($params));
            $attributes = $filterableAttributes->whereIn('code', [
                'name',
                'status',
                'visible_individually',
                'url_key',
            ]);

            foreach ($attributes as $attribute) {
                $alias = $attribute->code.'_product_attribute_values';
                $qb->leftJoin('product_attribute_values as '.$alias, 'products.id', '=', $alias.'.product_id')
                    ->where($alias.'.attribute_id', $attribute->id);
                if ($attribute->code == 'name') {
                    $synonyms = $this->searchSynonymRepository->getSynonymsByQuery(urldecode($params['name']));
                    $qb->where(function ($subQuery) use ($alias, $synonyms) {
                        foreach ($synonyms as $synonym) {
                            $subQuery->orWhere($alias.'.text_value', 'like', '%'.$synonym.'%');
                        }
                    });
                } elseif ($attribute->code == 'url_key') {
                    if (empty($params['url_key'])) {
                        $qb->whereNotNull($alias.'.text_value');
                    } else {
                        $qb->where($alias.'.text_value', 'like', '%'.urldecode($params['url_key']).'%');
                    }
                } else {
                    if (is_null($params[$attribute->code])) {
                        continue;
                    }

                    $qb->where($alias.'.'.$attribute->column_name, 1);
                }
            }

            $attributes = $filterableAttributes->whereNotIn('code', [
                'price',
                'name',
                'status',
                'visible_individually',
                'url_key',
            ]);

            if ($attributes->isNotEmpty()) {
                $qb->where(function ($filterQuery) use ($qb, $params, $attributes, $prefix) {
                    $aliases = [
                        'products' => 'product_attribute_values',
                        'variants' => 'variant_attribute_values',
                    ];

                    foreach ($aliases as $table => $tableAlias) {
                        $filterQuery->orWhere(function ($subFilterQuery) use ($qb, $params, $attributes, $prefix, $table, $tableAlias) {
                            foreach ($attributes as $attribute) {
                                if (! isset($params[$attribute->code])) {
                                    continue;
                                }

                                $alias = $attribute->code.'_'.$tableAlias;

                                $qb->leftJoin('product_attribute_values as '.$alias, function ($join) use ($table, $alias, $attribute) {
                                    $join->on($table.'.id', '=', $alias.'.product_id');
                                    $join->where($alias.'.attribute_id', $attribute->id);
                                });

                                $paramValues = is_array($params[$attribute->code])
                                    ? $params[$attribute->code]
                                    : explode(',', $params[$attribute->code]);

                                if (in_array($attribute->type, [
                                    AttributeTypeEnum::CHECKBOX->value,
                                    AttributeTypeEnum::MULTISELECT->value,
                                ])) {
                                    $subFilterQuery->where(function ($query) use ($paramValues, $alias, $attribute, $prefix) {
                                        foreach ($paramValues as $value) {
                                            $query->orWhereRaw("FIND_IN_SET(?, {$prefix}{$alias}.{$attribute->column_name})", [$value]);
                                        }
                                    });
                                } else {
                                    $subFilterQuery->whereIn($alias.'.'.$attribute->column_name, $paramValues);
                                }
                            }
                        });
                    }
                });

                $qb->groupBy('products.id');
            }

            $parentSortOptions = parent::getSortOptions($params);
            $enhancedSortOptions = $this->getEnhancedSortOptions($params);
            $finalSortOptions = array_merge($parentSortOptions, $enhancedSortOptions);
            $this->applySorting($qb, $finalSortOptions);

            return $qb->groupBy('products.id');
        });

        $limit = $this->getPerPageLimit($params);

        return $query->paginate($limit);
    }

    /**
     * Apply sorting logic to the query
     */
    protected function applySorting($qb, $sortOptions)
    {
        if ($sortOptions['order'] == 'rand') {
            return $qb->inRandomOrder();
        }
        $attribute = $this->attributeRepository->findOneByField('code', $sortOptions['sort']);
        if ($attribute) {
            if ($attribute->code === 'price') {
                $qb->orderBy('product_price_indices.min_price', $sortOptions['order']);
            } else {
                $alias = 'sort_product_attribute_values';
                $qb->leftJoin('product_attribute_values as '.$alias, function ($join) use ($alias, $attribute) {
                    $join->on('products.id', '=', $alias.'.product_id')
                        ->where($alias.'.attribute_id', $attribute->id);

                    if ($attribute->value_per_channel) {
                        if ($attribute->value_per_locale) {
                            $join->where($alias.'.channel', core()->getRequestedChannelCode())
                                ->where($alias.'.locale', core()->getRequestedLocaleCode());
                        } else {
                            $join->where($alias.'.channel', core()->getRequestedChannelCode());
                        }
                    } else {
                        if ($attribute->value_per_locale) {
                            $join->where($alias.'.locale', core()->getRequestedLocaleCode());
                        }
                    }
                })
                    ->orderBy($alias.'.'.$attribute->column_name, $sortOptions['order']);
            }
        } else {
            switch ($sortOptions['sort']) {
                case 'orders_count':
                case 'popularity':
                    $qb->leftJoin('order_items as oi_sort', 'products.id', '=', 'oi_sort.product_id')
                        ->leftJoin('orders as o_sort', function ($join) {
                            $join->on('oi_sort.order_id', '=', 'o_sort.id')
                                ->where('o_sort.status', 'completed');
                        })
                        ->orderByRaw('COUNT(oi_sort.id) '.$sortOptions['order']);
                    break;
                case 'rating':
                    $qb->leftJoin('product_reviews', 'products.id', '=', 'product_reviews.product_id')
                        ->orderByRaw('AVG(product_reviews.rating) '.$sortOptions['order']);
                    break;
                default:

                    $qb->orderBy('products.created_at', $sortOptions['order']);
            }
        }

        return $qb;
    }

    /**
     * Get custom sorting options for enhanced filters
     */
    protected function getEnhancedSortOptions($params)
    {
        $sortOptions = [
            'sort'  => 'created_at',
            'order' => 'desc',
        ];

        if (! empty($params['sort'])) {
            $sortOptions['sort'] = $params['sort'];
        }

        if (! empty($params['order'])) {
            $sortOptions['order'] = $params['order'];
        }

        if (! empty($params['popular'])) {
            $sortOptions = [
                'sort'  => 'orders_count',
                'order' => 'desc',
            ];
        }

        return $sortOptions;
    }
}
