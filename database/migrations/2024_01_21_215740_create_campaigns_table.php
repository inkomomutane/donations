<?php

use App\Enums\CampaignEnum;
use App\Enums\CampaignPriorityEnum;
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
        Schema::create('campaigns',static function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('title');
            $table->text('description');
            $table->unsignedFloat('goal_amount',30, 6);
            $table->unsignedFloat('current_amount',30,6)->default(0);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->enum('status', CampaignEnum::toValues());
            $table->enum('priority', CampaignPriorityEnum::toValues());
            $table->foreignUlid('district_id')->references('id')->on('districts')
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
