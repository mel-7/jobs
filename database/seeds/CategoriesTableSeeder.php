<?php

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
        $category = new \App\Category([
            'id'       => 1,
            'title'    => 'Fresh Food',
            'slug'     => 'fresh-food',
            'parent'   => 0
        ]);
        $category->save();
        $category = new \App\Category([
            'id'       => 2,
            'title'    => 'Drinks Tea and Coffee',
            'slug'     => 'drinks-tea-and-coffee',
            'parent'   => 0
        ]);
        $category->save();
        $category = new \App\Category([
            'id'       => 3,
            'title'    => 'Food Cupboard',
            'slug'     => 'food-cupboard',
            'parent'   => 0
        ]);
        $category->save();
        $category = new \App\Category([
            'id'       => 4,
            'title'    => 'Personal Care',
            'slug'     => 'personal-care',
            'parent'   => 0
        ]);
        $category->save();
        $category = new \App\Category([
            'id'       => 5,
            'title'    => 'Fruits and Vegetables',
            'slug'     => 'fruits-and-vegetables',
            'parent'   => 1
        ]);
        $category->save();
        $category = new \App\Category([
            'id'       => 6,
            'title'    => 'Bakery',
            'slug'     => 'bakery',
            'parent'   => 1
        ]);
        $category->save();
        $category = new \App\Category([
            'id'       => 7,
            'title'    => 'Meat and Poultry',
            'slug'     => 'meat-and-poultry',
            'parent'   => 1
        ]);
        $category->save();
        $category = new \App\Category([
            'id'       => 8,
            'title'    => 'Dairy and Eggs',
            'slug'     => 'dairy-and-eggs',
            'parent'   => 1
        ]);
    }
}
