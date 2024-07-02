<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Testing\Fakes\Fake;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;



class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $typeProducts = DB::table('type_products')->pluck('Type_Id')->toArray();
        $factories = DB::table('factories')->pluck('Fac_Id')->toArray();
        $units = DB::table('units')->pluck('Un_Id')->toArray();
        $typeNameToIdMap = DB::table('type_products')->pluck('Type_Id', 'Type_Name')->toArray();


        $productNames = [
            'Laptop', 'Headphone', 'Mobile Phone', 'Television', 'Microwave', 'Refrigerator', 'Toaster',
            'Kettle', 'Blender', 'Coffee Machine', 'Watch', 'Camera', 'Keyboard', 'Mouse',
            'Tablet', 'Speaker', 'Charger', 'Oven', 'Air Conditioner', 'Fan',
            'Shoe', 'Bag', 'Belt', 'Sunglasses', 'Perfume', 'Jacket', 'T-Shirt',
            'Jeans', 'Pants', 'Sweater', 'Gloves', 'Hat', 'Scarf', 'Dress',
            'Shorts', 'Sandals', 'Socks', 'Boots', 'Lingerie', 'Tie', 'Suit',
            'Sneakers', 'Slippers', 'Sweatshirt', 'Pajamas', 'Swimsuit', 'Raincoat',
            'Joggers', 'Blouse', 'Skirt', 'High Heels', 'Muffler', 'Leggings',
            'Trousers', 'Shawl', 'Flip Flops', 'Tunic', 'Salwar', 'Ankle Boots',
            'Hoodie', 'Stole', 'Culottes', 'Capri', 'Jumpsuit', 'Romper', 'Camisole',
            'Top', 'Blazer', 'Saree', 'Kimono', 'Jacket Leather', 'Tights', 'Cardigan',
            'Gown', 'Trench Coat', 'Vest', 'Track Pants', 'Overcoat', 'Lapel Pin',
            'Bracelet', 'Earrings', 'Necklace', 'Bangle', 'Pendant', 'Ring',
            'Anklet', 'Brooch', 'Cufflink', 'Locket', 'Armlet', 'Choker',
            'Tiara', 'Hair Clip', 'Head Band', 'Wristband', 'Belly Chain',
            'Nose Ring', 'Toe Ring', 'Barrette', 'Bobby Pin', 'Ear Cuff',
            'Bindi', 'Hairband', 'Comb Pin', 'Chain', 'Stud'
        ];

        $typeToUnitsMap = [
            'Electronics' => ['Pieces', 'Boxes', 'Sets', 'Cases', 'Cartons'],
            'Clothing' => ['Pieces', 'Pairs', 'Sets', 'Boxes'],
            'Furniture' => ['Pieces', 'Sets', 'Boxes', 'Cartons'],
            'Books' => ['Pieces', 'Boxes', 'Sets', 'Cartons'],
            'Sports' => ['Pieces', 'Sets', 'Pairs', 'Boxes'],
            'Toys' => ['Pieces', 'Sets', 'Boxes', 'Cartons'],
            'Kitchenware' => ['Pieces', 'Sets', 'Boxes'],
            'Beauty & Health' => ['Pieces', 'Liters', 'Bottles', 'Tubes', 'Jars', 'Boxes', 'Packets', 'Rolls', 'Ounces'],
            'Automotive' => ['Pieces', 'Sets', 'Boxes', 'Liters', 'Gallons'],
            'Gardening' => ['Pieces', 'Sets', 'Bags', 'Kilograms', 'Liters', 'Packets', 'Gallons'],
            'Office Supplies' => ['Pieces', 'Sets', 'Boxes', 'Packets', 'Rolls', 'Sheets', 'Cartons'],
            'Pets' => ['Pieces', 'Bags', 'Boxes', 'Liters', 'Kilograms', 'Packets', 'Rolls'],
            'Footwear' => ['Pairs', 'Boxes', 'Cartons'],
            'Jewelry' => ['Pieces', 'Sets', 'Boxes', 'Cases'],
            'Travel & Luggage' => ['Pieces', 'Sets', 'Pairs'],
            'DIY & Tools' => ['Pieces', 'Sets', 'Boxes', 'Rolls', 'Meters', 'Liters', 'Gallons'],
            'Music & Instruments' => ['Pieces', 'Sets', 'Boxes', 'Albums', 'Rolls'],
            'Photography' => ['Pieces', 'Sets', 'Rolls', 'Boxes', 'Cases'],
            'Baby Products' => ['Pieces', 'Sets', 'Boxes', 'Bags', 'Packets'],
            'Groceries' => ['Kilograms', 'Liters', 'Boxes', 'Bags', 'Packets', 'Cans', 'Bottles', 'Jars', 'Cartons']
        ];

        $productToTypeMap = [
            'Laptop' => 'Electronics',
            'Headphone' => 'Electronics',
            'Mobile Phone' => 'Electronics',
            'Television' => 'Electronics',
            'Microwave' => 'Electronics',
            'Refrigerator' => 'Electronics',
            'Toaster' => 'Electronics',
            'Kettle' => 'Electronics',
            'Blender' => 'Electronics',
            'Coffee Machine' => 'Electronics',
            'Watch' => 'Electronics',
            'Camera' => 'Electronics',
            'Keyboard' => 'Electronics',
            'Mouse' => 'Electronics',
            'Tablet' => 'Electronics',
            'Speaker' => 'Electronics',
            'Charger' => 'Electronics',
            'Oven' => 'Electronics',
            'Air Conditioner' => 'Electronics',
            'Fan' => 'Electronics',

            'Shoe' => 'Footwear',
            'Sandals' => 'Footwear',
            'Socks' => 'Footwear',
            'Boots' => 'Footwear',
            'Sneakers' => 'Footwear',
            'Slippers' => 'Footwear',
            'High Heels' => 'Footwear',
            'Ankle Boots' => 'Footwear',
            'Flip Flops' => 'Footwear',

            'Bag' => 'Travel & Luggage',
            'Belt' => 'Clothing',
            'Sunglasses' => 'Clothing',
            'Perfume' => 'Beauty & Health',
            'Jacket' => 'Clothing',
            'T-Shirt' => 'Clothing',
            'Jeans' => 'Clothing',
            'Pants' => 'Clothing',
            'Sweater' => 'Clothing',
            'Gloves' => 'Clothing',
            'Hat' => 'Clothing',
            'Scarf' => 'Clothing',
            'Dress' => 'Clothing',
            'Shorts' => 'Clothing',
            'Lingerie' => 'Clothing',
            'Tie' => 'Clothing',
            'Suit' => 'Clothing',
            'Sweatshirt' => 'Clothing',
            'Pajamas' => 'Clothing',
            'Swimsuit' => 'Clothing',
            'Raincoat' => 'Clothing',
            'Joggers' => 'Clothing',
            'Blouse' => 'Clothing',
            'Skirt' => 'Clothing',
            'Muffler' => 'Clothing',
            'Leggings' => 'Clothing',
            'Trousers' => 'Clothing',
            'Shawl' => 'Clothing',
            'Tunic' => 'Clothing',
            'Salwar' => 'Clothing',
            'Hoodie' => 'Clothing',
            'Stole' => 'Clothing',
            'Culottes' => 'Clothing',
            'Capri' => 'Clothing',
            'Jumpsuit' => 'Clothing',
            'Romper' => 'Clothing',
            'Camisole' => 'Clothing',
            'Top' => 'Clothing',
            'Blazer' => 'Clothing',
            'Saree' => 'Clothing',
            'Kimono' => 'Clothing',
            'Jacket Leather' => 'Clothing',
            'Tights' => 'Clothing',
            'Cardigan' => 'Clothing',
            'Gown' => 'Clothing',
            'Trench Coat' => 'Clothing',
            'Vest' => 'Clothing',
            'Track Pants' => 'Clothing',
            'Overcoat' => 'Clothing',
            'Lapel Pin' => 'Clothing',

            'Bracelet' => 'Jewelry',
            'Earrings' => 'Jewelry',
            'Necklace' => 'Jewelry',
            'Bangle' => 'Jewelry',
            'Pendant' => 'Jewelry',
            'Ring' => 'Jewelry',
            'Anklet' => 'Jewelry',
            'Brooch' => 'Jewelry',
            'Cufflink' => 'Jewelry',
            'Locket' => 'Jewelry',
            'Armlet' => 'Jewelry',
            'Choker' => 'Jewelry',
            'Tiara' => 'Jewelry',
            'Hair Clip' => 'Beauty & Health',
            'Head Band' => 'Beauty & Health',
            'Wristband' => 'Jewelry',
            'Belly Chain' => 'Jewelry',
            'Nose Ring' => 'Jewelry',
            'Toe Ring' => 'Jewelry',
            'Barrette' => 'Beauty & Health',
            'Bobby Pin' => 'Beauty & Health',
            'Ear Cuff' => 'Jewelry',
            'Bindi' => 'Beauty & Health',
            'Hairband' => 'Beauty & Health',
            'Comb Pin' => 'Beauty & Health',
            'Chain' => 'Jewelry',
            'Stud' => 'Jewelry'
        ];



        foreach (range(1, 100) as $index) {
            $chosenProductName = $faker->randomElement($productNames);
            $chosenType = $productToTypeMap[$chosenProductName];
            $chosenTypeId = $typeNameToIdMap[$chosenType];
            $allowedUnitsForType = $typeToUnitsMap[$chosenType];

            $unitNameToIdMap = DB::table('units')->whereIn('Un_Name', $allowedUnitsForType)->pluck('Un_Id', 'Un_Name')->toArray();
            $chosenUnitName = $faker->randomElement($allowedUnitsForType);
            $chosenUnitId = $unitNameToIdMap[$chosenUnitName];

            DB::table('products')->insert([
                'Pro_Name' => $chosenProductName,
                'Type_product_id' => $chosenTypeId,
                'Factory_id' => $faker->randomElement($factories),
                'Pro_OnDate' => $faker->dateTimeThisYear(),
                'Pro_Price' => $faker->randomFloat(2, 1, 1000),
                'Unit_id' => $chosenUnitId,
                'Pro_Amount' => $faker->numberBetween(1, 100),
                'Pro_image' => $faker->imageUrl(640, 480, 'product'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }




    }
}

