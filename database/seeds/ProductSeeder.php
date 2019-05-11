<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //sample category
        $sepatu = Category::create(['title' => 'Sepatu']);
        $sepatu->childs()->saveMany([
            new Category(['title' => 'Lifestyle']),
            new Category(['title' => 'Berlari']),
            new Category(['title' => 'Basket']),
            new Category(['title' => 'Sepakbola'])
        ]);

        $pakaian = Category::create(['title' => 'Pakaian']);
        $pakaian->childs()->saveMany([
            new Category(['title' => 'Jaket']),
            new Category(['title' => 'Hoodie']),
            new Category(['title' => 'Rompi'])
        ]);

        //sample product
        $running = Category::where('title', 'Berlari')->first();
        $lifestyle = Category::where('title', 'Lifestyle')->first();

        $sepatu1 = Product::Create([
            'name' => 'Nike Air Force',
            'model' => 'Sepatu Pria',
            'photo' => 'stub-shoe.jpg',
            'price' => 420000
        ]);

        $sepatu2 = Product::Create([
            'name' => 'Nike Air Max',
            'model' => 'Sepatu Pria',
            'photo' => 'stub-shoe.jpg',
            'price' => 360000
        ]);

        $sepatu3 = Product::Create([
            'name' => 'Nike Air Zoom',
            'model' => 'Sepatu Wanita',
            'photo' => 'stub-shoe.jpg',
            'price' => 360000
        ]);

        $running->products()->saveMany([$sepatu1, $sepatu2, $sepatu3]);
        $lifestyle->products()->saveMany([$sepatu1, $sepatu2]);

        $jaket = Category::where('title', 'Jaket')->first();
        $vest = Category::where('title', 'Rompi')->first();

        $jaket1 = Product::Create([
            'name' => 'Nike Aeroloft Bomber',
            'model' => 'Jaket Wanita',
            'photo' => 'stub-jaket.jpg',
            'price' => 720000
        ]);

        $jaket2 = Product::Create([
            'name' => 'Nike Guild 550',
            'model' => 'Jaket Pria',
            'photo' => 'stub-jaket.jpg',
            'price' => 380000
        ]);

        $jaket3 = Product::Create([
            'name' => 'Nike SB Steele',
            'model' => 'Jaket Pria',
            'photo' => 'stub-jaket.jpg',
            'price' => 1200000
        ]);

        $jaket->products()->saveMany([$jaket1, $jaket3]);
        $vest->products()->saveMany([$jaket2, $jaket3]);
    }
}
