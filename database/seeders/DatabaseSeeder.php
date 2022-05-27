<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        // User::truncate();
        // Category::truncate();
        // Transaction::truncate();

        Product::truncate();
        DB::table('category_product')->truncate();

        // $usersQuantity = 20;
        // $categoriesQuantity = 5;
        // $productsQuantity = 30;
        // $transactionsQuantity = 30;

        // User::factory($usersQuantity)->create();
        // Category::factory($categoriesQuantity)->create();
        // Product::factory($productsQuantity)->create()->each(function ($product) {
        //     $categories = Category::all()->random(mt_rand(1, 5))->pluck('id');
        //     $product->categories()->attach($categories);
        // });
        // Transaction::factory($transactionsQuantity)->create();
    }
}
