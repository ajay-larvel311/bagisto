<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('customer_feedbacks', function (Blueprint $table) {
            if (! Schema::hasColumn('customer_feedbacks', 'category_id')) {
                $table->unsignedBigInteger('category_id')->nullable()->after('page_url');
            }

            if (! Schema::hasColumn('customer_feedbacks', 'session_id')) {
                $table->string('session_id')->nullable()->after('category_id');
            }

            if (! Schema::hasColumn('customer_feedbacks', 'ip_address')) {
                $table->string('ip_address', 45)->nullable()->after('session_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_feedbacks', function (Blueprint $table) {
            $columns = array_filter([
                Schema::hasColumn('customer_feedbacks', 'category_id') ? 'category_id' : null,
                Schema::hasColumn('customer_feedbacks', 'session_id') ? 'session_id' : null,
                Schema::hasColumn('customer_feedbacks', 'ip_address') ? 'ip_address' : null,
            ]);

            if ($columns !== []) {
                $table->dropColumn($columns);
            }
        });
    }
};
