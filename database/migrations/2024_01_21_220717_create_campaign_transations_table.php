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
        Schema::create('campaign_transactions', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->float('amount',30,6)->default(0);
            $table->foreignUlid('campaign_id')->references('id')->on('campaigns')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('transaction_id');
            $table->string('name')->default('anónimo');
            $table->enum( 'payment_method',\App\Enums\CampaignPaymentMethodEnum::toValues());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign_transations');
    }
};
