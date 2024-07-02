<?php

namespace Database\Factories;

use App\Models\TypeProduct;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TypeProduct>
 */
class TypeProductFactory extends Factory
{

    protected $model = TypeProduct::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
{
    $productTypes = [
        'Electronics', 'Clothing', 'Furniture', 'Books', 'Sports', 'Toys',
        'Kitchenware', 'Beauty & Health', 'Automotive', 'Gardening',
        'Office Supplies', 'Pets', 'Footwear', 'Jewelry', 'Travel & Luggage',
        'DIY & Tools', 'Music & Instruments', 'Photography', 'Baby Products', 'Groceries'
    ];

    return [
        'Type_Name' => $this->faker->unique()->randomElement($productTypes),
    ];
}


}
