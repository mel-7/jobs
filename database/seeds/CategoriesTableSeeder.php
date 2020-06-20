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
            'title'    => 'Job Role',
            'slug'     => 'job-role',
            'parent'   => 0
        ]);
        $category->save();
        $category = new \App\Category([
            'id'       => 2,
            'title'    => 'Company Industry',
            'slug'     => 'company-industry',
            'parent'   => 0
        ]);
        $category->save();
        $category = new \App\Category([
            'id'       => 3,
            'title'    => 'Job Location',
            'slug'     => 'job-location',
            'parent'   => 0
        ]);
        $category->save();
        $category = new \App\Category([
            'id'       => 4,
            'title'    => 'Employment Type',
            'slug'     => 'employment-type',
            'parent'   => 0
        ]);
        $category->save();
        $category = new \App\Category([
            'id'       => 5,
            'title'    => 'Remote Job',
            'slug'     => 'remote-job',
            'parent'   => 0
        ]);
        $category->save();
        $category = new \App\Category([
            'id'       => 6,
            'title'    => 'Monthly Salary',
            'slug'     => 'monthly-salary',
            'parent'   => 0
        ]);
        $category->save();
        $category = new \App\Category([
            'id'       => 7,
            'title'    => 'Career Level',
            'slug'     => 'career-level',
            'parent'   => 0
        ]);
        $category->save();
        $category = new \App\Category([
            'id'       => 8,
            'title'    => 'Years of Experience',
            'slug'     => 'years-of-experience',
            'parent'   => 0
        ]);
        $category->save();
        $category = new \App\Category([
            'id'       => 9,
            'title'    => 'Degree',
            'slug'     => 'degree',
            'parent'   => 0
        ]);
        $category->save();
    }
}
