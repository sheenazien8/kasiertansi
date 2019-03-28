<?php

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $faker = Faker\Factory::create();
        $users->each(function($user) use ($faker){
           for ($i = 0; $i <10 ; $i++) {
                $category = new Category();
                $category->fill([
                    'name' => $faker->name
                ]);
                $category->user()->associate($user);
                $category->save();
           }
        });
    }
}
