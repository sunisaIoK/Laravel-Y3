<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Unit;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Unit>
 */
class UnitFactory extends Factory
{

    protected $model = Unit::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
{
    $unitTypes = [
        'Pieces', // Common for most types e.g. Electronics, Toys
        'Pairs',  // For Footwear
        'Kilograms', // For Groceries, Gardening products (soil, fertilizers)
        'Liters', // For Liquid Groceries, Beauty & Health (perfumes, creams)
        'Boxes', // Common for most types
        'Bags',  // Groceries, Gardening products
        'Sets',  // Toys, DIY & Tools
        'Meters', // For DIY, Furniture fabrics
        'Packets', // For Groceries (powders, crisps)
        'Cans',  // Groceries
        'Bottles', // Beauty & Health, Groceries (drinks)
        'Sheets', // Office Supplies (paper)
        'Jars',  // Groceries, Beauty & Health
        'Rolls', // Photography (films), Office Supplies (tape)
        'Tubes', // Beauty & Health (creams, toothpaste), DIY (adhesives)
        'Cartons', // Common for most types
        'Albums', // Music & Instruments
        'Gallons', // Automotive (fuel), Gardening
        'Ounces',  // Beauty & Health, Groceries
        'Cases'   // Electronics, Photography
    ];

    return [
        'Un_Name' => $this->faker->unique()->randomElement($unitTypes),
    ];
}
}
