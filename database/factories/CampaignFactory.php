<?php

namespace Database\Factories;

use App\Enums\CampaignEnum;
use App\Enums\CampaignPriorityEnum;
use App\Models\Campaign;
use App\Models\Cause;
use App\Models\District;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CampaignFactory extends Factory
{
    protected $model = Campaign::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'goal_amount' => $this->faker->randomFloat(2, 100, 1000),
            'current_amount' => $this->faker->randomFloat(2, 100, 1000),
            'start_date' => $this->faker->dateTime,
            'end_date' => $this->faker->dateTime,
            'status' => $this->faker->randomElement(CampaignEnum::toValues()),
            'priority' => $this->faker->randomElement(CampaignPriorityEnum::toValues()),
            'district_id' => $this->faker->randomElement(District::all()->pluck('id')),
            'cause_id' => $this->faker->randomElement(Cause::all()->pluck('id')),
            'posted_at' => $this->faker->dateTime,
            'posted_by_id' => $this->faker->randomElement(User::all()->pluck('id')),
        ];
    }
}