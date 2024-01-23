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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->ulid('id')->primary();

            $table->string('title');

            $table->text('description');

            $table->json('content');

            $table->unsignedBigInteger('goal_amount');
            $table->unsignedBigInteger('current_amount')->default(0);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->enum('status',\App\Enums\CampaignEnum::toValues());
            $table->enum('priority',\App\Enums\CampaignPriorityEnum::toValues());
            $table->foreignUlid('province_id')->references('id')->on('provinces')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUlid('cause_id')->references('id')->on('causes')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->dateTime('posted_at');
            $table->foreignUlid('posted_by_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};