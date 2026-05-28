<?php

namespace Webkul\AdvancedFilters\Http\Controllers\Shop\API;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Schema;
use Webkul\AdvancedFilters\Repositories\CustomerFeedbackRepository;
use Webkul\Attribute\Repositories\AttributeRepository;
use Webkul\Category\Repositories\CategoryRepository;
use Webkul\Product\Repositories\ProductRepository;
use Webkul\Shop\Helpers\CatalogApiCache;
use Webkul\Shop\Http\Controllers\API\CategoryController as BaseCategoryController;
use Webkul\Shop\Http\Resources\AttributeResource;

class CategoryController extends BaseCategoryController
{
    public function __construct(
        protected AttributeRepository $attributeRepository,
        protected CategoryRepository $categoryRepository,
        protected ProductRepository $productRepository,
        protected CustomerFeedbackRepository $customerFeedbackRepository,
        protected CatalogApiCache $catalogApiCache
    ) {
        parent::__construct($attributeRepository, $categoryRepository, $productRepository, $catalogApiCache);
    }

    /**
     * Get all categorie options.
     */
    public function getCategoryOptions(): JsonResponse
    {
        $query = $this->categoryRepository->getAll(['status' => 1]);
        if ($search = request('search')) {
            $query = $query->filter(fn ($cat) => str_contains(strtolower($cat->name), strtolower($search))
            );
        }
        $perPage = 20;
        $page = request('page', 1);
        $paginated = $query->forPage($page, $perPage)->values();

        return response()->json([
            'data' => $paginated->map(fn ($cat) => [
                'id' => $cat->id,
                'name' => $cat->name,
            ]),
            'meta' => [
                'current_page' => (int) $page,
                'per_page' => $perPage,
                'total' => count($query),
                'last_page' => ceil(count($query) / $perPage),
            ],
        ]);
    }

    /**
     * Store customer feedback
     */
    public function storeFeedback(Request $request)
    {
        try {
            $feedbackData = [
                'response' => $request->input('response'),
                'feedback' => $request->input('feedback'),
                'page_url' => $request->input('page_url'),
            ];

            if (Schema::hasColumn('customer_feedbacks', 'category_id')) {
                $feedbackData['category_id'] = $request->input('category_id') === 'null'
                    ? null
                    : $request->input('category_id');
            }

            if (Schema::hasColumn('customer_feedbacks', 'session_id')) {
                $feedbackData['session_id'] = session()->getId();
            }

            if (Schema::hasColumn('customer_feedbacks', 'ip_address')) {
                $feedbackData['ip_address'] = $request->ip();
            }

            $this->customerFeedbackRepository->create($feedbackData);

            return response()->json([
                'success' => true,
                'message' => 'advancedfilters::app.feedback.thank-you',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'advancedfilters::app.feedback.error',
            ], 500);
        }
    }

    /**
     * Get all categories.
     */
    public function getAttributes(): JsonResource
    {
        if (! request('category_id')) {
            $filterableAttributes = $this->attributeRepository->getFilterableAttributes();
        } else {
            $category = $this->categoryRepository->findOrFail(request('category_id'));

            if (empty($filterableAttributes = $category->filterableAttributes)) {
                $filterableAttributes = $this->attributeRepository->getFilterableAttributes();
            }
        }

        $advanceFilterSettings = [
            'status' => core()->getConfigData('general.advancefilter.settings.status'),
            'show_feedback_form' => core()->getConfigData('general.advancefilter.settings.show_feedback_form'),
            'show_out_of_stock' => core()->getConfigData('general.advancefilter.settings.show_out_of_stock'),
            'show_popular_products' => core()->getConfigData('general.advancefilter.settings.show_popular_products'),
        ];

        $filters = AttributeResource::collection($filterableAttributes)->resolve();
        if ($advanceFilterSettings['status']) {
            array_unshift($filters, [
                'id' => 'category',
                'name' => trans('advancedfilters::app.shop.filters.category-label'),
                'code' => 'category',
                'type' => 'category',
                'options' => [],
            ]);

            $filters[] = [
                'id' => 'ratings',
                'name' => trans('advancedfilters::app.shop.filters.customer-ratings'),
                'code' => 'ratings',
                'type' => 'rating',
                'options' => [
                    ['id' => 5, 'name' => trans('advancedfilters::app.shop.ratings.5')],
                    ['id' => 4, 'name' => trans('advancedfilters::app.shop.ratings.4')],
                    ['id' => 3, 'name' => trans('advancedfilters::app.shop.ratings.3')],
                    ['id' => 2, 'name' => trans('advancedfilters::app.shop.ratings.2')],
                    ['id' => 1, 'name' => trans('advancedfilters::app.shop.ratings.1')],
                ],
            ];

            if ($advanceFilterSettings['show_out_of_stock']) {
                $filters[] = [
                    'id' => 'availability',
                    'name' => trans('advancedfilters::app.shop.filters.stock-availability'),
                    'code' => 'availability',
                    'type' => 'checkbox',
                    'options' => [
                        ['id' => 'out_of_stock', 'name' => trans('advancedfilters::app.shop.filters.out-of-stock')],
                        ['id' => 'exclude_out_of_stock', 'name' => trans('advancedfilters::app.shop.filters.exclude-out-of-stock')],
                    ],
                ];
            }

            $filters[] = [
                'id' => 'offers',
                'name' => trans('advancedfilters::app.shop.filters.special-offers'),
                'code' => 'offers',
                'type' => 'checkbox',
                'options' => [
                    ['id' => 'on_sale', 'name' => trans('advancedfilters::app.shop.filters.on-sale')],
                    ['id' => 'b1g1', 'name' => trans('advancedfilters::app.shop.filters.b1g1')],
                ],
            ];

            $filters[] = [
                'id' => 'discount',
                'name' => trans('advancedfilters::app.shop.filters.discount-range'),
                'code' => 'discount',
                'type' => 'checkbox',
                'options' => [
                    ['id' => '10', 'name' => trans('advancedfilters::app.shop.discount_ranges.10')],
                    ['id' => '20', 'name' => trans('advancedfilters::app.shop.discount_ranges.20')],
                    ['id' => '30', 'name' => trans('advancedfilters::app.shop.discount_ranges.30')],
                    ['id' => '40', 'name' => trans('advancedfilters::app.shop.discount_ranges.40')],
                    ['id' => '50', 'name' => trans('advancedfilters::app.shop.discount_ranges.50')],
                ],
            ];

            if ($advanceFilterSettings['show_popular_products']) {
                $filters[] = [
                    'id' => 'popular',
                    'name' => trans('advancedfilters::app.shop.filters.popular-products'),
                    'code' => 'popular',
                    'type' => 'checkbox',
                    'options' => [
                        ['id' => 'trending', 'name' => trans('advancedfilters::app.shop.filters.trending-now')],
                        ['id' => 'top_rated', 'name' => trans('advancedfilters::app.shop.filters.top-rated')],
                        ['id' => 'best_sellers', 'name' => trans('advancedfilters::app.shop.filters.best-sellers')],
                    ],
                ];
            }
        }

        return new JsonResource($filters);
    }
}
