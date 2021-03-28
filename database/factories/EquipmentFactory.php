<?php

namespace Database\Factories;

use App\Models\Clinic;
use App\Models\Equipment;
use Illuminate\Database\Eloquent\Factories\Factory;

class EquipmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     * @var string
     */
    protected $model = Equipment::class;

    /**
     * Define the model's default state.
     * @return array
     */
    public function definition()
    {
        return [
            'status' => rand(1, 2),
            'clinic_id' => Clinic::all()->random(1)->first()->id,
            'name' => $this->faker->name,
            'supply_date' => $this->faker->date(),
            'stock' => $this->faker->numberBetween(1, 100),
            'unit_price' => $this->faker->randomFloat(2, 0.01, 1000),
            'rate' => $this->faker->randomFloat(2, 0, 100)
        ];
    }
}
