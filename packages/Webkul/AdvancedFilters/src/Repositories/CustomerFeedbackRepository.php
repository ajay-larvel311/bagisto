<?php

namespace Webkul\AdvancedFilters\Repositories;

use Webkul\AdvancedFilters\Contracts\CustomerFeedback;
use Webkul\Core\Eloquent\Repository;

class CustomerFeedbackRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CustomerFeedback::class;
    }
}
