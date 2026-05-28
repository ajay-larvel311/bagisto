<?php

namespace Webkul\AdvancedFilters\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\AdvancedFilters\Contracts\CustomerFeedback as CustomerFeedbackContract;

/**
 * CustomerFeedback Model
 */
class CustomerFeedback extends Model implements CustomerFeedbackContract
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customer_feedbacks';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'response',
        'feedback',
        'page_url',
        'category_id',
        'session_id',
        'ip_address',
    ];
}
