<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AmDailyTimeRecord>
 */
class AmDailyTimeRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'interns_id' => 1,
            'arrival_am' => $this->faker->date('H:i:s'),
            'departure_am' => $this->faker->date('H:i:s'),
            'late_am' => $this->faker->date('H:i:s'),
            'hours_worked_am' => $this->faker->date('H:i:s'),
            'date' => $this->faker->date('Y-m-d')
        ];
    }
}
