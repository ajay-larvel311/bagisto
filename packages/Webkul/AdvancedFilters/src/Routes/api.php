<?php

use Illuminate\Support\Facades\Route;
use Webkul\AdvancedFilters\Http\Controllers\Shop\API\CategoryController;

Route::group(['prefix' => 'api'], function () {

    Route::controller(CategoryController::class)->prefix('categories')->group(function () {

        Route::get('category-options', 'getCategoryOptions')->name('shop.api.categories.category_options');

        Route::get('popular-categories', 'getPopularCategories')->name('shop.api.categories.popular_categories');

        Route::post('feedback', 'storeFeedback')->name('shop.api.categories.feedback');

        Route::get('attributes', 'getAttributes')->name('advancedfilters.api.categories.attributes');
    });
});
